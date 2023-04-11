<?php
class USER
{
    
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }

    public function register($firstName,$lastName,$userName,$password)
    {
       try
       {
           //$new_password = password_hash($upass, PASSWORD_DEFAULT);
   
           $sql = "INSERT INTO player (fName, lName, userName, registrationTime) VALUES (:first_name, :last_name, :username, NOW())";

           $stmt = $this->db->prepare($sql);
              
           $stmt->bindparam(":first_name", $firstName);
           $stmt->bindparam(":last_name", $lastName);
           $stmt->bindparam(":username", $userName);            
           $stmt->execute(); 

     
           $registration_order = $this->db->lastInsertId();
        
        // Insert the password into the authenticator table
           $sql= "INSERT INTO authenticator (passCode, registrationOrder) VALUES (:password, :registration_order)";
           $stmt = $this->db->prepare($sql);
           $stmt->bindparam(':password', password_hash($password, PASSWORD_DEFAULT));
           $stmt->bindparam(':registration_order', $registration_order);
           $stmt->execute();

           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }


    public function login($uname,$upass)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT * FROM player WHERE userName=:uname LIMIT 1");
            $stmt->execute(array(':uname'=>$uname));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            
            if($stmt->rowCount() > 0)
            {
                $regOrder = $userRow['registrationOrder'];
                $stmt = $this->db->prepare("SELECT * FROM authenticator WHERE registrationOrder=:registerationOrder");
                $stmt->execute(array(':registerationOrder'=>$regOrder));
                $passRow=$stmt->fetch(PDO::FETCH_ASSOC);

                echo $passRow['passCode'];
                if(password_verify($upass, $passRow['passCode']))
                {
                    //echo "passwordverification";
                    $_SESSION['user_session'] = $userRow['registrationOrder'];
                    $_SESSION['user_lives']=6;
                    $_SESSION['result']= "";
                    $_SESSION['scoreTime']="";
                    $error = "";
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function update_password($uname,$upass,$newpass)
    {
        try
        {
            echo $upass;
            echo $newpass;

            $stmt = $this->db->prepare("SELECT * FROM player WHERE userName=:uname LIMIT 1");
            $stmt->execute(array(':uname'=>$uname));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            print_r($userRow);
            if($stmt->rowCount() > 0)
            {
                $regOrder = $userRow['registrationOrder'];
                // $stmt = $this->db->prepare("SELECT * FROM authenticator WHERE registrationOrder=:registerationOrder");
                // $stmt->execute(array(':registerationOrder'=>$regOrder));
                // $passRow=$stmt->fetch(PDO::FETCH_ASSOC);
    
                // if(password_verify($upass, $newpass))
                {
                    echo $upass;
                    $new_password = password_hash($upass, PASSWORD_DEFAULT);
                    $sql = "UPDATE authenticator SET passCode = :new_password WHERE registrationOrder = :regOrder";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindparam(':new_password', $new_password);
                    $stmt->bindparam(':regOrder', $regOrder);
                    $stmt->execute();

                    return true;
                }
                /*else
                {
                    return false;
                }*/
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
        
    
    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }
    public function redirect($url)
    {
        header("Location: $url");
    }

    public function logout()
    {

        session_destroy();
        unset($_SESSION['user_session']);
        unset($_SESSION['user_lives']);
        unset($_SESSION['result']);
        return true;
    }

    public function insertScore($result,$lives,$regOrder){
        try
       {
           //$new_password = password_hash($upass, PASSWORD_DEFAULT);
   
           $sql = "INSERT INTO score (scoreTime, result, livesUsed, registrationOrder) VALUES (NOW(), :result, :lives, :regOrder)";

           $stmt = $this->db->prepare($sql);
              
           $stmt->bindparam(":result", $result);
           $stmt->bindparam(":lives", $lives);
           $stmt->bindparam(":regOrder", $regOrder);            
           $stmt->execute(); 
       }
       catch(PDOException $e)
        {
            echo $e->getMessage();
        }

    }


}