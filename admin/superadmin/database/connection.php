<?php
namespace Database\Connection;

require_once __DIR__ . '/../constants/db_constants.php';

use Constants\Database;

class DbConnection
{
    private $conn;
    private $connType;
    private $config;

    public function __construct($type = 1)
    {
        $this->connType = $type;
        $this->config = array(
            'host' => constant('DATABASE_HOSTNAME'),
            'port' => constant('DATABASE_PORT'),
            'username' => constant('DATABASE_CONNECTION_USERNAME'),
            'password' => constant('DATABASE_CONNECTION_PASSWORD'),
            'dbname' => constant('DATABASE_NAME'),
        );

        // normal connection
        if ($this->connType == 1) {
            $this->conn = new \PDO('mysql:host=' . $this->config['host'] . ';port=' . $this->config['port'] . ';dbname=' . $this->config['dbname'], $this->config['username'], $this->config['password']);
        } else if ($this->connType == 2) {
            $this->conn = new \PDO('mysql:host=' . $this->config['host'] . ';port=' . $this->config['port'] . ';dbname=' . $this->config['dbname'], $this->config['username'], $this->config['password'], array(
                \PDO::ATTR_PERSISTENT => true,
            ));
        }
    }

    public function getConnection()
    {
        try {
            if (!empty($this->conn)) {
                return $this->conn;
            } else {
                throw new Exception('Connection unsuccesful');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function closeConnection()
    {
        try {
            if (empty($this->conn)) {
                $this->conn = null;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function startTransaction()
    {
        try {
            if ($this->conn->inTransaction() || $this->conn->beginTransaction()) {
                return $this->getConnection();
            } else {
                throw new Exception('Unable to start transaction');
            }
        } catch (\Throwable $th) {
            $this->closeConnection();
            throw $th;
        }
    }

    public function commitTransaction()
    {
        try {
            if ($this->conn->inTransaction() && !$this->conn->commit()) {
                throw new Exception('Transaction commit failed');
            }
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $this->closeConnection();
        }
    }

    public function rollbackTransaction()
    {
        try {
            if ($this->conn->inTransaction() && !$this->conn->rollBack()) {
                throw new Exception('Transaction rollback failed');
            }
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $this->closeConnection();
        }
    }
}
