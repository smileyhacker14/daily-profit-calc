<?php

class User
{
    private $conn;
    public $id;
    public $username_user;
    public static function signup($username, $password, $email, $job, $phone)
    {
        $option = [
            'cost' => 9,
        ];
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, $option);
        $conn = Database::getConnection();
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `job`, `phone`, `active`)
        VALUES ('$username', '$passwordHash', '$email', '$job', '$phone', '1');";

        try {
            $result = $conn->query($sql);
            if ($result) {
                $user = new User($username);
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->username_user;
            }
            return $result;

        } catch (Exception) {
            echo "Error: ". $conn->error;
            return false;
        }
    }

    public static function login($username, $password)
    {
        $conn = Database::getConnection();
        $query = "SELECT * FROM `auth` WHERE `username` = '$username' OR 'email' = '$username' OR 'phone' = '$username' ";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                return $row['username'];
            } else {
                return false;
            }
        }
    }

    public function __construct($username)
    {
        $this->conn = Database::getConnection();
        $this->id = null;
        $sql = "SELECT * FROM `auth` WHERE `username`= '$username' OR `email` = '$username' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->username_user = $row['username'];
        } else {
            throw new Exception("USERNAME DOESN'T EXITST");
        }
    }


}
