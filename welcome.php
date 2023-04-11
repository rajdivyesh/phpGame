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
	<title>Welcome to Kidsgame</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div style="background-color: #333; overflow: hidden; padding: 10px;">
  <a style="float: left; color: white; font-size: 24px; font-weight: bold; text-decoration: none;" href="#">Kidsgame</a>
  <div style="float: right;">
    <a style="color: white; font-size: 18px; padding: 14px; text-decoration: none;" href="history.php">History</a>
    <a style="color: white; font-size: 18px; padding: 14px; text-decoration: none;" href="logout.php">(<?php print($userRow['userName']); ?>) logout</a>
  </div>
</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1>Welcome to Kidsgame</h1></br></br>
				<h3>A fun game for kids to learn and enjoy</h3>
				<a href="home.php" class="btn">Start Game</a>
			</div>
		</div>
	</div>
    
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c -->

    <?php include 'footer.php'; ?>
    </body>
</html> 

