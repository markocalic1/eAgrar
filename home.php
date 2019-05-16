<?php
	// First we execute our common code to connection to the database and start the session
  require("connection.php");

// At the top of the page we check to see whether the user is logged in or not
  if (!empty($_SESSION['user'])) { 
    // If they are not, we redirect them to the login page.
    header("Location: index.php");

    // Remember that this die statement is absolutely critical.  Without it,
    // people can view your members-only content without logging in.
    die("Redirecting to index.php");
}

  else{
  }
?>
<!DOCTYPE html>
<html lang="en">

<head> 
<meta name="google-site-verification" content="nKTYL4gR4eeCNNcaFTKWMU4ktbBjnYthBcMEyJSSVnA" />
<?php include('header.php');?>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand text-center" href="index.php" title="eAgrar-početna"><span><img src="img/transparent_logo_crna_2.png" class="img-responsive" style="height: 45px;" alt="eagrar_logo"></span>
        eAgrar
      </a>

      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Mjerne stanice 
      </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="http://glamoc.eagrar.eu/">Glamoč</a>
          
        </div>
      </div>
    
        <a class="btn btn-primary" href="login.php" title="Prijava">Prijava</a>
    </div>
        
  </nav>

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5 d-flex justify-content-center  font-weight-bold">eAgrar</h1>
          <h3 class="mb-5 d-flex justify-content-center ">New dimension of agriculture</h3>
          <a href="http://blog.eagrar.eu" class="btn btn-success btn-user " title="eAgrar Blog">
                      Check our eAgrar Blog
                    </a>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            
          
        </div>
      </div>
    </div>
  </header>

  <!-- Icons Grid -->
  <section class="features-icons bg-light text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-screen-desktop m-auto text-primary"></i>
            </div>
            <h3>Kompletan pregled i analiza podataka</h3>
            <p class="lead mb-0">Svi podatci koji su vam potrebni sa </p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-chart m-auto text-primary"></i>
            </div>
            <h3>Grafički pregled</h3>
            <p class="lead mb-0">Pokazuje promjenu vrijednosti tijekom vremena</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="fas fa-microchip m-auto text-primary"></i>
            </div>
            <h3>Vlastita arhitektura</h3>
            <p class="lead mb-0">Dizajnirali smo vlastiti hardware i software</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Image Showcases -->
  <section class="showcase">
    <div class="container-fluid p-0">
      <div class="row no-gutters">

        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/overview-home.png');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>Kompletan pregled i analiza podataka</h2>
          <p class="lead mb-0"> </p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/eagrar-vinograd.webp');     background-position: center;"></div>
        <div class="col-lg-6 my-auto showcase-text">
          <h2>Vaši su podatci sigurni</h2>
          <p class="lead mb-0"></p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/eagrar-otvoreniuredaj.webp');     background-position-y: center; "></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>Easy to Use &amp; Customize</h2>
          <p class="lead mb-0"></p>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="call-to-action text-white bg-dark text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h2 class="mb-4">Ready to get started?Contact us now!</h2>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <form method="POST" name="contactform" action="contact-form-handler.php">
            <div class="form-row">
              <div class="col-12 col-md-9 mb-2 mb-md-0">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter your email..." required>
              </div>
              <div class="col-12 col-md-9 mb-2 mb-md-0 mt-1">
                <input type="text" name="message" class="form-control form-control-lg" placeholder="Message">
              </div>
              
              <div class="col-12 col-md-3">
                <button type="submit" value="Submit" class="btn btn-block btn-lg btn-primary">Sign up!</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
 
  <!-- Footer -->
  <footer class="page-footer  bg-dark pt-4">

      <!-- Footer Elements -->
      <div class="container">
        <div class="row mx-auto d-block">
          <h5 class="text text-center text-light text-uppercase">Projekt podržavaju</h5>
          <div class="row justify-content-center pt-4">
            <a class="logo px-4" href="http://www.scst.hr" title="Studentski centar Split">
              <img class="img-responsive" style="height:80px;" src="img/scst1.png" alt="SCST logo">
            </a>
            <a class="logo px-4" href="http://www.szst.unist.hr" title="Studentski zbor u Splitu">
            <img class="img-responsive" style="height:80px;" src="img/szst.png" alt="SZST logo">
            </a>
          </div>
        </div>
      <hr>
        <!-- Social buttons -->
        <ul class="list-unstyled list-inline text-center text-light">
          <li class="list-inline-item">
            <a class="btn-floating btn-fb mx-1">
              <i class="fab fa-facebook-f" title="facebook"> </i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-tw mx-1" title="twitter">
              <i class="fab fa-twitter"> </i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-gplus mx-1" title="instagram">
              <i class="fab fa-instagram"> </i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-li mx-1">
              <i class="fab fa-linkedin-in" title="linked-in"> </i>
            </a>
          </li>
          
        </ul>
        <!-- Social buttons -->
    
      </div>
      <!-- Footer Elements -->
    
      <!-- Copyright -->
      <div class="footer-copyright text-center text-white bg-dark py-3 text-light">© 2019 Copyright:
        <a class="text-white" href="" title="eagrar"> eAgrar</a>
      </div>
      <!-- Copyright -->
    
    </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>$('.dropdown-toggle').dropdown()</script>
  <?php require_once('counter.php');?>

</body>

</html>
