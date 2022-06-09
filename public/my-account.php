<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header.php');

// Lösenordsskyddad, om SESSION inte är satt från login kan användaren inte komma åt sidan
checkLoginSession();
// Sätter meddelande till tomma
$succesMessage = "";
$message = "";
// meddelande om uppdatering lyckades
if(isset($_GET['updateSucces'])){
  $succesMessage = uppdateSucces($succesMessage);
}
// Om querystring har värdet invalidUser, hantera felmeddelande
if(isset($_GET['invalidUser'])){
  $message = invalidUser($message);
}
// Tar bort användarkonto
if(isset($_POST['deleteAccountBtn'])) {
  $userDbHandler->deleteUser(); 
  redirect("logout-account", "succesDelete");
}
// // Hämtar en användares uppgifter
$user = $userDbHandler->fetchOneUser($_SESSION['id']);
?>
 
<div class="wrapper-register">
  <h1>Mina sidor</h1>
  </div>
  <?= $message ?>
  <?= $succesMessage ?>
<!-- Visar Användarens uppgifter -->
  <div class="card form mx-auto">
  <div class="card-body">
    <h5 class="card-title">Mina uppgifter</h5>
    
      <p class="card-text"><?= htmlentities($user['first_name']) ?> <?= htmlentities($user['last_name']) ?></p>
      <p class="card-text"><?= htmlentities($user['email']) ?></p>
      <p class="card-text"><?= htmlentities($user['phone']) ?></p>
      <p class="card-text"><?= htmlentities($user['street']) ?></p>
      <p class="card-text"><?= htmlentities($user['postal_code']) ?></p>
      <p class="card-text"><?= htmlentities($user['city']) ?></p>
      <p class="card-text"><?= htmlentities($user['country']) ?></p>
      <p class="card-text"><?= htmlentities($user['create_date']) ?></p>
   
    <!-- Delete knapp -->
      <form action="" method="POST">
        <input type="hidden" name="userID" value="<?= htmlentities($user['id']) ?>">
        <input type="submit" name="deleteAccountBtn" value="Delete" class="btn btn-primary">
      </form>
    <!-- Uppdatera knapp -->
      <form action="update-account.php" method="GET">
        <input type="submit" value="Update" class="btn btn-primary">
        <input type="hidden" name="userID" value="<?= htmlentities($user['id']) ?>">
      </form>
      
  </div>
</div>


<?php 
include(LAYOUT_PATH . 'footer.php');
?>
