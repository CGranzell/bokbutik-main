<?php
require('../src/config.php');
$product = $_POST['product'];
$sql = $dbconnect->prepare('SELECT * FROM products WHERE title LIKE :keyword OR description LIKE :keyword ORDER BY title');
$sql->bindValue(':keyword', '%' . $product . '%', PDO::PARAM_STR);
$sql->execute();
$result = $sql->fetchAll();

foreach ($result as $key) {
?>
    <li class="list-group-item"> <a href="#" class="text-decoration-none"> <?= htmlentities($key['title']) ?> </a> </li>
<?php }


?>