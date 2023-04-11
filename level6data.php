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
    $letters_display = explode(',', $letters_display);
    //$user_ip = str_split($user_ip);

    $sorted_ans = $letters_display;
    sort($sorted_ans);
    echo "<br/>";
    // print_r($sorted_ans);
    var_dump($sorted_ans);
    var_dump($user_ip);
   //$array_comparison = array_diff($user_ip,$sorted_ans);

    //$count =count($array_comparison);
    
    if($_SESSION['user_lives']>=1){
        if ($user_ip[0] == $sorted_ans[0] && $user_ip[1] == $sorted_ans[5])
        {
                $_SESSION['result']= "level6";
                echo "Your letters have been correctly identified";
                
                header("Location: level6.php");
        }else{
            $_SESSION['user_lives']-- ;
            echo "Your letters have NOT been correctly identified";
            header("Location: level6.php");
        }   
        
    }
    
}

?>