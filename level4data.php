<?php
include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];

if(isset($_POST['submit'])){
    
    $num_display = $_POST['num_display'];
    $user_ip = $_POST['numbers'];
    $num_display = str_split($num_display);
    $user_ip = str_split($user_ip);

    $sorted_ans = $num_display;
    rsort($sorted_ans);
    
    $array_comparison = array_diff($user_ip,$sorted_ans);

    $count =count($array_comparison);

    if($_SESSION['user_lives']>=1){
        if($count == 6 AND ($user_ip!=$sorted_ans)){
            echo "All your numbers are different than ours";
        }
        else if ($count<6 AND $count>1){
            echo "Some of your numbers are different than ours";
        }
        else{
            if($user_ip == $sorted_ans){
                $_SESSION['result']= "level4";
                $_SESSION['scoreTime']= date("Y-m-d H:i:s");
                echo "Your numbers have been correctly ordered in descending order";
                header("Location: level5.php");
            }
            else{
                $_SESSION['user_lives'] = $_SESSION['user_lives']-1;
                echo "Your numbers have not been correctly ordered in descending order";
                header("Location: level5.php");
            }
        }
        
    }
    
}
?>
