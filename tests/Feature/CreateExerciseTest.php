<?php

define('BASE_DIR', dirname(__FILE__) . '/../..');

require_once BASE_DIR . '/vendor/autoload.php';

use App\Models\Database;
use App\Controllers\ExercisesController;
use PHPUnit\Framework\TestCase;

// Load test environment variable
$dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR, '.env_test');
$dotenv->load();

final class CreateExerciseTest extends TestCase
{
    private $db;

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
    }

    /**
     * @runInSeparateProcess
     */
    public function testCreateExercise(): void
    {
        $exerciseData = [
            'title' => 'New Test Exercise',
            'exercise_status' => 'building'
        ];

        $_POST = $exerciseData; // controller->create(); will capture it

        $controller = new ExercisesController();
        $controller->createExercise();

        $result = $this->db->query("SELECT * FROM exercises WHERE title = :title", [':title' => $exerciseData['title']]);
        $result = $result[0];

        $this->assertNotEmpty($result, "Failed to insert the new exercise into the database.");
        $this->assertEquals($exerciseData['title'], $result['title']);
        $this->assertEquals($exerciseData['exercise_status'], $result['exercise_status']);
    }

    protected function tearDown(): void
    {
        // Clear the exercises table again after each test
        $this->db->query("SET FOREIGN_KEY_CHECKS=0");
        $this->db->query("TRUNCATE TABLE fields");
        $this->db->query("TRUNCATE TABLE exercises");
        $this->db->query("SET FOREIGN_KEY_CHECKS=1");
    }
}