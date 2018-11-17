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
          <h1 class="probootstrap-animate" data-animate-effect="fadeIn">Books</h1>
          <!--  -->
        </div>
      </div>
    </div>
  </section>

  <section class="probootstrap-section probootstrap-bg-color">
    <div class="container">
      <div class="col-md-12 text-left probootstrap-hero-text">

        <!-- Nav tabs -->            
        <!-- <div> 
          <ul class="nav nav-fill nav-tabs" id="myTab" role="tablist" ata-animate-effect="fadeIn" >
            <li class="nav-item">
              <a class="nav-link" id="mybooks-tab" data-toggle="tab" href="#mybooks" role="tab" aria-controls="mybooks" aria-selected="false">My Books</a>
            </li>
          </ul>
        </div> -->

        <!-- Tab content -->
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
      </div>

    </div>
  </div>
</section>

<?php 
include "includes/footer.php";
?>
</body>
</html>
