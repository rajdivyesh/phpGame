<?php
include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];


if(isset($_POST['submit'])){
    
    $letters_display = $_POST['letters_display'];
    $user_ip = $_POST['letters'];
    $letters_display = str_split($letters_display);
    $user_ip = str_split($user_ip);

    // print_r($letters_display);
    // print_r($user_ip);

    $sorted_ans = $letters_display;
    rsort($sorted_ans);
    echo "<br/>";
    // print_r($sorted_ans);

    if($_SESSION['user_lives']>=1){
        if($user_ip == $sorted_ans){
            $_SESSION['result']= "level2";
            $_SESSION['scoreTime']= date("Y-m-d H:i:s");
            echo "win";
            header("Location: level2.php");
        }
        else{
            $_SESSION['user_lives'] = $_SESSION['user_lives']-1;
            //echo "lives left".$_SESSION['user_lives'] ;
            header("Location: level2.php");
        }
    }
    else{
        echo "Sorry you are lost... Try again";
        
    }
    
    

}

?>