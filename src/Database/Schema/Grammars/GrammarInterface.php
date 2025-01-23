<?php

namespace JosephKerkhof\DbAudit\Database\Schema\Grammars;

interface GrammarInterface
{
    public function compileAuditTriggers(string $table);
}
