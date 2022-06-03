<?php
require('../src/config.php');
// Hämtar alla användaruppgifter
$sql = "SELECT * FROM users";
$statement = $dbconnect->query($sql);
$users = $statement->fetchAll();

// echo "<pre>";
// print_r($users);
// echo "</pre>";

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <title>Mina Sidor</title>
</head>
<body>
  <h1>Mina sidor</h1>
  <!-- Tabell över Användarens uppgifter -->
  <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Phone</th>
      <th scope="col">Street</th>
      <th scope="col">Postal Code</th>
      <th scope="col">City</th>
      <th scope="col">country</th>
      <th scope="col">Create date</th>
      <th scope="col">Manage</th>

    </tr>
  </thead>
  <tbody>
     <!-- Loopar igenom users -->
       <?php foreach($users as $user) : ?>
        <tr>
          <td scope="row"><?= htmlentities($user['id']) ?></td>
          <td scope="row"><?= htmlentities($user['first_name']) ?></td>
          <td scope="row"><?= htmlentities($user['last_name']) ?></td>
          <td scope="row"><?= htmlentities($user['email']) ?></td>
          <td scope="row"><?= htmlentities($user['password']) ?></td>
          <td scope="row"><?= htmlentities($user['phone']) ?></td>
          <td scope="row"><?= htmlentities($user['street']) ?></td>
          <td scope="row"><?= htmlentities($user['postal_code']) ?></td>
          <td scope="row"><?= htmlentities($user['city']) ?></td>
          <td scope="row"><?= htmlentities($user['country']) ?></td>
          <td scope="row"><?= htmlentities($user['create_date']) ?></td>
          <td scope="row">
            <input type="submit" value="Delete">
            <input type="submit" value="Update">
          </td>
        </tr>
        <?php endforeach ?>
  </tbody>
</table>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>