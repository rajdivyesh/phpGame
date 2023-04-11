<?php
include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];

if(isset($_POST['submit'])){
    
    $num_display = unserialize($_POST['num_display']);
    $user_ip = $_POST['numbers'];
    $user_ip = explode (",", $user_ip); 

    $sorted_ans = $num_display;
    sort($sorted_ans);
  
    $array_comparison = array_diff($user_ip,$sorted_ans);

    print_r($array_comparison);
    $count =count($array_comparison);
    echo $count;

    if($_SESSION['user_lives']>=1){
        if($count == 6 AND ($user_ip!=$sorted_ans)){
            $_SESSION['user_lives'] = $_SESSION['user_lives']-1;
            $numdiff= "All your numbers are different than ours";
            header("Location: level3.php?err=$numdiff");

        }
        else if ($count<6 AND $count>1){
            $_SESSION['user_lives'] = $_SESSION['user_lives']-1;
            $numdiff= "Some of your numbers are different than ours";
            header("Location: level3.php?err=$numdiff");

        }
        else{
            if($user_ip == $sorted_ans){
                $_SESSION['result']= "level3";
                $_SESSION['scoreTime']= date("Y-m-d H:i:s");
                $numdiff= "Your numbers have been correctly ordered in ascending order";
                header("Location: level3.php?err=$numdiff");
            }
            else{
               $_SESSION['user_lives'] = $_SESSION['user_lives']-1;
                $numdiff= "Your numbers have not been correctly ordered in ascending order";
                header("Location: level3.php?err=$numdiff");
            }
            
        }
        
    }
            
        
    }
    


?>
