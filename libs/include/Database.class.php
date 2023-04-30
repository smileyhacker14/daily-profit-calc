<?php

class Database
{
    public static $conn = null;

    public static function getConnection()
    {
        if (Database::$conn == null) {
            $db_server = 'mysql.selfmade.ninja:3306';
            $db_user_name = 'shaheel';
            $db_pass_word = 'shaheelshah';
            $db_name = 'shaheel_dailyProfit';

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
