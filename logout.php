<?php
    require_once 'dbconfig.php';
    require_once 'footer.php';
    if($user->logout())
    {
        $user->redirect('index.php');
    }
?>