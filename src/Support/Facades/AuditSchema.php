<?php

namespace JosephKerkhof\DbAudit\Support\Facades;

use Illuminate\Support\Facades\Schema;

class AuditSchema extends Schema
{
    public static function connection($name)
    {
        dd($name);
    }
}
