<?php
include_once '../load.php';
class Database
{
    public static $conn = null;

    public static function getConnection()
    {
        if (Database::$conn == null) {
            $db_server = get_config('server');
            $db_user_name = get_config('username');
            $db_pass_word = get_config('password');
            $db_name = get_config('dbname');

            $connection = new mysqli($db_server, $db_user_name, $db_pass_word, $db_name);
            if(!$connection->connect_error) {
                Database::$conn = $connection;
                return Database::$conn;
            } else {
                print("Something Wrong");
            }

        } else {
            return Database::$conn;
        }
    }
}
