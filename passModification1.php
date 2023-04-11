<?php
require_once 'dbconfig.php';

// if($user->is_loggedin()!="")
// {
//     $user->redirect('home.php');
// }

if(isset($_POST['btn-signup']))
{
   $firstName = trim($_POST['firstName']);
   $lastName = trim($_POST['lastName']);
   $userName = trim($_POST['userName']); 
   $password = trim($_POST['password']);
   $conpwd = trim($_POST['conPwd']);


   if($firstName=="") {
      $error[] = "provide first name !"; 
   }
   else if(preg_match("/^[A-Z][a-zA-Z ]+$/", $firstName) === 0){
      $error[] = "First name must be from letters, spaces and must not start with dash"; 
   }
   else if($lastName=="") {
      $error[] = "provide  last name !"; 
   }
   else if(preg_match("/^[A-Z][a-zA-Z ]+$/", $lastName) === 0){
      $error[] = "Last name must be from letters, spaces and must not start with dash"; 
   }
   else if($userName=="") {
    $error[] = "provide  user name !"; 
   }
//    else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
//       $error[] = 'Please enter a valid email address !';
//    }
   else if($password=="") {
      $error[] = "provide password !";
   }
   else if(strlen($password) < 6){
      $error[] = "Password must be atleast 6 characters"; 
   }
   else if($password!=$conpwd){
      $error[] = "Confirm password must be same as password"; 
   }
   else
   {
      try
      {
         $stmt = $DB_con->prepare("SELECT userName FROM player WHERE userName=:userName");
         $stmt->execute(array(':userName'=>$userName));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['userName']==$userName) {
            $error[] = "sorry username already taken !";
         }
         else
         {
            if($user->register($firstName,$lastName,$userName,$password)) 
            {
                $user->redirect('register.php?joined');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign up</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post">
            <h2>Sign up.</h2><hr />
            <?php
            if(isset($error))
            {
               foreach($error as $error)
               {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
               }
            }
            else if(isset($_GET['joined']))
            {
                 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
            }
            ?>
            <div class="form-group">
            <input type="text" class="form-control" name="firstName" placeholder="Enter First Name" value="<?php if(isset($error)){echo $firstName;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="lastName" placeholder="Enter Last Name" value="<?php if(isset($error)){echo $lastName;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="userName" placeholder="Enter User Name" value="<?php if(isset($error)){echo $userName;}?>" />
            </div>
            <div class="form-group">
             <input type="password" class="form-control" name="password" placeholder="Enter Password" value="<?php if(isset($error)){echo $userName;}?>" />
            </div>
            <div class="form-group">
             <input type="password" class="form-control" name="conPwd" placeholder="Confirm Password" value="<?php if(isset($error)){echo $userName;}?>" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">
                 <i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br />
            <label>have an account ! <a href="index.php">Sign In</a></label>
        </form>
       </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <?php include 'footer.php'; ?>

</body>
</html>
