<?php

namespace JosephKerkhof\DbAudit;

use JosephKerkhof\DbAudit\Commands\DbAuditCommand;
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
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_audit_table')
            ->hasCommand(DbAuditCommand::class);
    }
}
