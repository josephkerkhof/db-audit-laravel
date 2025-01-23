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

    public function withAuditing(string $table): bool
    {
        return $this->connection->statement(
            $this->grammar->compileAuditTriggers($table)
        );
    }
}
