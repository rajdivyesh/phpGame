<?php
include_once 'dbconfig.php';


$stmt = $DB_con->prepare("SELECT p.registrationOrder, p.fName, p.lName, s.result, s.livesUsed, s.scoreTime
                            FROM player p, score s 
                            WHERE p.registrationOrder = s.registrationOrder");
$stmt->execute();
$scoreRaw=$stmt->fetchall();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome - history page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<h1>Player Scores</h1>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Result</th>
					<th>Lives Used</th>
					<th>Score Time</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($scoreRaw as $row) { ?>
					<tr>
						<td><?php echo $row['registrationOrder']; ?></td>
						<td><?php echo $row['fName']; ?></td>
						<td><?php echo $row['lName']; ?></td>
						<td><?php echo $row['result']; ?></td>
						<td><?php echo $row['livesUsed']; ?></td>
						<td><?php echo $row['scoreTime']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<!-- Bootstrap JS -->
	
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<?php include 'footer.php'; ?>
</body>
</html>
