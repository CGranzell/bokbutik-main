<?php

require('../src/config.php');
echo "<pre>";
print_r(PDO::getAvailableDrivers());
echo "</pre>";

$sql = "SELECT * FROM users";
$statement = $dbconnect->query($sql);
$users = $statement->fetchAll();


?>


<!DOCTYPE html>
<html>
<head>
	<title>Lo</title>
</head>
<body>
	<h1>Log in sida</h1>
	<p>Hallå </p>

</body>
</html>
