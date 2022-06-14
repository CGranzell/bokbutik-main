<?php

require('../src/dbconnect.php');

if (array_key_exists('getProduct', $_POST)) {

  $product = $_POST['product'];
  $sql = $dbconnect->prepare('SELECT * FROM products WHERE title LIKE :keyword OR description LIKE :keyword ORDER BY title');
  $sql->bindValue(':keyword', '%' . $product . '%', PDO::PARAM_STR);
  $sql->execute();
  $result = $sql->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title>Document</title>
</head>
<body >

<div class="p-5">
<div style="width: 20rem;">
    <form class="d-flex flex-row"  method="POST">
      <input type="text" class="form-control" placeholder="Enter product name" name="product" />
      <button type="submit" class="btn btn-primary" name="getProduct"> Submit </button>
    </form>
  </div>

  <div class="card mb-5 "  style='width:20rem;'>
  <ul class="list-group">
    <?php foreach ($result as $key) {
    ?>
      <li class="list-group-item"> <a href="#"  class="text-decoration-none"> <?= htmlentities($key['title']) ?>  </a> </li>

    <?php } ?>

  </ul>
</div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
