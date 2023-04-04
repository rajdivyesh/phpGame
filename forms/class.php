<?php
define('hostname', 'localhost');  
define('username', 'root');  
define('password', 'root');  
define('database', 'kidsgames');

class DB  
{  
    function __construct() {  
        // $con = mysql_connect(HOST, USER, PASS) or die('Connection Error! '.mysql_error());  
        // mysql_select_db(DB, $con) or die('DB Connection Error: ->'.mysql_error());  

        try
        {
            $DB_con = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }  
}



class player  
  
{  
    public function __construct() {  
        $db = new DB;  
    } 

    public function register($fName, $lName, $userName, $passWord, $registrationTime) {  
        $pass = md5($passWord);  
        $checkuser = mysql_query("Select id from users where email='$email'");  
        $result = mysql_num_rows($checkuser);  
        if ($result == 0) {  
            $register = mysql_query("Insert into users (trn_date, name, username, email, password) values ('$trn_date','$name','$username','$email','$pass')") or die(mysql_error());  
            return $register;  
        } else {  
            return false;  
        }  
    }  
} 

?>