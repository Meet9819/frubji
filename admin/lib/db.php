<?php

namespace lib\db;

const HOST = "localhost",
USER = "root",
PASSWD = "",
DB = "frubji";

class Database
{
    private $connection = null;

    public function getPDOConnection()
    {
        try {
            $this->connection = new \PDO("mysql:host=" . HOST . ";dbname=" . DB, USER, PASSWD, array(
                \PDO::ATTR_EMULATE_PREPARES => false,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ));

        } catch (\Throwable $th) {
            throw $th;
        }

        return $this->connection;
    }

    public function closePDOConnection()
    {
        try {
            $this->connection = null;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getMysqliConnection()
    {
        try {
            $this->connection = new \mysqli(HOST, USER, PASSWD, DB);

            if ($this->connection->connect_error) {
                throw $th;
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        return $this->connection;
    }

    public function closeMysqliConnection()
    {
        try {
            $this->connection->close();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
