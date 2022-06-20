<?php
require('../src/config.php');
$product = $_POST['product'];
$result = $userDbHandler->searchProduct($product);

foreach ($result as $key) {
?>
    <li class="list-group-item"> <a href="specific-product.php?productID=<?= $key['id'] ?>" class="text-decoration-none"> <?= htmlentities($key['title']) ?> </a> </li>
<?php }


?>