<?php 

    // Database Connection
    try {
        $con = new PDO("mysql:host=localhost;dbname=learn_sql", 'root', '');
    } catch (\Throwable $error) {

    }

    $id = $_GET['id'];

    // Get user record to show in inputs to provide user friendly interface
    $query = $con->prepare("SELECT * FROM users WHERE id='$id'");
    $query->execute();
    $user = $query->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <div class="container pt-5 pb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <h4>Edit Record here</h4>
                <form action="edit.php" method="POST" class="mt-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" placeholder="YOUR FULL NAME" />
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" placeholder="YOUR EMAIL ADDRESS" />
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="<?php echo $user['password']; ?>" name="password" placeholder="YOUR PASSWORD" />
                    </div>

                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>" />
                    <button class="btn btn-primary" type="submit" name="submit">Update Record</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php

    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = $con->prepare("UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$id' ");
        $query->execute();

        echo "<script>window.open('index.php','_self')</script>";

    }

?>
