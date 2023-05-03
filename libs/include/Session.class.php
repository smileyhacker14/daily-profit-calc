<?php

class Session
{
    private $data;
    private $conn;
    public $uid;
    public $token;

    public static function authenticate($user, $pass)
    {
        //Rename login function
        $username = User::login($user, $pass);
        if ($username) {
            try{
                $user = new User($username);
            } catch(Exception){
                return false;
            }
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5(rand(0, 9999999) . $ip . $agent);
            $sql = "INSERT INTO `userSession` (`uid`, `token`, `ip`, `user_agent`, `active`)
            VALUES ('$user->id', '$token',  '$ip', '$agent', '1')";
            if ($conn->query($sql)) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->username_user;
                setcookie("sessionToken", $token, strtotime('+3 days'));
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function authorization($token)
    {
        try {
            $Session = new Session($token);
            if($Session){
                return $Session->token;
            }

        } catch(Exception) {
            return false;
        }
    }

    public function __construct($token)
    {
        $this->conn = Database::getConnection();
        $this->data = null;
        $sql = "SELECT * FROM `userSession` WHERE `token`='$token' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->token = $row['token'];
        } else {
            return false;
        }
    }


    public static function removeUserSesstion($token)
    {
        $conn = Database::getConnection();
        $sql = "DELETE FROM `userSession` WHERE ((`token` = '$token'));";

        if($conn->query($sql)) {
            return true;
        } else {
            return false;
        }

    }




}
