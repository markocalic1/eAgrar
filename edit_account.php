<?php 
// First we execute our common code to connection to the database and start the session
require("connection.php");

// At the top of the page we check to see whether the user is logged in or not
if (empty($_SESSION['user'])) {
    // If they are not, we redirect them to the login page.
    header("Location: login.php");

    // Remember that this die statement is absolutely critical.  Without it,
    // people can view your members-only content without logging in.
    die("Redirecting to login.php");
}

// This if statement checks to determine whether the edit form has been submitted
// If it has, then the account updating code is run, otherwise the form is displayed
if (!empty($_POST)) {
    // Make sure the user entered a valid E-Mail address
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Invalid E-Mail Address");
    }

    // If the user is changing their E-Mail address, we need to make sure that
    // the new value does not conflict with a value that is already in the system.
    // If the user is not changing their E-Mail address this check is not needed.
    if ($_POST['email'] != $_SESSION['user']['email']) {
        // Define our SQL query
        $query = "
            SELECT
                1
            FROM users
            WHERE
                email = :email
        ";

        // Define our query parameter values
        $query_params = array(
            ':email' => $_POST['email']
        );

        try { 
            // Execute the query
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex) {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            die("Failed to run query: " . $ex->getMessage());
        }

        // Retrieve results (if any)
        $row = $stmt->fetch();
        if ($row) {
            die("This E-Mail address is already in use");
        }
    }

    // If the user entered a new password, we need to hash it and generate a fresh salt
    // for good measure.
    if (!empty($_POST['password'])) {
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        $password = hash('sha256', $_POST['password'] . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $password = hash('sha256', $password . $salt);
        }
    }
    else {
        // If the user did not enter a new password we will not update their old one.
        $password = null;
        $salt = null;
    }

    // Initial query parameter values
    $query_params = array(
        ':email' => $_POST['email'],
        ':user_id' => $_SESSION['user']['id'],
    );

    // If the user is changing their password, then we need parameter values
    // for the new password hash and salt too.
    if ($password !== null) {
        $query_params[':password'] = $password;
        $query_params[':salt'] = $salt;
    }

    // Note how this is only first half of the necessary update query.  We will dynamically
    // construct the rest of it depending on whether or not the user is changing
    // their password.
    $query = "
        UPDATE users
        SET
            email = :email
    ";

    // If the user is changing their password, then we extend the SQL query
    // to include the password and salt columns and parameter tokens too.
    if ($password !== null) {
        $query .= "
            , password = :password
            , salt = :salt
        ";
    }

    // Finally we finish the update query by specifying that we only wish
    // to update the one record with for the current user.
    $query .= "
        WHERE
            id = :user_id
    ";

    try {
        // Execute the query
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex) {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query: " . $ex->getMessage());
    }

    // Now that the user's E-Mail address has changed, the data stored in the $_SESSION
    // array is stale; we need to update it so that it is accurate.
    $_SESSION['user']['email'] = $_POST['email'];

    // This redirects the user back to the members-only page after they register
    header("Location: index.php");

    // Calling die or exit after performing a redirect using the header function
    // is critical.  The rest of your PHP script will continue to execute and
    // will be sent to the user if you do not die or exit.
    die("Redirecting to index.php");

    $user_id=$_SESSION['user']['id'];

    
}

if (!empty($_POST)) {

    // Define our SQL query
    $query_post = "
    INSERT INTO `user_device` (`id`, `dev_id`) VALUES ('$user_id', '$_POST[device]');
    ";

    // Define our query parameter values

    try { 
            // Execute the query
            $stmt6 = $db->prepare($query_post);
            $result6 = $stmt6->execute();
    }
    catch(PDOException $ex) {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            
            echo "<script>alert('Ne postoji u bazi taj uređaj!!! ')</script>";
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>eAgrar</title>


    <link rel="icon" href="img/android-icon-144x144.png" type="image/x-icon"/>

    <link href="css/font-awesome.min.css" rel="stylesheet">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>


    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">


    </head>
<body>
<?php include('navbar.php');

?>

<div id="wrapper">

<?php include('sidebar.php');?>

<div id="content-wrapper">

	<div class="container-fluid">

	  <!-- Breadcrumbs-->
	  <ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="#">Uredi profil</a>
		</li>
		<li class="breadcrumb-item active">Pregled</li>
      </ol>

      <div class="row mx-auto">
        <form action="edit_account.php" method="post" class="validate-form">
                <div class = "form-group" data-validate="Username:">
                <label for = "username">Username</label>
                <input type = "username" class = "form-control" name="username" value="<?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>" disabled>
                </div>

                <div class = "form-group" data-validate = "Enter email">
                <label for = "email">Email</label>
                <input type = "email" class = "form-control" name="email" value="<?php echo htmlentities($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                
                <div class = "form-group" data-validate = "Enter password">
                <label for = "inputpassword">Password:<i>(leave blank if you do not want to change your password)</i></label>
                    <input type = "password" class = "form-control" 
                    name="password"  value="" placeholder="">
                </div>
                
                <button type = "reset" value="Reset" class = "btn btn-primary">Reset</button>

                <button type = "submit" value="Update" class = "btn btn-primary">Sign In</button>
            </form>

        
        </div>
     <hr>   

    </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>
<script src="js/easypiechart.js"></script>


<!-- Demo scripts for this page-->

  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/Chart.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>

	<script src="js/line_chart.js"></script>

	<script src="js/custom.js"></script>
	<script src="js/main.js"></script>

</body>
</html>