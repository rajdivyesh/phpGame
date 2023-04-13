
<?php
require_once 'dbconfig.php';

if(isset($_POST['btn-save']))
{
 $uname = $_POST['txt_uname'];
 $upass = $_POST['txt_password'];
 $newpass = $_POST['txt_newpassword'];

 if($uname=="") {
    $error = "provide  user name !"; 
   }
else if($upass=="") {
      $error = "provide password !";
   }
else if(strlen($upass) < 6){
      $error = "Password must be atleast 6 characters"; 
   }
else if($upass!=$newpass){
      $error = "Confirm password must be same as password"; 
   }
else
   {
        if($user->update_password($uname, $upass, $newpass))
        {
        $user->redirect('index.php');
        }
        else
        {
        $error = "Invalid username. Please try again.!";
        } 
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forgot Password</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
    <div class="row">
        <div class="password-modification">
            <form role="form" method="post">
                <fieldset>
                    <h2>Forgot Password</h2><hr/>

                    <?php if(isset($error)) { ?>
                      <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                      </div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="uname">Username</label>
                        <input type="text" name="txt_uname" placeholder="Username" required class="form-control" id="username"/>
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" name="txt_password" placeholder="Old Password" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="newpassword">Confirm New Password</label>
                        <input type="password" name="txt_newpassword" placeholder="New Password" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <input type="submit" name="btn-save" value="Save" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<?php include 'footer.php'; ?>

</body>
</html>
