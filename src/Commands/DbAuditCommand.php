<?php

namespace JosephKerkhof\DbAudit\Commands;

use Illuminate\Console\Command;

class DbAuditCommand extends Command
{
    public $signature = 'db-audit-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
