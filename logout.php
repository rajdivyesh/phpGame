<?php
    require_once 'dbconfig.php';
    if($user->logout())
    {
        $user->redirect('index.php');
    }
?>