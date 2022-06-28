<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Hellocab | Search Car</title>
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
 <?php include('includes/header.php'); ?>
  <div class="inner-content">
     <h2>Search Result of keyword "<?php echo $_POST['searchdata'];?>"</h2>
    <p>We provide high quality cars!</p>
  </div> 
</section><!-- #Page Banner -->

<main id="main">
 <!--Listing-->
 <section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
            <?php 
               //Query for Listing count
            $searchdata=$_POST['searchdata'];
            $sql = "SELECT tblvehicles.id from tblvehicles 
            join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand 
            where tblvehicles.VehiclesTitle=:search || tblvehicles.FuelType=:search || tblbrands.BrandName=:search || tblvehicles.ModelYear=:search";
            $query = $dbh -> prepare($sql);
            $query -> bindParam(':search',$searchdata, PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=$query->rowCount();
            ?>
            <p><span><?php echo htmlentities($cnt);?> Listings found againt search</span></p>
          </div>
        </div>

        <?php 
        $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles 
        join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand 
        where tblvehicles.VehiclesTitle=:search || tblvehicles.FuelType=:search || tblbrands.BrandName=:search || tblvehicles.ModelYear=:search";
        $query = $dbh -> prepare($sql);
        $query -> bindParam(':search',$searchdata, PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
          foreach($results as $result)
          {  
            ?>
            <div class="product-listing-m gray-bg" >
              <div class="product-listing-img"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="Image" style="width: 300px; height: 150px;" /> </a> 
              </div>
              <div class="product-listing-content">
                <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h5>
                <p class="list-price">$<?php echo htmlentities($result->PricePerDay);?> Per Day</p>
                <ul>
                  <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
                </ul>
                <a href="car_details.php?vhid=<?php echo htmlentities($result->id);?>" class="btn" style="background-color: #45aaf2;color:#fff;">View Details <span class="angle_arrow"><i class="fa fa-angle-right" style="color: #fff; "  aria-hidden="true"></i></span></a>
              </div>
            </div>
            <?php 
          }
        } ?>
      </div>

    </div>
  </div>
</section>
</main>


<?php
  include('includes/footer.php');
?>
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <?php include('includes/login.php');?>
    <?php include('includes/registration.php');?>

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
