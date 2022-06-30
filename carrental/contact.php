<?php 
session_start();
include('includes/config.php');
error_reporting(0);
//error_reporting(0);
if(isset($_POST['submit']))
{
$fname=$_POST['fullname'];
$email=$_POST['email']; 
$message=$_POST['message'];
$sql="INSERT INTO  feedback (fullname,email,message) VALUES(:fullname,:email,:message)";
$query = $dbh->prepare($sql);
$query->bindParam(':fullname',$fname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Thanks For Your Feedback');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>HelloCab</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="css/style.css" rel="stylesheet"> 
</head>

<body id="body"> 
<div class="top-header">
         <div class="col-t">
         <i class="fas fa-phone"></i>  +88 0876543
         </div>
         <div class="col-t">
         <i class="fa-brands fa-facebook-f"></i>
          <i class="fa-brands fa-twitter"></i>
          <i class="fa-brands fa-instagram"></i>
          <i class="fa-brands fa-telegram"></i>
         </div>
</div>
 <section id="innerBanner">

<header id="header">
  <div class="container">
    <div id="logo" class="pull-left">
     <a href="index.php" class="scrollto"><img src="admin/assets/img/bannerlogo.png" alt=""></a> 
   </div>

  <nav id="nav-menu-container" style="margin-top: -40px;" class="only-small">
    <ul class="nav-menu">
      <li class="menu-active"><a href="index.php">Home</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="carlist.php">Car list</a></li>
      <li><a href="contact.php">Contact</a></li>
      <?php   
      if(strlen($_SESSION['login'])!=0)
      { 
        ?>
        <?php 
        $email=$_SESSION['login'];
        $sql ="SELECT FullName FROM tblusers WHERE EmailId=:email ";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
          foreach($results as $result)
          {
            ?>
            <li class="menu-has-children"><a href="" style="color: #0be881;"><?php echo htmlentities($result->FullName);?></a>
              <ul>
                <li><a href="my_booking.php">My Booking</a></li>
                <li><a href="logout.php">Sign Out</a></li>
              </ul>
            </li>
            <?php 
          }
        }
      } ?>
    </ul>
  </nav><!-- #nav-menu-container -->
</div>
  </header><!-- #header -->

  <div class="inner-content">
    <h2>Contact</h2>
    <p>We simplify your journey!</p>
    <div> 
    </div>
  </div> 
</section><!-- #Page Banner -->

<main id="main">


    <!--==========================
      Contact Section
      ============================-->
      <section id="contact" class="wow fadeInUp">
        <div class="container">
          <div class="section-header"> 
          <p>With every safety feature and every standard in our Community Guidelines, we're committed to helping to create a safe environment for our users.</p>
          </div>

          <div class="row contact-info">
           <div class="col-lg-5"> 
            <div class="contact-address">
              <h3><i class="fas fa-home"></i>Address</h3>
              <address>AG-12 Street, Concord Avenue, Barishal</address>
            </div> 
            <div class="contact-phone">             
              <h3><i class="fas fa-phone"></i>Phone Number</h3>
              <p><a href="tel:+155895548855">+88 0123456789</a></p>
            </div> 
            <div class="contact-email">
              <h3><i class="fas fa-envelope"></i>Email</h3>
              <p><a href="mailto:info@example.com">hellocab@gmail.com</a></p>
            </div> 
            <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14748.237316029099!2d90.37618931376544!3d22.464404693343237!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30aacf3ab2c48ee3%3A0x9f9517818d652848!2sDumki!5e0!3m2!1sen!2sbd!4v1655535364088!5m2!1sen!2sbd" width="350" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div> 
          </div>
          <div class="col-lg-7">
            <div class="container">
              <div class="form"> 

               <!-- Form itself -->
               <form  method="post" class="well"  validate> 
                 <div class="control-group">
                   <div class="form-group">
                     <input type="text" class="form-control"  name="fullname"
                     placeholder="Full Name" id="name" required
                     data-validation-required-message="Please enter your name" />
                     <p class="help-block"></p>

                   </div>
                 </div> 	
                 <div class="form-group">
                  <div class="controls">
                   <input type="email" class="form-control" placeholder="Email" name="email"
                   id="email" required
                   data-validation-required-message="Please enter your email" />
                 </div>
               </div> 	

               <div class="form-group">
                 <div class="controls">
                   <textarea rows="5" cols="50" class="form-control" name="message"
                   placeholder="Message" id="message" required
                   data-validation-required-message="Please enter your message" minlength="5" 
                   data-validation-minlength-message="Min 5 characters" 
                   maxlength="999" style="resize:none"></textarea>
                 </div>
               </div> 		 
               <div id="success"> </div> <!-- For success/fail messages -->
               <input type="submit" value="Send" name="submit" class="btn btn-primary pull-right"><br/>
             </form>
           </div>

         </div>
       </div>
     </div>
   </div>

 </section><!-- #contact -->

</main>
<?php include('includes/footer.php');?><!-- #footer -->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- JavaScript  -->
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/superfish/hoverIntent.js"></script>
<script src="lib/superfish/superfish.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/magnific-popup/magnific-popup.min.js"></script>
<script src="lib/sticky/sticky.js"></script> 
<script src="contact/jqBootstrapValidation.js"></script>
<script src="contact/contact_me.js"></script>
<script src="js/main.js"></script>

</body>
</html>
