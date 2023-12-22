<?php
require "database.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    header("Location: index.php");
}

$nameError = $emailError = $mobileError = '';

if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $valid = true;

    $nameError = empty($name) ? 'Please enter Name' : '';
    $emailError = empty($email) ? 'Please enter Email Address' : (!filter_var($email, FILTER_VALIDATE_EMAIL) ? 'Please enter a valid Email Address' : '');
    $mobileError = empty($mobile) ? 'Please enter Mobile Number' : (preg_match("/^0[76][0-9]{8}$/", $mobile) ? 'Please enter valid Mobile Number' : '');

    if ($valid) {
        // Update data
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM customers WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute([$id]);
    $data = $q->fetch(PDO::FETCH_ASSOC);
    list($name, $email, $mobile) = [$data['name'], $data['email'], $data['mobile']];
    Database::disconnect();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Create Data!</title>
</head>

<body>

    <br><br>
    <div class="container">
        <div class="row">
            <h1>Update a Customer</h1>
        </div>
        <br>
        <form class="form-horizontal" action="update.php?id=<?= $id ?>" method="post">

            <!-- Form fields -->

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Update</button>
                <a class="btn btn-dark" href="index.php">Back</a>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>