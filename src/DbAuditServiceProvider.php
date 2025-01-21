<?php

namespace JosephKerkhof\DbAudit;

use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\SQLiteGrammar;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use JosephKerkhof\DbAudit\Commands\DbAuditCommand;
use JosephKerkhof\DbAudit\Database\Schema\AuditBlueprint;
use JosephKerkhof\DbAudit\Database\Schema\Grammars\GrammarFactory;
use JosephKerkhof\DbAudit\Database\Schema\Grammars\SQLiteTriggerGrammar;
use JosephKerkhof\DbAudit\Database\Schema\Grammars\UnsupportedDatabaseException;
use JosephKerkhof\DbAudit\Support\Facades\AuditSchema;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use function Laravel\Prompts\warning;

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
            ->hasMigration('create_audit_table')
            ->hasCommand(DbAuditCommand::class);
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        $this->app->bind(Schema::class, AuditSchema::class);

//        $this->app->bind(Blueprint::class, AuditBlueprint::class);
//
//        Schema::blueprintResolver(function ($table, $callback) {
//            return new AuditBlueprint($table, $callback);
//        });
    }
}
