<?php

namespace JosephKerkhof\DbAudit\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use JosephKerkhof\DbAudit\DbAuditServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'JosephKerkhof\\DbAudit\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            DbAuditServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }
}