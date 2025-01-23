<?php

namespace JosephKerkhof\DbAudit\Database\Schema\Grammars;

use Illuminate\Database\Schema\Grammars\SQLiteGrammar as Base;

class SQLiteGrammar extends Base implements GrammarInterface
{
    public function compileAuditTriggers(string $table)
    {
        dd('im in sqlite audit triggers for table: '.$table);
        // TODO implement the trigger create for SQLite
    }
}
