<?php 
include 'includes/server.php';
require 'includes/required.php';
?>
<?php 
$page_title = "My Account";
include "includes/head.php";
?>
<body>
  <?php 
  include "includes/navbar.php"; ?>
  <section class="probootstrap-hero probootstrap-xs-hero probootstrap-hero-colored">
    <div class="container">
      <div class="row">
        <div class="col-md-8 text-left probootstrap-hero-text">
          <h1 class="probootstrap-animate" data-animate-effect="fadeIn">My profile <p>Update email & address</p></h1>
          <!--  -->
        </div>
      </div>
    </div>
  </section>
  <section class="probootstrap-section probootstrap-bg-white">
    <div class="container probootstrap-animate">
      <!-- form here  -->
      <div class="register-form">
        <div class="main-div">
          <div class="panel centerAlign">
           <h2>Update Form</h2>
           <p>Fill in the form to update your profile!</p>  
           
           <?php 
           $loggedin = $_SESSION['email'];
           $query = "SELECT u.*, c.name as city from users u LEFT JOIN cities c ON u.city_id = c.id where email = '$loggedin'";

           $state_query = "SELECT ub.state from users u LEFT JOIN user_books ub ON u.id = ub.user_id where email = '$loggedin'";


           
          $result = mysqli_query($connection, $query);
          while($row = mysqli_fetch_assoc($result)){
            $address = $row['address'];
          }
          $state_query_result = mysqli_query($connection, $state_query);
          $newAddress = '';
          $newCity = '';
          $errors = array();
          while($row = mysqli_fetch_assoc($state_query_result)) {
                        $state =  $row['state'];  
          }
          if(isset($_POST['update_profile'])){

            $newAddress = mysqli_real_escape_string($connection,$_POST['naddress']);
            $newCity = mysqli_real_escape_string($connection,$_POST['ncity']);
            if (empty($newCity) && empty($newAddress)) { 
              array_push($errors, "you cannot leave empty fields!"); 
            } elseif($newCity < 1){
              array_push($errors, "Select a proper city");
            }

          if (count($errors) == 0) {
            if($state == 1 || $state == ''){      
              $sql   = "UPDATE users SET address='{$newAddress}', city_id = '{$newCity}' WHERE email ='{$loggedin}'";
              $res  = mysqli_query($connection,$sql) or die("Could not update ".mysqli_error($connection)); 
              $_SESSION['email'] = $loggedin;
              header('location: profile.php');
            } else {
              array_push($errors, 'You cannot change your address if you have rented Books!');
            }
          }
        }
        ?>
      </div>

      <form id="Register" method="POST" action="">
        <div class="form-group">
          <label for='isbn'>Enter Your Address:</label>
          <input type="text" name="naddress" class="form-control" value="<?= $address ?>">
        </div>
        <div class="form-group">
        <select class="custom-select form-control" id="" name="ncity">
            <option value="">City</option>
            <?php
            $query = "select * from cities";
            $result = mysqli_query($connection, $query);

            while ($city_row = mysqli_fetch_assoc($result)){
              echo "<option value='{$city_row['id']}'>".$city_row['name']."</option>";
            }
            ?>
      </select>
        <?php include "includes/errors.php" ?>      
        <div class="centerAlign">
          <button type="submit" class="btn btn-primary" name="update_profile">Update</button>
        </div>
      </form>
      
    </div>
  </div>  
</div>
</section>
<?php 
include "includes/footer.php";
?>

