<?php

namespace JosephKerkhof\DbAudit\Database\Schema\Grammars;

use Illuminate\Database\Schema\Grammars\SQLiteGrammar as Base;

class SQLiteGrammar extends Base implements GrammarInterface
{
    public function compileInsertAuditTrigger(string $triggerName, string $table, array $columns): string
    {
        $jsonObject = collect($columns)
            ->map(fn($column) => "'{$column}', new.{$column}")
            ->implode(', ');

        return sprintf(
            '
            create trigger %s
            after insert on %s
            begin
            insert into audits (model_type, model_id, event, new_values) values (\'%s\', new.id, \'created\', json_object(%s));
            end;',
            $triggerName,
            $table,
            $table,
            $jsonObject
        );
    }

    public function compileUpdateAuditTrigger(string $triggerName, string $table, array $columns): string
    {
        $oldValuesJsonObject = collect($columns)
            ->map(fn($column) => "'{$column}', old.{$column}")
            ->implode(', ');
        $newValuesJsonObject = collect($columns)
            ->map(fn($column) => "'{$column}', new.{$column}")
            ->implode(', ');

        return sprintf(
            '
            create trigger %s
            after update on %s
            begin
            insert into audits (model_type, model_id, event, old_values, new_values) values (\'%s\', new.id, \'updated\', json_object(%s), json_object(%s));
            end;',
            $triggerName,
            $table,
            $table,
            $oldValuesJsonObject,
            $newValuesJsonObject
        );
    }

    public function compileDeleteAuditTrigger(string $triggerName, string $table, array $columns): string
    {
        $jsonObject = collect($columns)
            ->map(fn($column) => "'{$column}', old.{$column}")
            ->implode(', ');

        return sprintf(
            '
            create trigger %s
            after delete on %s
            begin
            insert into audits (model_type, model_id, event, old_values) values (\'%s\', old.id, \'deleted\', json_object(%s));
            end;',
            $triggerName,
            $table,
            $table,
            $jsonObject
        );
    }

    public function compileDropTriggerIfExists(string $triggerName, string $table): string
    {
        return sprintf('drop trigger if exists %s.%s', $table, $triggerName);
    }
}
