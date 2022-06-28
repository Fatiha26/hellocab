<?php 
session_start();
include('includes/config.php');
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Hellocab | Car rental</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet"> 
</head>

<body id="body"> 
<div class="top-header">
         <div class="col-t">
         <i class="fas fa-phone"></i>  +88 0876543
         </div>
         <div class="col-t">
         <a href="https://www.google.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a> 
         <a href="https://www.google.com/" target="_blank"><i class="fa-brands fa-twitter"></i></a>
         <a href="https://www.google.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
         <a href="https://www.google.com/" target="_blank"><i class="fa-brands fa-telegram"></i></a>
         </div>
</div>
  
    <section id="hero">
      
      <div class="container">       
      <header id="header">
  <div class="container">

    <div id="logo" class="pull-left">
    <a href="index.php" class="scrollto"><img src="admin/assets/img/bannerlogo.png" alt=""></a> 
   </div>


  <nav id="nav-menu-container"  style="margin-top: -55px;">
    <ul class="nav-menu">
      <li class="menu-active"><a href="index.php">Home</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="carlist.php">Car list</a></li>
      <li><a href="contact.php">Contact</a></li>
      <?php   if(strlen($_SESSION['login'])!=0)
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
            <li class="menu-has-children"><a href="" style="color: #07cc91;"><?php echo htmlentities($result->FullName);?></a>
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
        <div class="banner-b" data-aos="fade-right"  data-aos-duration="1000">
          <div class="hero-banner" data-aos="fade-right">
             <h1>FIND THE RIGHT CAR FOR YOU.</h1>
             <p>We have more than a thousand cars for you to choose.</p>
             <a href="about.php" class="btn-banner learn">Read More</a>
             <?php   if(strlen($_SESSION['login'])==0)
            { 
              ?>
              <a href="#loginform" data-toggle="modal" data-dismiss="modal" class="btn-banner">Login / Register</a> 
              <?php 
            }?>

        </div>
        <div class="img-b" data-aos="fade-left"  data-aos-duration="2000">
          <img src="img/b1.png" alt="">
        </div>
          </div>
     </div>

   </section><!-- #Hero -->

   <main id="main">
      <section id="services">
        <div class="container">
          <div class="section-header" data-aos="zoom-in">
            <h2>Find the Best Car for you</h2>
            <p>We want you to move freely, make the most of your time, and be connected to the people and places that matter most to you.</p>
          </div>

          <div class="row">
           <?php $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand order by rand() limit 3 ";
           $query = $dbh -> prepare($sql);
           $query->execute();
           $results=$query->fetchAll(PDO::FETCH_OBJ);
           $cnt=1;
           if($query->rowCount() > 0)
           {
            foreach($results as $result)
            {  
              ?> 
              <div class="col-lg-4">
                <div class="box wow  fadeInLeft">
                  <div class="car-info-box">
                    <a href="car_details.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" style="height: 180px; width: 280px; margin-left:20px;margin-bottom:8px;" class="img-responsive"  alt="image" >
                    </a>
                    <ul style=" width: 100%; background-color: #60a3bc;">
                      <li style="font-size: 15px;"></><i class="fa fa-car" aria-hidden="true" style="font-size: 15px;"></i><?php echo htmlentities($result->FuelType);?></li>
                      <li style="font-size: 15px;"><i class="fa fa-calendar" aria-hidden="true" style="font-size: 15px;"></></i><?php echo htmlentities($result->ModelYear);?> Model</li>
                      <li style="font-size: 15px;"><i class="fa fa-user" aria-hidden="true" style="font-size: 15px;"></></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                    </ul>
                    <div class="car-title-m">
                      <h6><a href="car_details.php?vhid=<?php echo htmlentities($result->id);?>"> <?php echo substr($result->VehiclesTitle,0,21);?></a></h6>
                      <span class="price" style="color: #e55039;">$<?php echo htmlentities($result->PricePerDay);?> /Day</span> 
                    </div>
                    <div class="inventory_info_m ">
                      <p style="font-size: 14px;"><?php echo substr($result->VehiclesOverview,0,70);?></p>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
            }
          }?>
        </div>
      </div>
    </section><!-- #services -->

      <section id="clients" class="wow fadeInUp">
        <div class="container">
          <div class="section-header" data-aos="zoom-in">
            <h2>About Our Service</h2>
            <p>we are committed to safety, from the creation of new standards</p>
          </div>
          <div class="row">
            <div class="col-md-3 a-services nmbr-one">
            <i class="fa-solid fa-car" style="color: #e55039;"></i>             
            <h3>100% Availablity</h3>
            <p>The service is available in thousands of cities worldwide, so you can request a ride even when you’re far from home.</p>               
            </div>
            <div class="col-md-3 a-services">
            <i class="fa-solid fa-hand-holding-heart" style="color: #e55039;"></i>            
            <h3>Trustworthy</h3>
            <p>With every safety feature and every standard in our Community 
              Guidelines, we're committed to helping to create a safe environment 
              for our users.</p>               
            </div>
            <div class="col-md-3 a-services">
            <i class="fa-solid fa-phone" style="color: #e55039;"></i>
            <h3>24/7 Support</h3>
            <p>Count on 24/7 support to help with any questions or safety concerns.Our focus is on your safety, so you can go where the opportunity is.</p>               
            </div>
            
          </div>

        </div>
      </section><!-- #clients --> 
   



    </main>

  <!--==========================
    Footer
    ============================-->
   <?php include('includes/footer.php');?><!-- #footer -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <!--Login-Form -->
    <?php include('includes/login.php');?>
    <?php include('includes/registration.php');?>
    
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/sticky/sticky.js"></script> 
    <script src="contact/jqBootstrapValidation.js"></script>
    <script src="contact/contact_me.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="js/main.js"></script>

    <script>
  AOS.init();
</script>
  </body>
  </html>
