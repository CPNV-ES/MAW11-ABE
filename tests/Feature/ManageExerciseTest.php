<?php

define('BASE_DIR', dirname(__FILE__) . '/../..');

require_once BASE_DIR . '/vendor/autoload.php';

use App\Models\Database;
use App\Models\Exercises;
use App\Controllers\ExercisesController;
use PHPUnit\Framework\TestCase;

// Load test environment variable
$dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR, '.env_test');
$dotenv->load();

final class ManageExerciseTest extends TestCase
{
    private $db;
    private $controller;
    private $exerciseData;

    protected function setUp(): void
    {
        // Test DB
        $this->db = Database::getInstance(
            $_ENV["DATABASE_HOST"],
            $_ENV["DATABASE_NAME"],
            $_ENV["DATABASE_USERNAME"],
            $_ENV["DATABASE_PASSWORD"]
        );

        $this->db->query("SET FOREIGN_KEY_CHECKS=0");
        $this->db->query("TRUNCATE TABLE fields");
        $this->db->query("TRUNCATE TABLE exercises");
        $this->db->query("SET FOREIGN_KEY_CHECKS=1");

        $this->controller = new ExercisesController();
        $this->exerciseData = $this->createExercise();
    }

    /**
     * @runInSeparateProcess
     */
    public function testUpdateExerciseStatusFromBuildingToAnswering(): void
    {
        $exerciseId = 1;
        $_GET['status'] = 'answering';
        $parameters = ['exercise' => $exerciseId];

        $exercise = Exercises::findBy("id", $exerciseId)[0];
        $this->assertEquals($this->exerciseData['exercise_status'], $exercise['exercise_status'], "The exercise status should be 'building' before updating.");

        $this->controller->updateExerciseStatus($parameters);

        $updatedExercise = Exercises::findBy("id", $exerciseId)[0];
        $this->assertEquals('answering', $updatedExercise['exercise_status'], "The exercise status should be updated to 'answering'.");
    }

    protected function tearDown(): void
    {
        // Clear the exercises table again after each test
        $this->db->query("SET FOREIGN_KEY_CHECKS=0");
        $this->db->query("TRUNCATE TABLE fields");
        $this->db->query("TRUNCATE TABLE exercises");
        $this->db->query("SET FOREIGN_KEY_CHECKS=1");
    }

    private function createExercise()
    {
        $exerciseData = [
            'title' => 'New Test Exercise',
            'exercise_status' => 'building'
        ];

        $_POST = $exerciseData; // controller->create(); will capture it

        $this->controller->createExercise();

        return $exerciseData;
    }
}