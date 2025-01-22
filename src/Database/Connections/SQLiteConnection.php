<?php

namespace JosephKerkhof\DbAudit\Database\Connections;

use Illuminate\Database\SQLiteConnection as Base;
use JosephKerkhof\DbAudit\Database\Schema\Grammars\SQLiteGrammar as SchemaGrammar;

class SQLiteConnection extends Base
{
    /**
     * Get the default schema grammar instance.
     *
     * @return \JosephKerkhof\DbAudit\Database\Schema\Grammars\SQLiteGrammar
     */
    protected function getDefaultSchemaGrammar()
    {
        ($grammar = new SchemaGrammar)->setConnection($this);

        return $this->withTablePrefix($grammar);
    }
}
