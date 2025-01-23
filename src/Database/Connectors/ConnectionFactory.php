<?php

namespace JosephKerkhof\DbAudit\Database\Connectors;

use Closure;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\ConnectionFactory as Base;
use JosephKerkhof\DbAudit\Database\Connections\SQLiteConnection;
use JosephKerkhof\DbAudit\UnsupportedDatabaseException;
use PDO;

class ConnectionFactory extends Base
{
    /**
     * Create a new connection instance.
     *
     * @param  string  $driver
     * @param  PDO|Closure  $connection
     * @param  string  $database
     * @param  string  $prefix
     *
     * @throws UnsupportedDatabaseException
     */
    protected function createConnection($driver, $connection, $database, $prefix = '', array $config = []): Connection
    {
        if ($resolver = Connection::getResolver($driver)) {
            return $resolver($connection, $database, $prefix, $config);
        }

        return match ($driver) {
            'mysql' => throw new UnsupportedDatabaseException('MySQL is not supported at this time'),
            'pgsql' => throw new UnsupportedDatabaseException('Postgres is not supported at this time'),
            'sqlite' => new SQLiteConnection($connection, $database, $prefix, $config),
            'sqlsrv' => throw new UnsupportedDatabaseException('SQL Server is not supported at this time'),
            default => throw new UnsupportedDatabaseException("Unsupported driver [{$driver}]"),
        };
    }
}
