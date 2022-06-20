<?php
include('includes/checklogin.php');
check_login();
if(isset($_GET['delid']))
{
  $rid=intval($_GET['delid']);
  $sql="update tbladmin set Status='0' where ID='$rid'";
  $query=$dbh->prepare($sql);
  $query->bindParam(':rid',$rid,PDO::PARAM_STR);
  $query->execute();
  echo "<script>alert('User blocked');</script>"; 
  echo "<script>window.location.href = 'userregister.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>
  <div class="container-scroller">
    <?php @include("includes/header.php");?>
    <div class="container-fluid page-body-wrapper">
      <?php @include("includes/sidebar.php");?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="modal-header">
                  <h5 class="modal-title" style="float: left;">Feedbacks</h5>
                </div>
               <div class="card-body table-responsive p-3">
                <table class="table align-items-center table-bordered  table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Full Name</th>
                      <th>Email </th>
                      <th>Message</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php $sql = "SELECT * from  feedback ";
                   $query = $dbh -> prepare($sql);
                   $query->execute();
                   $results=$query->fetchAll(PDO::FETCH_OBJ);
                   $cnt=1;
                   if($query->rowCount() > 0)
                   {
                    foreach($results as $result)
                    {  
                      ?>  
                      <tr>
                        <td><?php echo htmlentities($cnt);?></td>
                        <td><?php echo htmlentities($result->fullname);?></td>
                        <td><?php echo htmlentities($result->email);?></td>
                        <td><?php echo htmlentities($result->message);?></td>
                      </tr>
                      <?php
                      $cnt=$cnt+1;
                    }
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php @include("includes/footer.php");?>
  </div>
</div>
</div>
<?php @include("includes/foot.php");?>
</body>
</html>
