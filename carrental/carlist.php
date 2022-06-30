<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>HelloCab | Car List</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="css/style.css" rel="stylesheet"> 
</head>

<body id="body"> 
 <section id="innerBanner"> 
  <?php include('includes/header.php'); ?>
  <div class="inner-content">
    <h2>Car Listing</h2>
    <p>We provide high quality cars!</p>
  </div> 
</section>

<main id="main">
<div class="mt-5 ml-4">
    <form class="form-inline "  action="search.php" method="post">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="text"  name="searchdata" placeholder="Search Car" aria-label="Search" required="true" style="background-color: #fff;border: 1px solid #000;">
        <div class="input-group-append">
          <button class="btn btn-navbar" style="background-color: #49a3ff;" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </div>

      <section id="about" class="wow fadeInUp">
        <div class="container"> 
          <div class="row">
              <div class="col-md-12 col-md-push-3">
                <div class="result-sorting-wrapper">
                  <div class="sorting-count">

                <?php 
                $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand order by rand() ";
                $query = $dbh -> prepare($sql);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                $cnt=1;
                if($query->rowCount() > 0)
                {
                  foreach($results as $result)
                  {  
                    ?>
                    <div class="product-listing-l">
                      <div class="product-listing-img"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="Image" style="height: 150px; width:300px;" /> </a> 
                      </div>
                      <div class="product-listing-content">
                        <h5><a href="car_details.php?vhid=<?php echo htmlentities($result->id);?>" style="color: #60a3bc;"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h5>
                        <p class="list-price" style="color: #EE5A24;">$<?php echo htmlentities($result->PricePerDay);?> Per Day</p>
                        <ul>
                          <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                          <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> model</li>
                          <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
                        </ul>
                        <a href="car_details.php?vhid=<?php echo htmlentities($result->id);?>" class="btn" style="background-color: #45aaf2;color:#fff;" >View Details <span class="angle_arrow"><i class="fa fa-angle-right" style="color: #fff; " aria-hidden="true"></i></span></a>
                      </div>
                    </div>
                    <?php
                  }
                } ?>
              </div>

                    </div>
                </div>

          </div></div></section></main>
<?php
  include('includes/footer.php');
?>
</body>
</html>
