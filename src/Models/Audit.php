<?php

namespace JosephKerkhof\DbAudit\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audits';

    protected $casts = [
        'old_values' => 'json',
        'new_values' => 'json',
    ];
}
