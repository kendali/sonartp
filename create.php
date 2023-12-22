<?php
require 'database.php';


if (!empty($_POST)) {
    $nameError = $emailError = $mobileError = null;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $valid = true;

    if (empty($name)) {
        $nameError = 'Please enter Name';
        $valid = false;
    }

    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Please enter a valid Email Address';
        $valid = false;
    }

    if (empty($mobile)) {
        $mobileError = 'Please enter Mobile Number';
        $valid = false;
    }

    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO customers (name, email, mobile) values(?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute([$name, $email, $mobile]);
        Database::disconnect();
        header("Location: index.php");
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Create Data!</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>Create a Customer</h1>
        </div>
        <br>
        <form class="form-horizontal" action="create.php" method="post">
            <?php foreach (['name', 'email', 'mobile'] as $field) : ?>
            <div class="form-group <?php echo !empty(${$field.'Error'}) ? 'error' : ''; ?>">
                <label class="control-label"><?php echo ucfirst($field); ?></label>
                <div class="form-group">
                    <input class="form-control" name="<?php echo $field; ?>" type="text"
                        placeholder="<?php echo ucfirst($field); ?>"
                        value="<?php echo !empty(${$field}) ? ${$field} : ''; ?>" style="width: 500px">
                    <?php if (!empty(${$field.'Error'})) : ?>
                    <span class="help-inline"><?php echo ${$field.'Error'}; ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Create</button>
                <a class="btn btn-dark" href="index.php">Back</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>