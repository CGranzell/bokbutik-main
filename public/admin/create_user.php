<?php
require('../../src/config.php');
include(LAYOUT_PATH_ADMIN . 'header-admin.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script>
        // Jquery code

        $(document).ready(function() {
            $('#myForm').submit(async function(e) {
                e.preventDefault();
                const formdata = new FormData(e.target);
                formdata.set('submitBtn', true);
                if (formdata.get('firstname') && formdata.get('lastname') && formdata.get('email') && formdata.get('password') && formdata.get('street') && formdata.get('postalcode') && formdata.get('city') && formdata.get('country')) {

                    if (isNaN(formdata.get('phone')) || isNaN(formdata.get('postalcode'))) {
                        $('.alert-success').html('').addClass('d-none');
                        $('.alert-danger').html('Phone number and Postal Code must be numbers').removeClass('d-none');

                    } else {
                        $('.alert-danger').html('').addClass('d-none');
                        try {
                            const response = await fetch('add_user.php', {
                                method: 'POST',
                                body: formdata
                            });
                            const data = await response.json();
                            if (data[0] === 500) {
                                $('.alert-danger').html(data[1]).removeClass('d-none');
                            } else {
                                $('.alert-success').html(data).removeClass('d-none');
                            }
                        } catch (error) {
                            $('.alert-danger').html(error).removeClass('d-none');
                        }
                    }

                } else {
                    $('.alert-danger').html('All fields must be filled').removeClass('d-none');

                }
            })
        })
    </script>
</head>

<body>
    <div class="container">

        <div class="my-5">
            <a class="btn btn-primary" href="users.php" role="button"> Admin dashboard </a>
        </div>


        <form id="myForm" method="POST" class="border rounded p-3">
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
            <p class='d-none alert alert-success mx-auto'> </p>
            <p class='d-none alert alert-danger mx-auto'></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous" defer></script>
</body>

</html>

<?php
include(LAYOUT_PATH_ADMIN . 'footer.php');
?>