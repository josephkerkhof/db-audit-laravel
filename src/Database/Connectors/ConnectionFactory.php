<?php

namespace JosephKerkhof\DbAudit\Database\Connectors;

use Closure;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\ConnectionFactory as Base;
use Illuminate\Database\MySqlConnection as BaseMySqlConnection;
use Illuminate\Database\PostgresConnection as BasePostgresConnection;
use Illuminate\Database\SqlServerConnection as BaseSqlServerConnection;
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
            'mysql' => new BaseMySqlConnection($connection, $database, $prefix, $config),
            'pgsql' => new BasePostgresConnection($connection, $database, $prefix, $config),
            'sqlite' => new SQLiteConnection($connection, $database, $prefix, $config),
            'sqlsrv' => new BaseSqlServerConnection($connection, $database, $prefix, $config),
            default => throw new UnsupportedDatabaseException("Unsupported driver [{$driver}]"),
        };
    }
}
