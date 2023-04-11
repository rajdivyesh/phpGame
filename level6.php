<?php
include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM player WHERE registrationOrder=:registerationOrder");
$stmt->execute(array(":registerationOrder"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>welcome - <?php print($userRow['userName']); ?></title>
</head>
<body>
<div style="background-color: #333; overflow: hidden; padding: 10px;">
  <a style="float: left; color: white; font-size: 24px; font-weight: bold; text-decoration: none;" href="#">Kidsgame</a>
  <div style="float: right;">
    <a style="color: white; font-size: 18px; padding: 14px; text-decoration: none;" href="history.php">History</a>
    <a style="color: white; font-size: 18px; padding: 14px; text-decoration: none;" href="logout.php">(<?php print($userRow['userName']); ?>) logout</a>
  </div>
</div>
<div class="content">
    <h1 style="color:Blue;">Level 6</h1>
    <h3>Lives Left : <?php echo $_SESSION['user_lives']; ?></h3>
    <?php 
        if($_SESSION['user_lives']>=1){
            if($_SESSION['result']=="level6"){
                $_SESSION['result']="";
                ?>
                <h3 style="color:Blue;">You pass the Level 6 "Identified first and last number"><br/>
        <a href="level6.php">
            play again Level 6
        </a></br>
        <a href="welcome.php">
            Restart Game
        </a></br>
        <a href="index.php">
            <?php
            if($user->insertScore($_SESSION['result']="incomplete",$_SESSION['user_lives'],$_SESSION['user_session'])){
                $user->logout();
            }
            ?>
            Stop this session
        </a>
    </h3>
                <?php
            }
            else{
          
            ?>
            <h3 style="color:Blue;">Find First & Last Letter of Numbers:</h3>
            <h2  style="color:red;"><?php $letter_display = random_chars(); echo $letter_display; ?></h2>

            <form method="post" action="level6data.php" id ="gamelevel6">
                <input type="hidden" name="letters_display" value="<?php echo $letter_display; ?>"/>
                <label for="letters" style="font-size: 18px;">Enter your answer:</label>
                <input type="text" name="letters[]" style="font-size: 16px; width: 200px;" required>
                <input type="text" name="letters[]" style="font-size: 16px; width: 200px;" required>
                <br>
                <input type="submit" value="Submit" name="submit" style="font-size: 18px;">
            </form>
            <?php
            }
        }
        else{
            $_SESSION['user_lives']=6;
            ?>
        <h3 style="color:Blue;">You lost the game please try again
        <a href="home.php">
            Restart Game
        </a></h3>
            <?php
        }
    ?>
	
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<?php include 'footer.php'; ?>

</body>
</html>
<?php
function random_chars()
{
    $numbers = array();
    while(count($numbers) < 6){
        $rand_num = rand(1, 100);
        if(!in_array($rand_num, $numbers)){
            $numbers[] = $rand_num;
        }
        
    }
    $numbers = implode(',', $numbers);
        return $numbers;
}

?>