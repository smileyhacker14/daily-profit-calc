<?php


class Daily
{
    public static function getIncomeList($user_id)
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM data WHERE uid= $user_id AND type = 'income';";
        $result = $conn->query($sql);
        return $result;
    }

    public static function getExpenseList($user_id)
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM data WHERE uid= $user_id AND type = 'expense'";
        $result = $conn->query($sql);
        return $result;
    }

    public static function getTotal($type, $user_id)
    {
        $conn = Database::getConnection();
        $sql = "SELECT SUM(amount) as totalIncome FROM data WHERE uid= $user_id AND type = '$type' ;";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['totalIncome'];
    }

    public static function deleteEntry($id, $user_id)
    {
        $conn = Database::getConnection();
        $sql = "DELETE FROM data WHERE uid= $user_id AND id='$id';";
        try {
            return $conn->query($sql);
        } catch (Exception) {
            return false;
        }
    }

    public static function insertValues($description, $date, $amount, $type, $user_id)
    {
        $conn = Database::getConnection();
        $sql = "INSERT INTO `data` (`description`, `date`, `amount`, `type`, `uid`)
        VALUES ('$description', '$date', '$amount', '$type' ,'$user_id');";
        try {
            return $conn->query($sql);
        } catch(Exception) {
            return false;
        }
    }
    public static function updateEntry($id, $description, $date, $amount)
    {
        $conn = Database::getConnection();
        $sql = "UPDATE data SET description = '$description', date = '$date' , amount= '$amount' WHERE id='$id';";
        try {
            return $conn->query($sql);
        } catch(Exception) {
            return "<script>swal('Update Failed Try Again...', {button: false,});</script>";
        }
    }


    public static function filterWeek($user_id)
    {
        $conn = Database::getConnection();
        $sql = "SELECT *
        FROM   data
        WHERE uid= $user_id AND date between cast(timestampadd(SQL_TSI_DAY, 
        -(dayofweek(curdate())-2), curdate()) as date) and
                                        cast(timestampadd(SQL_TSI_DAY, 
        7-(dayofweek(curdate())-1), curdate()) as date)";
        $result = $conn->query($sql);
        return $result;
    }

    public static function filterMonth($user_id)
    {
        $conn=Database::getConnection();
        $month = date("m");
        $sql = "SELECT * FROM data WHERE uid= $user_id AND MONTH(date) = $month ;";
        $result = $conn->query($sql);
        return $result;

    }

    public static function filterWithDates($user_id, $start_date, $end_date)
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM data WHERE uid=$user_id AND Date between $start_date and $end_date ORDER BY date;";
        $result = $conn->query($sql);
        return $result;
    }

}
