<?php

define('BASE_DIR', dirname(__FILE__) . '/..');

require_once BASE_DIR . '/vendor/autoload.php';

use App\Models\Database;
use PHPUnit\Framework\TestCase;

// Load environment variable
$dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR);
$dotenv->load();

final class DatabaseTest extends TestCase
{
    public function testDatabaseNotNull(): void
    {
        $database = Database::getInstance($_ENV["DATABASE_HOST"], $_ENV["DATABASE_NAME"], $_ENV["DATABASE_USERNAME"], $_ENV["DATABASE_PASSWORD"]);

        $this->assertNotNull($database);
    }
}
