<?php

return [

    /*
     * The fully qualified class name of the audit model.
     */
    'audit_model' => JosephKerkhof\DbAudit\Models\Audit::class,

    /*
     * The locations to search for models to audit.
     */
    'model_locations' => [
        'App\\Models',
        'App',
    ],
];
