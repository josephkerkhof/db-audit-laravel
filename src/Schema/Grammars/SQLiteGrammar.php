<?php

namespace JosephKerkhof\DbAudit\Schema\Grammars;

use Illuminate\Database\Schema\Grammars\SQLiteGrammar as Base;

class SQLiteGrammar extends Base
{
    public function compileAuditTriggers()
    {
        dd('compiling audit');
    }
}
