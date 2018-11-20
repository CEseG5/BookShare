<?php 
include 'includes/server.php';
require 'includes/required.php';
?>

<!DOCTYPE html>
<html>
<?php 
$page_title = "My Account";
include "includes/head.php";
?>

<body>
  <?php include "includes/navbar.php"; ?>
  <section class="probootstrap-hero probootstrap-xs-hero probootstrap-hero-colored">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-left probootstrap-hero-text">
          <h1 class="probootstrap-animate" data-animate-effect="fadeIn">My Profile</h1>
          <!--  -->
        </div>
      </div>
    </div>
  </section>

  <section class="probootstrap-section probootstrap-bg-color">
    <div class="container">
      <div class="col-md-12 text-left probootstrap-hero-text">

        <!-- Nav tabs -->            
        <div> 
          <ul class="nav nav-fill nav-tabs" id="myTab" role="tablist" ata-animate-effect="fadeIn" >
            <li class="active nav-link-profile">
              <a class="nav-link-profile" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false" >My Account</a>
            </li>
          </ul>
        </div>

        <!-- Tab content -->
        <!-- Profile tab -->
        <?php
        $query = "SELECT u.*, c.name as city from users u LEFT JOIN cities c ON u.city_id = c.id  where u.email = '{$_SESSION['email']}'";
        $result = mysqli_query($connection, $query);
        $first_name = '';
        $last_name = '';
        $email = '';
        $address='';
        $city='';
        while($row = mysqli_fetch_assoc($result)){
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $email = $row['email'];
          $address=$row['address'];
          $city= $row['city'];
        }
        ?>
        <div class="tab-content">
          <div class="tab-pane active" id="account" role="tabpanel" aria-labelledby="account-tab">
           <div class="divTable col-md-12">
            <div class="divTableBody">
              <div class="divTableRow ">
                <div class="divTableCellLabel col-md-4">First Name</div>
                <div class="divTableCell col-md-6"><?= $first_name;  ?></div>
                <div class="divTableCell col-md-2 text-right"><a href="update_profile.php">Edit</a></div>
              </div>
              <div class="divTableRow">
                <div class="divTableCellLabel  col-md-4">Last Name</div>
                <div class="divTableCell col-md-6"><?= $last_name;  ?></div>
              </div>
            </div>
          </div>
          <div class="divTable col-md-12">
            <div class="divTableBody">
              <div class="divTableRow">
                <div class="divTableCellLabel col-md-4">Address</div>
                <div class="divTableCell col-md-6"><?= $address;  ?></div>
                <div class="divTableCell col-md-2 text-right"><a href="update_address.php">Edit</a></div>
              </div>
              <div class="divTableRow">
                <div class="divTableCellLabel col-md-4">City</div>
                <div class="divTableCell col-md-6"><?= $city;  ?></div>
              </div>
            </div>
          </div>
          <div class="divTable col-md-12">
            <div class="divTableBody">
              <div class="divTableRow">
                <div class="divTableCellLabel col-md-4">Email</div>
                <div class="divTableCell col-md-5"><?= $email;  ?></div>
                <div class="divTableCell col-md-3 text-right"><a href="">Change Password</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
include "includes/footer.php";
?>
</body>
</html>
