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

session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :pass");
    $stmt->execute(['email' => $email, 'pass' => $pass]);
    $row = $stmt->fetch();

    if ($row) {
        $_SESSION['user_id'] = $row['id'];
        header('Location: index.php');
        exit;
    } else {
        $message[] = 'Incorrect email or password!';
        // header('Location: erreur.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login &amp; Register Forms</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>
<body>

    <!-- Top content -->
    <div class="top-content">
        
        <div class="inner-bg">
            <div class="container">
                <!-- col-sm-6 col-sm-offset-3 text-center -->
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 text">
                        <h1><strong>Bootstrap</strong> Login Form</h1>
                        <div class="description">
                            <p>
                                This is a free responsive <strong>"login form"</strong> template made with Bootstrap. 
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
                                    <h3>Login to our site</h3>
                                    <p>Enter username and password to log on:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="" method="post" class="login-form">
                                    <?php
                                        if(isset($message)){
                                            foreach($message as $message){
                                                echo '<div class="message">'.$message.'</div>';
                                            }
                                        }
                                    ?>
                                    <!-- <div class="form-group">
                                        <label class="sr-only" for="form-username">Username</label>
                                        <input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username">
                                    </div> -->
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email">Email</label>
                                        <input type="text" name="email" placeholder="Email..." class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                                    </div>
                                    <input type="submit" class="btn" name="submit" value="login now">
                                    <p> Create new account ? <a href="2-register.php">Sign in! </a></p>
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
                
            </div>
        </div>
        
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="footer-border"></div>
                    <p>Made by Anli Zaimi at <a href="http://azmind.com" target="_blank"><strong>AZMIND</strong></a> 
                        having a lot of fun. <i class="fa fa-smile-o"></i></p>
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

