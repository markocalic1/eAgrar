<?php
// First we execute our common code to connection to the database and start the session
require("connection.php");

// This variable will be used to re-display the user's username to them in the
// login form if they fail to enter the correct password.  It is initialized here
// to an empty value, which will be shown if the user has not submitted the form.
$submitted_username = '';

// This if statement checks to determine whether the login form has been submitted
// If it has, then the login code is run, otherwise the form is displayed
if (!empty($_POST)) {
    // This query retreives the user's information from the database using
    // their username.
    $query = "
        SELECT
            id,
            username,
            password,
            salt,
            email
        FROM users
        WHERE
            username = :username
    ";

    // The parameter values
    $query_params = array(
        ':username' => $_POST['username']
    );

    try { 
        // Execute the query against the database
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex) { 
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query: " . $ex->getMessage());
    }

    // This variable tells us whether the user has successfully logged in or not.
    // We initialize it to false, assuming they have not.
    // If we determine that they have entered the right details, then we switch it to true.
    $login_ok = false;

    // Retrieve the user data from the database.  If $row is false, then the username
    // they entered is not registered.
    $row = $stmt->fetch();
    if ($row) { 
        // Using the password submitted by the user and the salt stored in the database,
        // we now check to see whether the passwords match by hashing the submitted password
        // and comparing it to the hashed version already stored in the database.
        $check_password = hash('sha256', $_POST['password'] . $row['salt']);
        for ($round = 0; $round < 65536; $round++) {
            $check_password = hash('sha256', $check_password . $row['salt']);
        }
        if ($check_password === $row['password']) { 
            // If they do, then we flip this to true
            $login_ok = true;
        }
    }

    // If the user logged in successfully, then we send them to the private members-only page
    // Otherwise, we display a login failed message and show the login form again
    if ($login_ok) { 
        // Here I am preparing to store the $row array into the $_SESSION by
        // removing the salt and password values from it.  Although $_SESSION is
        // stored on the server-side, there is no reason to store sensitive values
        // in it unless you have to.  Thus, it is best practice to remove these
        // sensitive values first.
        unset($row['salt']);
        unset($row['password']);

        // This stores the user's data into the session at the index 'user'.
        // We will check this index on the private members-only page to determine whether
        // or not the user is logged in.  We can also use it to retrieve
        // the user's details.
        $_SESSION['user'] = $row;

        // Redirect the user to the private members-only page.
        header("Location: index.php");
        die("Redirecting to: index.php");
    }
    else {
        // Tell the user they failed
        $errorbox="Failed username or password";

        // Show them their username again so all they have to do is enter a new
        // password.  The use of htmlentities prevents XSS attacks.  You should
        // always use htmlentities on user submitted values before displaying them
        // to any users (including the user that submitted them).  For more information:
        // http://en.wikipedia.org/wiki/XSS_attack
        $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
    }
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

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

  <a class="navbar-brand mr-1text-center" href="index.php"><span><img src="img/transparent_logo_crna_2.png" class="img-responsive" style="height: 45px;"?></span>eAgrar</a>

</nav>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card my-5">
			<div class="card-header">
				<h3>Prijava</h3>
				
			</div>
			<div class="card-body">
				<form action="login.php" method="post">
                    <span class=""><?php echo $errorbox?></span>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="username" placeholder="username or email" value="<?php echo $submitted_username; ?>">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="password"  value="">
					</div>
					
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Nemaš korisnički profil?<a href="register.php">Registriraj se</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#" disabled>Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>



	
</body>
</html>