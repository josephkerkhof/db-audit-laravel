<?php

namespace JosephKerkhof\DbAudit\Database\Schema;

use Closure;
use Illuminate\Database\Schema\Builder as Base;

class Builder extends Base
{
    protected bool $withAuditing = false;

    public function withAuditing(): static
    {
        $this->withAuditing = true;

        return $this;
    }

    public function create($table, Closure $callback)
    {
        parent::create($table, $callback);
    }
}
