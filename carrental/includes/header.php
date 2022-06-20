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