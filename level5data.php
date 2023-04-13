<?php
include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];


if(isset($_POST['submit'])){
    
    $letters_display = $_POST['letters_display'];
    $letters = $_POST['letters'];
    $user_ip = array_map('strtoupper', $letters); // convert to uppercase 
    $letters_display = str_split($letters_display);
    $letters = array_map('strtoupper', $letters); // convert to uppercase 

    $sorted_ans = $letters_display;
    sort($sorted_ans);
    echo "<br/>";

    if($_SESSION['user_lives']>=1){
       if ($letters[0] == $sorted_ans[0] && $letters[1] == $sorted_ans[5])
        {
                $_SESSION['result']= "level5";
                $_SESSION['scoreTime']= date("Y-m-d H:i:s");
                $chrdiff = "Your letters have been correctly identified";
                header("Location: level5.php?err=$chrdiff");
        }else{
            $_SESSION['user_lives']-- ;
            $chrdiff = "Your letters have NOT been correctly identified";
           header("Location: level5.php?err=$chrdiff");
        }   
        
    }
    
}

?>
