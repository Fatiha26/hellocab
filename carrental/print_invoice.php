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
    <title>HelloCab | My Booking</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> 
  </head>


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
        <section class="user_profile inner_pages" style="margin-top: -60px;">
          <div class="container">
            <div class="user_profile_info">
              <div class="upload_user_logo"> 
                <img src="admin/assets/img/bannerlogo.png" alt="image" width="130px">
              </div>
                  <?php
                }
              }?>
          </div>
          <div class="row">
            <div class="col-md-3 col-sm-3">
             <?php include('includes/sidebar.php');?>

             <div class="col-md-8 col-sm-8" style="margin-top: 10px;">
              <div class="profile_wrap">
                <h5 class="uppercase underline">My Bookings </h5>
                <div class="my_vehicles_list" >
                  <ul class="vehicle_listing" style="list-style: none;">
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

                        <li>
                          <h4 style="color:#60a3bc;">Booking No. &nbsp;<?php echo htmlentities($result->BookingNumber);?></h4>
                          <div class="vehicle_img"> <a href="car_details.php?vhid=<?php echo htmlentities($result->vid);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image" width="30%"></a> </div>
                          <div class="vehicle_title">

                            <h6><a href="car_details.php?vhid=<?php echo htmlentities($result->vid);?>"> <?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
                            <p><b>From </b> <?php echo htmlentities($result->FromDate);?> <b>To </b> <?php echo htmlentities($result->ToDate);?></p>
                            <div style="float: left"><p><b>Message:</b> <?php echo htmlentities($result->message);?> </p></div>
                          </div>
                          <?php if($result->Status==1)
                          { ?>
                            <div class="vehicle_status"> <a href="#" class="btn outline btn-xs active-btn" style="color: #fff;">Confirmed</a>
                             <div class="clearfix"></div>
                           </div>

                           <?php 
                         } else if($result->Status==2) { ?>
                           <div class="vehicle_status"> <a href="#" class="btn outline btn-xs">Cancelled</a>
                            <div class="clearfix"></div>
                            
                          </div>
                          <?php 
                        } else { ?>
                         <div class="vehicle_status"> <a href="#" class="btn outline btn-xs" style="color: #fff;">Not Confirm yet</a>
                          <div class="clearfix"></div>
                        </div>
                        <?php 
                      } ?>

                    </li>

                    <h5 style="color: #60a3bc;margin-top:70px;font-size:30px;">Invoice</h5>
                    <table>
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
                    <button onclick="window.print()" class="btn btn-success" id="print-btn" style="width:140px">Print</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>


</main>

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
<?php 
} ?>
