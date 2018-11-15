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
            <li class="active nav-item">
              <a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false" >My Account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="mybooks-tab" data-toggle="tab" href="#mybooks" role="tab" aria-controls="mybooks" aria-selected="false">My Books</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" id="rentals-tab" data-toggle="tab" href="#rentals" role="tab" aria-controls="rentals" aria-selected="false">Current Rentals</a>
            </li>
          </ul>
        </div>

        <!-- Tab content -->
        <!-- Profile tab -->
	<?php
          $query = "select * from users where email = '{$_SESSION['email']}'";
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
              <div class="divTableRow">
                <div class="divTableCellLabel col-md-4">Email</div>
                <div class="divTableCell col-md-6"><?= $email;  ?></div>
              </div>
            </div>
          </div>
          <div class="divTable col-md-12">
            <div class="divTableBody">
              <div class="divTableRow">
                <div class="divTableCellLabel col-md-4">Address</div>
                <div class="divTableCell col-md-6"><?= $address;  ?></div>
                <div class="divTableCell col-md-2 text-right"><a href="">Edit</a></div>
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
                <div class="divTableCell col-md-offset-4 col-md-4 text-center"><a href="">Delete Account</a></div>
                <div class="divTableCell col-md-4 text-right"><a href="">Change Password</a></div>
              </div>
            </div>
          </div>
        </div>
		<!-- My books tab -->
        <div class="tab-pane" id="mybooks" role="tabpanel" aria-labelledby="mybooks-tab">
          <div class="divTable col-md-12">
            <div class="divTableHeading">
              <div class="divTableRow">
                <div class="divTableHead col-md-2"></div>
                <!-- <div class="divTableHead col-md-2">ISBN</div> -->
                <div class="divTableHead col-md-3">Author</div>
                <div class="divTableHead col-md-3">Title</div>                
                <div class="divTableHead col-md-2">Status</div>                
                <div class="divTableHead col-md-2">&nbsp</div>
              </div>
            </div>
            <div class="divTableBody">

              <?php 
                $query = "select * from register_books";
                $result = mysqli_query($connection, $query);
                
                  while ($row = mysqli_fetch_assoc($result)){
                    echo "<div class='divTableRow'>";
                    echo "<div class='divTableCell col-md-2'><img src='img/".$row['img_path']."'></div>";
                    // echo "<div class='divTableCell col-md-1'>". $row['isbn'] ."</div>";   
                    echo "<div class='divTableCell col-md-3'>". $row['author'] ."</div>";   
                    echo "<div class='divTableCell col-md-3'>". $row['title'] ."</div>";   
                    echo "<div class='divTableCell col-md-2'><select  name=''>
                                                              <option>Registered</option>
                                                              <option>Available</option>
                                                              <option>Not available</option>
                                                            </select></div>";   
                    echo "<div class='divTableCell col-md-2 text-right'><a href='changeBookStatus.php?isbn={$row['isbn']}'>Save</a></div>";
                    echo "</div>";
                }
               ?>
            </div>
            <div class="divTableFoot">
              <div class="divTableRow">
                <div class="divTableCell col-md-offset-10 col-md-2 text-right"><a href="addBooks.php">Add Book</a></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Rentals tab -->
        <div class="tab-pane" id="rentals" role="tabpanel" aria-labelledby="rentals-tab">
          <div class="divTable col-md-12">
            <div class="divTableHeading">
              <div class="divTableRow">
                <div class="divTableHead col-md-4">Title</div>
                <div class="divTableHead col-md-3">Author</div>
                <div class="divTableHead col-md-2">Due Date</div>
                <div class="divTableHead col-md-2">Status</div>                
                <div class="divTableHead col-md-1">&nbsp</div>
              </div>
            </div>
            <div class="divTableBody">
              <div class="divTableRow">
                <div class="divTableCell col-md-4">cell1_1</div>
                <div class="divTableCell col-md-3">cell2_1</div>
                <div class="divTableCell col-md-2">cell3_1</div>
                <div class="divTableCell col-md-2">cell3_1</div>
                <div class="divTableCell col-md-1 text-right"><a href="">Edit</a></div>
              </div>
              <div class="divTableRow">
                <div class="divTableCell col-md-4">cell1_2</div>
                <div class="divTableCell col-md-3">cell2_2</div>
                <div class="divTableCell col-md-2">cell3_2</div>
                <div class="divTableCell col-md-2">cell3_2</div>
                <div class="divTableCell col-md-1 text-right"><a href="">Edit</a></div>
              </div>
              <div class="divTableRow">
                <div class="divTableCell col-md-4">cell1_3</div>
                <div class="divTableCell col-md-3">cell2_3</div>
                <div class="divTableCell col-md-2">cell3_3</div>
                <div class="divTableCell col-md-2">cell3_3</div>
                <div class="divTableCell col-md-1 text-right"><a href="">Edit</a></div>
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
