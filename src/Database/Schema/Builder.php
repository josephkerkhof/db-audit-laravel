<?php

namespace JosephKerkhof\DbAudit\Database\Schema;

use Illuminate\Database\Schema\Builder as Base;
use JosephKerkhof\DbAudit\Database\Schema\Grammars\GrammarInterface;

class Builder extends Base
{
    /**
     * The schema grammar instance.
     *
     * @var GrammarInterface
     */
    protected $grammar;

    public function withAuditing(string $table, ?array $only = null): void
    {
        $allColumns = collect($this->getColumnListing($table));

        $columns = $only ? $allColumns->only($only)->toArray() : $allColumns->toArray();

        $insertTriggerName = "{$table}_after_insert";
        $this->connection->statement(
            $this->grammar->compileDropTriggerIfExists($insertTriggerName, $table)
        );
        $this->connection->statement(
            $this->grammar->compileInsertAuditTrigger($insertTriggerName, $table, $columns)
        );

        $updateTriggerName = "{$table}_after_update";
        $this->connection->statement(
            $this->grammar->compileDropTriggerIfExists($updateTriggerName, $table)
        );
        $this->connection->statement(
            $this->grammar->compileUpdateAuditTrigger($updateTriggerName, $table, $columns)
        );

        $deleteTriggerName = "{$table}_after_delete";
        $this->connection->statement(
            $this->grammar->compileDropTriggerIfExists($deleteTriggerName, $table)
        );
        $this->connection->statement(
            $this->grammar->compileDeleteAuditTrigger($deleteTriggerName, $table, $columns)
        );
    }
}
