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
	<div class="header">
		<div class="left">
			<h1><a href="">Welcome to Level 3</a></h1>
		</div>

		<div class="right">
			<label><?php print($userRow['userName']); ?><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> logout</a></label>
		</div>
	</div>
	<div class="content">
		<h4>Lives Left: <?php echo $_SESSION['user_lives']; ?></h4>
		<?php 
		if($_SESSION['user_lives']>=1){
			if($_SESSION['result']=="level3"){
				?>
				<h3 style="color:Blue;">Congratulations, you have successfully completed Level 3 "Ascending Numbers"</h3>
				<h3><a href="home.php">Play Again</a></h3>
				<?php
			}
			else{
			?>
			<h3 style="color:Blue;">Arrange the numbers in ascending order:</h3>
			<h2 style="color:red;"><?php $num_display = random_nums(); echo implode(" ", $num_display); ?></h2>

			<form method="post" action="level3data.php" id="gameLevel3">
				<input type="hidden" name="num_display" value="<?php echo implode(",", $num_display); ?>"/>
				<label for="numbers">Enter your answer:</label>
				<input type="text" id="numbers" name="numbers" required>
				<br>
				<input type="submit" value="Submit" name="submit">
			</form>
			<?php
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
</body>
</html>
<?php
function random_nums()
{
    $nums = [];
    while (count($nums) < 6) {
        $rand_num = mt_rand(1, 100);
        if (!in_array($rand_num, $nums)) {
            $nums[] = $rand_num;
        }
    }
    //sort($nums);
    return $nums;
}
?>