<?php
require('../../src/dbconnect.php');

$message = '';
$error = '';

if (array_key_exists('submitBtn', $_POST)) {

    $first_name = trim($_POST['firstname']);
    $last_name = trim($_POST['lastname']);
    $phone = trim($_POST['phone']);
    $street = trim($_POST['street']);
    $postal_code = trim($_POST['postalcode']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($first_name && $last_name && $password && $street && $postal_code && $country && $city && $email && $password && $phone) {

        $sql = "INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country )
    VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country );
     ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':country', $country);
        $stmt->execute();

        if($sql) $message = 'One user has been created';

    } else {
        $error = 'All fields must be filled';
    }
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


    <div class="container">
        <br />
        <br />
        <div>
            <a class="btn btn-primary" href="users.php" role="button"> Admin dashboard </a>
        </div>

        <br />
        <br />

        <form method="POST">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="lastname" class="form-label"> Last name </label>
                        <input type="text" class="form-control" id="lastname" name="lastname">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone </label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="street" class="form-label">Street </label>
                        <input type="text" class="form-control" id="street" name="street">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="postalcode" class="form-label">Postal Code </label>
                        <input type="text" class="form-control" id="postalcode" name="postalcode">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="submitBtn" class="btn btn-primary">Submit</button>
        </form>
        <div class="mt-5">
        <?php
            if ($message) {
                echo "<p class='text-success'>
                     $message
                </p> ";
            };

            if ($error) {
                echo "  <p class='text-danger'>
                     $error
                </p>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous" defer></script>
</body>

</html>