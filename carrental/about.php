<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>HelloCab | About Us</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="css/style.css" rel="stylesheet"> 

</head>

<body id="body"> 

 <section id="innerBanner"> 
 <?php include('includes/header.php');?>
  <div class="inner-content">
    <h2>About Us</h2>
    <p>We provide high quality cars</p>
    <div> 
    </div>
  </div> 
</section>

<main id="main">
      <section id="about" class="wow fadeInUp">
        <div class="container"> 
          <div class="row">
            <div class="col-lg-6 about-img">
              <img src="img/a.png" alt="">
            </div>

            <div class="col-lg-6 content" style="margin-top: 150px;">
              <h2>Focused on safety, wherever you go</h2>
              <p>With every safety feature and every standard in our Community Guidelines, we're committed to helping to create a safe environment for our users.</p>
              <ul>
                <li><i class="fa-solid fa-location-dot"></i> We reimagine the way the world moves for the better</li>
                <li><i class="fa-solid fa-location-dot"></i> It’s our goal to create a workplace that is inclusive and reflects the diversity of the cities we serve</li>
                <li><i class="fa-solid fa-location-dot"></i></i> Our technology helps us develop and maintain multisided platforms that match consumers looking for rides</li>
              </ul> 
            </div>
          </div>

        </div>
      </section>
    </main>
    <?php include('includes/footer.php');?>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/sticky/sticky.js"></script> 
    <script src="contact/jqBootstrapValidation.js"></script>
    <script src="contact/contact_me.js"></script>
    <script src="js/main.js"></script>

  </body>
  </html>
