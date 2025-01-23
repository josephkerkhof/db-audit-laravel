<?php

namespace JosephKerkhof\DbAudit\Database\Schema\Grammars;

interface GrammarInterface
{
    public function compileDropTriggerIfExists(string $triggerName, string $table): string;

    public function compileInsertAuditTrigger(string $triggerName, string $table, array $columns): string;

    public function compileUpdateAuditTrigger(string $triggerName, string $table, array $columns): string;

    public function compileDeleteAuditTrigger(string $triggerName, string $table, array $columns): string;
}
