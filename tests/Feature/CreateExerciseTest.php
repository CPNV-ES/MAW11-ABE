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

final class CreateExerciseTest extends TestCase
{
    private $db;
    private $controller;

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
    }

    /**
     * @runInSeparateProcess
     */
    public function testCreateExerciseShouldAppearInDb(): void
    {
        $exerciseData = $this->createExercise();

        $result = $this->db->query("SELECT * FROM exercises WHERE title = :title", [':title' => $exerciseData['title']]);
        $result = $result[0];

        $this->assertNotEmpty($result, "Failed to insert the new exercise into the database.");
        $this->assertEquals($exerciseData['title'], $result['title']);
        $this->assertEquals($exerciseData['exercise_status'], $result['exercise_status']);
    }

    /**
     * @runInSeparateProcess
     */
    public function testCreateExerciseShouldAppearInManageAnExercise(): void
    {
        $exerciseData = $this->createExercise();

        $exercises["building"] = Exercises::findAllByStatus("building");

        $found = false;
        foreach ($exercises["building"] as $exercise) {
            if ($exercise['title'] === $exerciseData['title'] && $exercise['exercise_status'] === $exerciseData['exercise_status']) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found, "The created exercise should appear in the 'building' exercises array.");
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
