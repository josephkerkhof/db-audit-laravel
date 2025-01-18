<?php

namespace JosephKerkhof\DbAudit\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JosephKerkhof\DbAudit\DbAudit
 */
class DbAudit extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \JosephKerkhof\DbAudit\DbAudit::class;
    }
}
