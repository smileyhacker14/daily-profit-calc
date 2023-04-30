<?php

class Session
{
    private $data;
    private $conn;
    public $uid;

    public static function authenticate($user, $pass)
    {
        //Rename login function
        $username = User::login($user, $pass);
        if ($username) {
            $user = new User($username);
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5(rand(0, 9999999) . $ip . $agent);
            $sql = "INSERT INTO `userSession` (`uid`, `token`, `ip`, `user_agent`, `active`)
            VALUES ('$user->id', '$token',  '$ip', '$agent', '1')";
            if ($conn->query($sql)) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->username_user;
                setcookie("sessionToken", $token, strtotime('+30 days'));
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
            if (isset($_SERVER['REMOTE_ADDR']) and isset($_SERVER['HTTP_USER_AGENT'])) {
                if($_SERVER['REMOTE_ADDR'] == $Session->getIP()) {
                    if ($_SERVER['HTTP_USER_AGENT'] == $Session->getUserAgent()) {
                        return $Session->getUser();
                    }
                }
            }
        } catch(Exception) {
            return false;
        }
    }

    public function __construct($token)
    {
        $this->conn = Database::getConnection();
        $this->data = null;
        $sql = "SELECT * FROM `session` WHERE `token`='$token' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $this->data = $row;
        } else {
            throw new Exception("Session is invalid.");
        }
    }

    public function getUser()
    {
        return new User($this->uid);
    }


    public function getIP()
    {
        return isset($this->data["ip"]) ? $this->data["ip"] : false;
    }

    public function getUserAgent()
    {
        return isset($this->data["user_agent"]) ? $this->data["user_agent"] : false;
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
