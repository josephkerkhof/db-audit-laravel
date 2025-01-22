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
     * @param string $driver
     * @param PDO|Closure $connection
     * @param string $database
     * @param string $prefix
     * @param array $config
     * @return Connection
     *
     * @throws UnsupportedDatabaseException
     */
    protected function createConnection($driver, $connection, $database, $prefix = '', array $config = []): Connection
    {
        if ($resolver = Connection::getResolver($driver)) {
            return $resolver($connection, $database, $prefix, $config);
        }

        switch ($driver) {
            case 'mysql':
                throw new UnsupportedDatabaseException('MySQL is not supported at this time');
            case 'pgsql':
                throw new UnsupportedDatabaseException('Postgres is not supported at this time');
            case 'sqlite':
                return new SQLiteConnection($connection, $database, $prefix, $config);
            case 'sqlsrv':
                throw new UnsupportedDatabaseException('SQL Server is not supported at this time');
        }

        throw new UnsupportedDatabaseException("Unsupported driver [{$driver}]");
    }
}
