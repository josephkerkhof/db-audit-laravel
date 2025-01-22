<?php

namespace JosephKerkhof\DbAudit\Schema;

use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Builder as Base;

class Builder extends Base
{
    public function __construct(Connection $connection)
    {
        parent::__construct($connection);
        dd('builder');
    }
}
