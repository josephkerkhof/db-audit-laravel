<?php

namespace JosephKerkhof\DbAudit;

use JosephKerkhof\DbAudit\Connectors\ConnectionFactory;
use JosephKerkhof\DbAudit\Schema\Builder;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DbAuditServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('db-audit-laravel')
            ->hasConfigFile('db-audit')
            ->hasViews()
            ->hasMigration('create_audit_table');
    }

    public function registeringPackage(): void
    {
        $this->app->singleton('db.schema', function ($app) {
            return new Builder($app['db']->connection());
        });
    }
}
