<?php
require_once "connect.php";


if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}



$username = $password = "";
$username_err = $password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty(trim($_POST["username"]))) {
        $username_err = "Mohon input username atau email anda.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Mohon input password anda.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id , email,password FROM guest WHERE first_name = ? OR email = ? LIMIT 1";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_username);

            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $username;

                            header("location: index.php");
                        } else {

                            $password_err = "Password Yang di Masukkan Salah !";
                        }
                    }
                } else {
                    $username_err = "Akun Tidak Terdaftar !";
                }
            } else {
                echo "Oops! Something went wrong. Please Try Again Later";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style type="text/css">
        body {

            font: 14px sans-serif;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;

  background-color: #ccc;


        }

        .wrapper {
            width: 350px;
            padding: 20px;
            background-color: lightslategray;
        }
    </style>
</head>

<body>
    <div class="container py-5 d-flex justify-content-center ">
        <div class=" wrapper text-white ">
            <h3>Login</h1>
            <br>
            <br>
            <form method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <i class="fas fa-user"> Username</i><input type="text" name="username" class="form-control" placeholder="Email/Username">
                    <span class="help-block bg-danger"><?php echo $username_err; ?></span>
                </div>
                <br>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <i class="fas fa-key"> Password</i><input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="help-block bg-danger"><?php echo $password_err;
                                                        echo "<br>"; ?></span>
                    <br>
                    <p>Signup <a href="signup.php" class="text-warning">Here</a>.</p>
                    <br>
            </div> 
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-dark" value="Login"></input>
                    <br> <br>
                    <a href="index.php " class="form-control btn btn-secondary">View</a> <br> 

                </div>




            </form>
        </div>
    </div>
</body>

</html>