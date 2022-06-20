
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <title>Document</title>
  <script>
    //JQuery code

    $(document).ready(() => {
      $(".form-control").on("input", function() {
        $(".list-group").load("search_result.php", {
          product: $(this).val()
        })
      });
    })
  </script>
</head>

<body>

  <div class="p-5">
    <div style="width: 20rem;">
      <form class="d-flex flex-row" method="POST">
        <input type="text" class="form-control" placeholder="Enter product name" name="product" />
      </form>
    </div>

    <div class="card mb-5 " style='width:20rem;'>
      <ul class="list-group"></ul>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>