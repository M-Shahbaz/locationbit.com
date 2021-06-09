<?php
/**
 * Step 1
 * * Run on Windows to generate:
 * vendor\\bin\\phinx-migrations generate
 * 
 * Step 2
 * * Run on Windows to migrate:
 * vendor\\bin\\phinx migrate
 * 
 */
// Framework bootstrap code here
require_once __DIR__ . '/php/config/bootstrap.php';

// Get PDO object
$pdo = new PDO(
    "mysql:host=".getenv('DB_HOST').";dbname=".getenv('DB_NAME').";charset=utf8", getenv('DB_USER'), getenv('DB_PASS'),
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_unicode_ci',
    )
);

// Get migration path for phinx classes
$migrationPath = __DIR__ . '/resources/migrations';

return [
    'paths' => [
        'migrations' => $migrationPath,
    ],
    'foreign_keys' => false,
    'default_migration_prefix' => 'db_change_',
    'mark_generated_migration' => true,
    'migration_base_class' => \Phinx\Migration\AbstractMigration::class,
    'environments' => [
        'default_environment' => 'local',
        'local' => [
            // Database name
            'name' => $pdo->query('select database()')->fetchColumn(),
            'connection' => $pdo,
        ]
    ]
];