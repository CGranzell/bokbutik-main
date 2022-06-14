<?php
require('../../src/config.php');
include(LAYOUT_PATH_ADMIN . 'header-admin.php');

$stmt = $pdo->query('SELECT * FROM users');
$users = $stmt->fetchAll();

if (array_key_exists('deleteBtn', $_POST)) {

    $id = $_POST['deleteBtn'];
    $sql = $pdo->prepare('DELETE FROM users WHERE id = :id')->execute(['id' => $id]);

    if ($sql) header("Refresh:0");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="mt-5 container">
        <div>
            <a class="btn btn-primary" href="create_user.php" role="button"> Create new user </a>
        </div>


        <br />
        <br />

        <table class="table border p-2">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name </th>
                    <th scope="col">Email</th>
                    <th scope="col">Password </th>
                    <th scope="col"> Phone </th>
                    <th scope="col"> Street </th>
                    <th scope="col"> Postal Code</th>
                    <th scope="col"> City </th>
                    <th scope="col"> Country </th>
                    <th scope="col"> Joined </th>
                    <th scope="col"> Actions </th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($users as $user) { ?>
                    <tr>
                        <th scope="row"> <?= $user['id'] ?> </th>
                        <td> <?= htmlentities($user['first_name']) ?> </td>
                        <td> <?= htmlentities($user['last_name']) ?> </td>
                        <td> <?= htmlentities($user['email']) ?> </td>
                        <td> <?= htmlentities($user['password']) ?> </td>
                        <td> <?= htmlentities($user['phone']) ?> </td>
                        <td> <?= htmlentities($user['street']) ?> </td>
                        <td> <?= htmlentities($user['postal_code']) ?> </td>
                        <td> <?= htmlentities($user['city']) ?> </td>
                        <td> <?= htmlentities($user['country']) ?> </td>
                        <td> <?= htmlentities($user['create_date']) ?> </td>
                        <td>
                            <div class="d-flex flex-row">
                                <div class="p-2"> <a class="btn btn-primary" href="edit_user.php?id=<?= $user['id'] ?> "> Edit </a> </div>
                                <div class="p-2">
                                    <form method="POST"><button type="submit" class="btn btn-danger" name="deleteBtn" value="<?= $user['id'] ?> "> Delete </button></form>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>





    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous" defer></script>
</body>

</html>