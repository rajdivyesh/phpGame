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
<div class="header">
    <div class="left">
        <h1><label><a href="">Welcome to Letter Game</a></label></h1>
    </div>

    <div class="right">
     <label><?php print($userRow['userName']); ?><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> logout</a></label>
    </div>
 </div>
<div class="content">


    <h4>Lives Left : <?php echo $_SESSION['user_lives']; ?></h4>
    <?php 
        if($_SESSION['user_lives']>=1){
            if($_SESSION['result']=="level6"){
                ?>
                <h3 style="color:Blue;">You pass the Level 5 "Identify First & Last Letter of alphabets"
        <!-- <a href="home.php">
            play again Level 1
        </a> -->
        <a href="level6.php">
            Go to Level 6 "Identify Numbers"
        </a></h3>
                <?php
            }
            else{

            
            ?>
            <h3 style="color:Blue;">Find First & Last Letter of Numbers:</h3>
            <h2  style="color:red;"><?php $letter_display = random_chars(); echo $letter_display; ?></h2>

            <form method="post" action="level6data.php" id ="gamelevel6">
                <input type="hidden" name="letters_display" value="<?php echo $letter_display; ?>"/>
                <label for="letters">Enter your answer:</label>
                <input type="text" name="letters[]" required>
                <input type="text" name="letters[]" required>
                <br>
                <input type="submit" value="Submit" name="submit">
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