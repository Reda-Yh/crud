	<title>Sign up - Progressus Bootstrap template</title>
	<?php require_once('headfoot\header.php') ?>
	<?php

// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=user2';
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
                header('Location: signin.php');
                exit;
                } else {
                $message[] = 'Registration failed!';
            }
        }
     }
}
?>
<body>
	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Registration</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Registration</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Register a new account</h3>
							<p class="text-center text-muted">Lorem ipsum dolor sit amet, <a href="signin.php">Login</a> adipisicing elit. Quo nulla quibusdam cum doloremque incidunt nemo sunt a tenetur omnis odio. </p>
							<hr>

							<form>
								<div class="top-margin">
									<label>First Name</label>
									<input type="text" class="form-control" name="firstname">
								</div>
								<div class="top-margin">
									<label>Last Name</label>
									<input type="text" class="form-control" name="lastname">
								</div>
								<div class="top-margin">
									<label>Email Address <span class="text-danger">*</span></label>
									<input type="email" class="form-control" name="email">
								</div>

								<div class="row top-margin">
									<div class="col-sm-6">
										<label>Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" name="password">
									</div>
									<div class="col-sm-6">
										<label>Confirm Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" name="cpassword">
									</div>
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<label class="checkbox">
											<input type="checkbox"> 
											I've read the <a href="page_terms.php">Terms and Conditions</a>
										</label>                        
									</div>
									<div class="col-lg-4 text-right">
										<!-- <button class="btn btn-action" type="submit">Register</button> -->
										<input type="submit" class="btn btn-action" name="submit" value="Sign in">
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				
			</article>
			<!-- /Article -->

		</div>
	</div>	<!-- /container -->
	
	<?php require_once('headfoot\footer.php') ?>