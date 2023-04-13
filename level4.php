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
<!DOCTYPE html>
<html>
<head>
	<title>Welcome - <?php print($userRow['userName']); ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
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
    <h1 style="color:Blue;">Level 4</h1>
    <h3>Lives Left : <?php echo $_SESSION['user_lives']; ?></h3>
    <?php 
        if($_SESSION['user_lives']>=1){
            if($_SESSION['result']=="level4"){
                $_SESSION['result']="";
                ?>
                <h3 style="color:Blue;">You pass the Level 4 "Descending Numbers"><br/>
        <a href="level4.php">
            play again Level 4
        </a></br>
        <a href="level5.php">
            Go to Level 5 "Find First and Last Letter"
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
			<h3 style="color:Blue;">Arrange the numbers in descending order:</h3>
            <h4 style="color:Blue;">(Separate each numbers by coma "," )</h4>
			<h2 style="color:red;"><?php $num_display = random_nums(); echo implode(" ", $num_display); ?></h2>

			<form method="post" action="level4data.php" id="gameLevel3">
				<input type="hidden" name="num_display" value="<?php echo htmlentities(serialize($num_display)); ?>"/>
				<label for="numbers" style="font-size: 18px;">Enter your answer:</label>
				<input type="text" id="numbers" name="numbers" style="font-size: 16px; width: 200px;" required>
				<br>
				<input type="submit" value="Submit" name="submit" style="font-size: 18px;">
			</form>
			<?php
if(isset($_GET['err'])){
    ?>
<h2>
    <?php echo $_GET['err'];?>
</h2>
			<?php
			}
		}
		}
		else{
			$_SESSION['user_lives']=6;
			?>
			<h3 style="color:Blue;">You lost the game please try again</h3>
			<h3><a href="home.php">Restart Game</a></h3>
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
function random_nums()
{
	$numbers = range(1,100);
	shuffle($numbers);
	$numbers = array_slice($numbers,0,6);

	return $numbers;
}
?>