<?php

namespace JosephKerkhof\DbAudit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @mixin Model
 */
trait Auditable
{
    public function audits(): MorphMany
    {
        return $this->morphMany($this->getAuditModel(), 'model');
    }

    public function getAuditModel(): string
    {
        return config('db-audit.audit_model');
    }
}
