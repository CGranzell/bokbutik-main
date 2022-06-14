<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header-public.php');

if (array_key_exists('getProduct', $_POST)) {

  $product = $_POST['product'];
  $sql = $dbconnect->prepare('SELECT * FROM products WHERE title LIKE :keyword OR description LIKE :keyword ORDER BY title');
  $sql->bindValue(':keyword', '%' . $product . '%', PDO::PARAM_STR);
  $sql->execute();
  $result = $sql->fetchAll();
}

?>


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
