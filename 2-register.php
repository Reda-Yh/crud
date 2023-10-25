<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Login &amp; Register Forms</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>
<body>
<?php

// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=users_db';
$username = 'root';
$password = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch();

    if ($row) {
        $message[] = 'User already exists';
    } else {
        if ($password != $cpassword) {
            $message[] = 'Confirm password not matched!';
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)");
            $stmt->execute(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'password' => $password]);

            $insertedRows = $stmt->rowCount();
            if ($insertedRows > 0) {
                $message[] = 'Registered successfully!';
                header('Location: 1-login.php');
                exit;
                } else {
                $message[] = 'Registration failed!';
            }
        }
     }
}
?>
    <!-- Top content -->
    <div class="top-content">
        
        <div class="inner-bg">
            <div class="container">
                
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><strong>Bootstrap</strong> Register Form</h1>
                        <div class="description">
                            <p>
                                This is a free responsive <strong>"register form"</strong> template made with Bootstrap. 
                                Download it on <a href="http://azmind.com" target="_blank"><strong>AZMIND</strong></a>, 
                                customize and use it as you like!
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        
                        <div class="form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Sign up now</h3>
                                    <p>Fill in the form below to get instant access:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="" method="post" class="registration-form">
                                <?php
                                    if(isset($message)){
                                        foreach($message as $message){
                                            echo '<div class="message">'.$message.'</div>';
                                        }
                                    }
                                ?>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-first-name2">First name</label>
                                        <input type="text" name="firstname" placeholder="First name..." class="form-first-name2 form-control" id="form-first-name2">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-last-name2">Last name</label>
                                        <input type="text" name="lastname" placeholder="Last name..." class="form-last-name2 form-control" id="form-last-name2">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email2">Email</label>
                                        <input type="text" name="email" placeholder="Email..." class="form-email2 form-control" id="form-email2">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password2">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password2 form-control" id="form-password2">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password2">Password</label>
                                        <input type="password" name="cpassword" placeholder="Password..." class="form-password2 form-control" id="form-password2">
                                    </div>
                                    <input type="submit" class="btn" name="submit" value="login now">
                                    <p> Already have account ?</p><a href="1-login.php">Sign me up!</a>
                                </form>
                            </div>
                        </div>
                        <div class="social-login">
                            <h3>...or login with:</h3>
                            <div class="social-login-buttons">
                                <a class="btn btn-link-1 btn-link-1-facebook" href="#">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>
                                <a class="btn btn-link-1 btn-link-1-twitter" href="#">
                                    <i class="fa fa-twitter"></i> Twitter
                                </a>
                                <a class="btn btn-link-1 btn-link-1-google-plus" href="#">
                                    <i class="fa fa-google-plus"></i> Google Plus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="footer-border"></div>
                <p>Made by REDA YAHYA</p>
            </div>
        </div>
    </div>
</footer>

<!-- Javascript -->
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="assets/js/placeholder.js"></script>
<![endif]-->

</body>
</html>
