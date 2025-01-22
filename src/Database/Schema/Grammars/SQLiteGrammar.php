<?php

namespace JosephKerkhof\DbAudit\Database\Schema\Grammars;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\SQLiteGrammar as Base;
use Illuminate\Support\Fluent;

class SQLiteGrammar extends Base
{
    public function compileCreate(Blueprint $blueprint, Fluent $command)
    {
        dd('i am trying to create');
        return parent::compileCreate($blueprint, $command);
    }
}
