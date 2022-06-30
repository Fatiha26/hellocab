<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{ 
  header('location:index.php');
}
else{
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Car Rental Portal | My Booking</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="css/style.css" rel="stylesheet"> 
       </style>
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

  <nav id="nav-menu-container" class="only-small">
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
   <section id="innerBanner"> 
    <div class="inner-content">
      <h2>My Bookings</h2>
      <p>We create the opportunities!</p>
      <div> 
      </div>
    </div> 
  </section>

  <main id="main">
   <?php 
   $useremail=$_SESSION['login'];
   $sql = "SELECT * from tblusers where EmailId=:useremail";
   $query = $dbh -> prepare($sql);
   $query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
   $query->execute();
   $results=$query->fetchAll(PDO::FETCH_OBJ);
   $cnt=1;
   if($query->rowCount() > 0)
   {
    foreach($results as $result)
      { ?>
        <section class="user_profile inner_pages">
          <div class="container">
            <div class="user_profile_info">
              <div class="upload_user_logo"> 
                <img src="admin/assets/img/bannerlogo.png" alt="image">
              </div>
                  <?php 
                }
              }?>
          </div>
          <div class="row">
            <div class="col-md-3 col-sm-3">
             <?php include('includes/sidebar.php');?>

             <div class="col-md-8 col-sm-8">
              <div class="profile_wrap" style="margin-top: 10px;">
                <h5 class="uppercase underline">My Bookings </h5>
                <div class="my_vehicles_list">
                  <ul class="vehicle_listing">
                    <?php 
                    $useremail=$_SESSION['login'];
                    $sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.id as vid,tblbrands.BrandName,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.Status,tblvehicles.PricePerDay,DATEDIFF(tblbooking.ToDate,tblbooking.FromDate) as totaldays,tblbooking.BookingNumber  from tblbooking join tblvehicles on tblbooking.VehicleId=tblvehicles.id join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblbooking.userEmail=:useremail";
                    $query = $dbh -> prepare($sql);
                    $query-> bindParam(':useremail', $useremail, PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      {  
                        ?>

                        <li style="list-style: none;">
                          <h4 style="color: #60a3bc;">Booking No. &nbsp;<?php echo htmlentities($result->BookingNumber);?></h4>
                          <div class="vehicle_img"><a href="car_details.php?vhid=<?php echo htmlentities($result->vid);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image" width="40%"></a> </div>
                          <div class="vehicle_title">
                            <h6 style="font-size:25px;font-weight:bold;">
                            <a href="car_details.php?vhid=<?php echo htmlentities($result->vid);?>"> <?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
                            <p><b>From </b> <?php echo htmlentities($result->FromDate);?> <b>To </b> <?php echo htmlentities($result->ToDate);?></p>
                            <div style="float: left;"><p><b>Message:</b> <?php echo htmlentities($result->message);?> </p></div>
                          </div>
                          <?php if($result->Status==1)
                          { ?>
                            <div class="vehicle_status">
                              <a href="#" class="btn outline btn-xs active-btn" style="color: #fff;">Confirmed</a>
                             <div class="clearfix"></div>
                           </div>

                           <?php 
                         } else if($result->Status==2) { ?>
                           <div class="vehicle_status"><a href="#" class="btn outline btn-xs" style="color: #fff;">Cancelled</a>
                            <div class="clearfix"></div>
                            
                          </div>
                          <?php 
                        } else { ?>
                         <div class="vehicle_status">
                          <a href="#" class="btn outline btn-xs" style="color: #fff;">Not Confirm yet</a>
                          <div class="clearfix"></div>
                        </div>
                        <?php 
                      } ?>

                    </li>

                    <h5 style="color: #60a3bc;margin-top:70px;font-size:30px;">Invoice</h5>
                    <table style="color: #000;">
                      <tr>
                        <th>Car Name</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Total Days</th>
                        <th>Rent / Day</th>
                      </tr>
                      <tr>
                        <td><?php echo htmlentities($result->VehiclesTitle);?>, <?php echo htmlentities($result->BrandName);?></td>
                        <td><?php echo htmlentities($result->FromDate);?></td>
                        <td> <?php echo htmlentities($result->ToDate);?></td>
                        <td><?php echo htmlentities($tds=$result->totaldays);?></td>
                        <td> <?php echo htmlentities($ppd=$result->PricePerDay);?></td>
                      </tr>
                      <tr>
                        <th colspan="4" style="text-align:center;"> Grand Total</th>
                        <th><?php echo htmlentities($tds*$ppd);?></th>
                      </tr>
                    </table>                      
                    <hr />
                    <?php 
                  }
                }  else { ?>
                  <h5 align="center" style="color:red">No booking yet</h5>
                  <?php 
                } ?>
              </ul>
            </div>
            <div class="text-center">
              <a href="print_invoice.php" class="btn btn-success" style="width: 130px;">Print</a>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>


</main>
<?php include('includes/footer.php');?><!-- #footer -->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<!--/Forgot-password-Form --> 

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
<?php 
} ?>
