<?php
require_once 'dbconfig.php';

if($user->is_loggedin()!="")
{
 $user->redirect('welcome.php');
}

if(isset($_POST['btn-login']))
{
 $uname = $_POST['txt_uname'];
 $upass = $_POST['txt_password'];
 try
    {
         $stmt = $DB_con->prepare("SELECT userName FROM player WHERE userName=:userName");
         $stmt->execute(array(':userName'=>$uname));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
         
        //  if($row<0) {
        //     $error = "It seems You are not regstered user!";
        //  }
        //  else
        //  { 
            if($user->login($uname,$upass))
            {
            $user->redirect('welcome.php');
            }
            else
            {
            $error = "check Username Or password";
            } 
        //  }
    }
    catch(PDOException $e)
     {
        echo $e->getMessage();
     }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post">
            <h2>Sign in.</h2><hr />
            <?php
            if(isset($error))
            {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                  </div>
                  <?php
            }
            ?>
            <div class="form-group">
             <input type="text" class="form-control" name="txt_uname" placeholder="Username" required />
            </div>
            <div class="form-group">
             <input type="password" class="form-control" name="txt_password" placeholder="Your Password" required />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" name="btn-login" class="btn btn-block btn-primary">
                 <i class="glyphicon glyphicon-log-in"></i>&nbsp;SIGN IN
                </button>
            </div>
            <br />
            <label>Don't have account yet ! <a href="register.php">Sign Up</a></label>
            <label class="forgot-password"> <a href="passModification.php">Forgot password?</a></label>
        </form>
       </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<?php include 'footer.php'; ?>
</body>
</html>