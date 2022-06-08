<?php
require('../src/config.php');
require('../src/app/user_functions.php');
require('../src/app/common_functions.php');
include('./layout/header.php');



// Lösenordsskyddad, om SESSION inte är satt från login kan användaren inte komma åt sidan
checkLoginSession();


// Sätter meddelande till tomma
$succesMessage = "";
$message = "";

if(isset($_GET['updateSucces'])){
  $succesMessage = '
  <div class="alert alert-success message mx-auto">
      Succes! The post was updated
  </div>;
';
}

// Om querystring har värdet invalidUser, hantera felmeddelande
if(isset($_GET['invalidUser'])){
  $message = '
  <div class="alert alert-danger message mx-auto">
      Trying to updated invalid User! Please try again
  </div>;
  ';
}

// Tar bort användarkonto
if(isset($_POST['deleteAccountBtn'])) {
  $sql = "
  DELETE FROM users 
  WHERE id = :id;
  ";
  $statement = $dbconnect->prepare($sql);
  $statement->bindParam(':id', $_POST['userID']);
  $statement->execute();
}


// Hämtar alla användaruppgifter
$sql = "SELECT * FROM users";
$statement = $dbconnect->query($sql);
$users = $statement->fetchAll();
// fetchAllUsers();

?>


<div class="wrapper-register">
  <h1>Mina sidor</h1>
  </div>
  <?= $message ?>
  <?= $succesMessage ?>
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
            <!-- Delete knapp -->
            <form action="" method="POST">
              <input type="hidden" name="userID" value="<?= htmlentities($user['id']) ?>">
              <input type="submit" name="deleteAccountBtn" value="Delete">
            </form>
            <!-- Updatera knapp -->
            <form action="update-account.php" method="GET">
                <input type="submit" value="Update">
                <input type="hidden" name="userID" value="<?= htmlentities($user['id']) ?>">
            </form>
          </td>
        </tr>
        <?php endforeach ?>
  </tbody>
</table>


<footer id="footer" class="mt-auto  footer">


</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
