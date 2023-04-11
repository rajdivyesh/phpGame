<?php
include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];


if(isset($_POST['submit'])){
    
    $letters_display = $_POST['letters_display'];
    $user_ip = strtoupper($_POST['letters']);
    $letters_display = str_split($letters_display);
    $user_ip = str_split($user_ip);

    // print_r($letters_display);
    // print_r($user_ip);

    $sorted_ans = $letters_display;
    rsort($sorted_ans);
    echo "<br/>";
    // print_r($sorted_ans);

    $array_comparison = array_diff($user_ip,$sorted_ans);

    $count =count($array_comparison);

    if($_SESSION['user_lives']>=1){
        
        if(count($user_ip)>6){
            $_SESSION['user_lives'] = $_SESSION['user_lives']-1;
            $chrdiff= "Please enter SIX alphabets without any special characters or spaces";
            header("Location: level2.php?err=$chrdiff");
        }
        else if($count == 6 AND ($user_ip!=$sorted_ans)){
            $_SESSION['user_lives'] = $_SESSION['user_lives']-1;
            $chrdiff= "All your characters are different than ours";
            header("Location: level2.php?err=$chrdiff");

        }
        else if ($count<6 AND $count>1){
            $_SESSION['user_lives'] = $_SESSION['user_lives']-1;
            $chrdiff= "Some of your characters are different than ours";
            header("Location: level2.php?err=$chrdiff");

        }
        else{
            if($user_ip == $sorted_ans){
                
                $_SESSION['result']= "level2";
                $_SESSION['scoreTime']= date("Y-m-d H:i:s");
                $chrdiff= "Your characters have been correctly ordered in descending order";
                header("Location: level2.php?err=$chrdiff");

            }
            else{
                $_SESSION['user_lives'] = $_SESSION['user_lives']-1;
                $chrdiff= "Your characters have not been correctly ordered in descending order";
                header("Location: level2.php?err=$chrdiff");

            }
        }
        
    }
    
}

?>