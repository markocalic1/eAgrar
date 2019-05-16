<?php
// First we execute our common code to connection to the database and start the session
require("connection.php");
 
// This if statement checks to determine whether the registration form has been submitted 
// If it has, then the registration code is run, otherwise the form is displayed 
if (!empty($_POST)) {
    // Ensure that the user has entered a non-empty username
    if (empty($_POST['username'])) {
        // Note that die() is generally a terrible way of handling user errors
        // like this.  It is much better to display the error with the form
        // and allow the user to correct their mistake.  However, that is an
        // exercise for you to implement yourself.
        die("Please enter a username.");
    }

    // Ensure that the user has entered a non-empty password
    if (empty($_POST['password'])) {
        die("Please enter a password.");
    }

    // Make sure the user entered a valid E-Mail address
    // filter_var is a useful PHP function for validating form input, see:
    // http://us.php.net/manual/en/function.filter-var.php
    // http://us.php.net/manual/en/filter.filters.php
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Invalid E-Mail Address");
    }

    // We will use this SQL query to see whether the username entered by the
    // user is already in use.  A SELECT query is used to retrieve data from the database.
    // :username is a special token, we will substitute a real value in its place when
    // we execute the query.
    $query = "
        SELECT
            1
        FROM users
        WHERE
            username = :username
    ";

    // This contains the definitions for any special tokens that we place in
    // our SQL query.  In this case, we are defining a value for the token
    // :username.  It is possible to insert $_POST['username'] directly into
    // your $query string; however doing so is very insecure and opens your
    // code up to SQL injection exploits.  Using tokens prevents this.
    // For more information on SQL injections, see Wikipedia:
    // http://en.wikipedia.org/wiki/SQL_Injection
    $query_params = array(
        ':username' => $_POST['username']
    );

    try {
        // These two statements run the query against your database table.
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex) {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query: " . $ex->getMessage());
    }

    // The fetch() method returns an array representing the "next" row from
    // the selected results, or false if there are no more rows to fetch.
    $row = $stmt->fetch();

    // If a row was returned, then we know a matching username was found in
    // the database already and we should not allow the user to continue.
    if ($row) {
        die("This username is already in use");
    }

    // Now we perform the same type of check for the email address, in order
    // to ensure that it is unique.
    $query = "
        SELECT
            1
        FROM users
        WHERE
            email = :email
    ";

    $query_params = array(
        ':email' => $_POST['email']
    );

    try { 
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage());
    }

    $row = $stmt->fetch();

    if($row) {
        die("This email address is already registered");
    }

    // An INSERT query is used to add new rows to a database table.
    // Again, we are using special tokens (technically called parameters) to
    // protect against SQL injection attacks.
    $query = "
        INSERT INTO users (
            username,
            password,
            salt,
            email
        ) VALUES (
            :username,
            :password,
            :salt,
            :email
        )
    ";

    // A salt is randomly generated here to protect again brute force attacks
    // and rainbow table attacks.  The following statement generates a hex
    // representation of an 8 byte salt.  Representing this in hex provides
    // no additional security, but makes it easier for humans to read.
    // For more information:
    // http://en.wikipedia.org/wiki/Salt_%28cryptography%29
    // http://en.wikipedia.org/wiki/Brute-force_attack
    // http://en.wikipedia.org/wiki/Rainbow_table
    $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));

    // This hashes the password with the salt so that it can be stored securely
    // in your database.  The output of this next statement is a 64 byte hex
    // string representing the 32 byte sha256 hash of the password.  The original
    // password cannot be recovered from the hash.  For more information:
    // http://en.wikipedia.org/wiki/Cryptographic_hash_function
    $password = hash('sha256', $_POST['password'] . $salt);

    // Next we hash the hash value 65536 more times.  The purpose of this is to
    // protect against brute force attacks.  Now an attacker must compute the hash 65537
    // times for each guess they make against a password, whereas if the password
    // were hashed only once the attacker would have been able to make 65537 different
    // guesses in the same amount of time instead of only one.
    for($round = 0; $round < 65536; $round++) { 
        $password = hash('sha256', $password . $salt);
    }

    // Here we prepare our tokens for insertion into the SQL query.  We do not
    // store the original password; only the hashed version of it.  We do store
    // the salt (in its plaintext form; this is not a security risk).
    $query_params = array(
        ':username' => $_POST['username'],
        ':password' => $password,
        ':salt' => $salt,
        ':email' => $_POST['email']
    );

    try { 
        // Execute the query to create the user
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex) {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query: " . $ex->getMessage());
    }

    // This redirects the user back to the login page after they register
    //header("Location: login.php");
    echo "
        <script type='text/javascript'>
        alert('Account created!');
        window.location.href='login.php';
        </script>";

    // Calling die or exit after performing a redirect using the header function
    // is critical.  The rest of your PHP script will continue to execute and
    // will be sent to the user if you do not die or exit.
    die("Redirecting to login.php");
}


?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!doctype html>
<html lang="en">
    <head>
        	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
    <?php include('header.php');?>
	<link rel="stylesheet" type="text/css" href="css/login_page.css">


    </head>
<body>

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

  <a class="navbar-brand mr-1 text-center" href="index.php"><span><img src="img/transparent_logo_crna_2.png" class="img-responsive" style="height: 45px;"?></span>eAgrar</a>

</nav>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card my-5">
			<div class="card-header">
				<h3>Registracija</h3>
				
			</div>
			<div class="card-body">
				<form action="register.php" method="post">
                    <span class=""><?php echo $errorbox?></span>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control"  name="username" placeholder="username" value="" required>
						
                    </div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="text" class="form-control"  type="text" name="email" placeholder="email" value="" required>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control"  name="password"  value="" placeholder="password" required>
					</div>
					
					<div class="form-group">
						<input type="submit" value="Potvrdi" class="btn float-center login_btn">
                    </div>
                    <div class="form-group">
						<input type="reset" value="Reset" class="btn float-center login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
                <div class="d-flex justify-content-center links">
					<a href="login.php"><button class="btn btn-success text-center">Prijava</button></a>
				</div>
				
				
			</div>
		</div>
	</div>
</div>



</body>
</html>