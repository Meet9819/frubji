<?php
namespace Database\Data_Layer;

use Constants\Database;
use Database\Connection as Connection;

require_once __DIR__ . '/connection.php';

class DataLayer
{
    private $connection = null;

    public static function execute_query_array_params($query, $values, $connection = null)
    {
        $query_success = false;
        $is_connection_preset = isset($connection) ? true : false;
        $conn_object = null;

        if (!is_array($values)) {
            return $query_success;
        }

        try {
            if (!$is_connection_preset) {
                $conn_object = new Connection\DbConnection(1);
                $connection = $conn_object->getConnection();
            }

            try {
                $statement = $connection->prepare($query);

                $is_array_of_arrays = array_filter($values, 'is_array') === $values;

                $total_values = sizeof($values);

                for ($count = 0; $count < $total_values; $count++) {
                    // check one dimensional array
                    if (!$is_array_of_arrays) {
                        $query_success = $statement->execute($values);
                        $aadasdasd = $statement->errorInfo();
                        break;
                    } else {
                        $query_success = $statement->execute($values[$count]);
                        if (!$query_success) {
                            $aadasdasd = $statement->errorInfo();
                            break;
                        }
                    }
                }
            } catch (\Throwable $th) {
                throw $th;
            } finally {
                if (!$is_connection_preset) {
                    $conn_object->closeConnection();
                }
            }
        } catch (Exception $ex) {
            throw $th;
        } finally {
            return $query_success;
        }
    }

    public static function get_last_insert_id_last_exec_query()
    {

        try {
            $statement = $connection->prepare(LAST_INSERT_ID);

            $statement->execute();

            return $stmt->fetchColumn();
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            $conn_object->closeConnection();
        }
    }

    public static function get_next_sequence_value($query, $connection = null)
    {
        $is_connection_preset = isset($connection) ? true : false;
        $conn_object = null;

        try {
            if (!$is_connection_preset) {
                $conn_object = new Connection\DbConnection();
                $connection = $conn_object->getConnection();
            }

            $statement = $connection->prepare($query);

            if ($statement->execute()) {
                return $statement->fetchColumn();
            } else {
                throw new Exception('Unable to get next sequence value');
            }
        } catch (Exception $ex) {
            throw $ex;
        } finally {
            if (isset($this->connection) && !$is_connection_preset) {
                $conn_object->closeConnection();
            }
        }
    }
}
