<?php 

    // Database Connection
    try {
        $con = new PDO("mysql:host=localhost;dbname=learn_sql", 'root', '');
    } catch (\Throwable $error) {

    }

    // Records Fetch
    $query = $con->prepare("SELECT * FROM users");
    $query->execute();
    $records = $query->fetchAll();

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
                <h4>Register here</h4>
                <form action="index.php" method="POST" class="mt-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="YOUR FULL NAME" />
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="YOUR EMAIL ADDRESS" />
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="YOUR PASSWORD" />
                    </div>

                    <button class="btn btn-primary" type="submit" name="submit">Register</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Display Records -->

                <tr>
                    <td>Awais</td>
                    <td>a@gmail.com</td>
                    <td>test123</td>
                    <td>
                        <a href="edit.php?id='<?php echo $obj['id']; ?>'">
                            <button class="btn btn-info btn-sm">Edit</button>
                        </a>
                        <form action="#" method="POST">
                            <button type="submit" name="deleteBtn" value="<?php echo $obj['id']; ?>" class="btn btn-info btn-sm mx-2">Delete</button>
                        </form>
                    </td>
                </tr>
               
                <?php
                    foreach($records as $obj)
                    {
                        $html = "<tr>";
                        $html .= "<td>".$obj['name']."</td>";
                        $html .= "<td>".$obj['email']."</td>";
                        $html .= "<td>".$obj['password']."</td>";
                        $html .= '<td class="d-flex">';
                        $html .= '<a href="edit.php?id='.$obj['id'].'"><button class="btn btn-info btn-sm">Edit</button></a>';
                        $html .= '<form action="#" method="POST"><button type="submit" name="deleteBtn" value="'.$obj['id'].'" class="btn btn-info btn-sm mx-2">Delete</button></form>';
                        $html .= "</td>";
                        $html .= "</tr>";

                        echo $html;
                    }
                ?>

            </tbody>
        </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php

    // Check if form is submitted.
    // Incase form is submitted than $_POST will contain array of all submitted data
    if( isset($_POST['submit']) ) 
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // validating all values.
        // Incase value is empty then show error and end the script
        if($name == '')
        {
            echo "Error! name is required";
            exit();
        }
        if($email == '')
        {
            echo "Error! email is required";
            exit();
        }
        if($password == '')
        {
            echo "Error! password is required";
            exit;
        }


        // SAVE IN DB
        $query = $con->prepare("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password') ");
        $query->execute();

        // Redirecting user to index.php file to refresh our table
        // header("Location: index.php");
        
        echo "<script>window.open('index.php', '_self')</script>";
    }

    // Delete Record
    if(isset($_POST['deleteBtn']))
    {
        $id = $_POST['deleteBtn'];
        
        $query = $con->prepare("DELETE FROM users WHERE id='$id'");
        $query->execute();

        echo "<script>window.open('index.php','_self')</script>";
    }

?>


<!-- methods of redirection -->
<script>
    // window.location.href = 'https://google.com'

    // window.open('index.php', '_self');

    // $(window).reload();
</script>