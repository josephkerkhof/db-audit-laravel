<?php

namespace JosephKerkhof\DbAudit\Database\Schema\Grammars;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\SQLiteGrammar as Base;
use Illuminate\Support\Fluent;

class SQLiteGrammar extends Base
{
    public function compileTrigger(Blueprint $blueprint, Fluent $command)
    {
        // TODO implement the trigger create for SQLite
    }
}
