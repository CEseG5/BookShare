<?php 
include 'includes/server.php';
require 'includes/required.php';
?>

<!DOCTYPE html>
<html>
<?php 
$page_title = "Search Books";
include "includes/head.php";
?>
<body>
  <?php include "includes/navbar.php"; ?>
  <section class="probootstrap-hero probootstrap-xs-hero probootstrap-hero-colored">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-left probootstrap-hero-text">
          <h1 class="probootstrap-animate" data-animate-effect="fadeIn">Search Books</h1>
          <p><q>You are not done with a book until you pass it to another reader.</q> - Donalyn Miller</p>
        </div>
      </div>
    </div>
  </section>

  <section class="probootstrap-section probootstrap-bg-colored">
    <div class="container">
      <div class="row">                   
        <div class="col-md-12 text-center probootstrap-hero-text probootstrap-hero" data-animate-effect="fadeIn">
          <?php include "includes/searchForm.php"?>
        </div>
      </div>
      <div class="tab-pane active" id="mybooks" role="tabpanel" aria-labelledby="mybooks-tab">
        <div class="divTable col-md-12">
          <div class="divTableHeading">
            <div class="divTableRow">
              <div class="divTableHead col-md-2"></div>
              <div class="divTableHead col-md-2">Author</div>
              <div class="divTableHead col-md-2">Title</div>                
              <div class="divTableHead col-md-2">Status</div>                
              <div class="divTableHead col-md-2">Owner</div>                
              <div class="divTableHead col-md-1">Location</div>                
              <div class="divTableHead col-md-1">&nbsp</div>
            </div>
          </div>
          <div class="divTableBody">
            <?php 
            if (isset($_POST['search'])) {

              $search = mysqli_real_escape_string($connection, $_POST['bsearch']);
              $city_filter = mysqli_real_escape_string($connection, $_POST['city']);

              $searchQuery = "SELECT b.img_name, b.title, b.author, ub.state, u.last_name, u.first_name,c.name, ub.book_id, ub.user_id, c.id, c.name as city_name FROM books b 
              LEFT JOIN user_books ub on b.isbn = ub.book_id 
              LEFT JOIN users u on u.id = ub.user_id
              LEFT JOIN cities c on u.city_id = c.id
              WHERE concat(b.title, b.author, b.isbn) LIKE '%$search%'" ;

              if($city_filter != ''){
                $searchQuery .= "AND c.id LIKE {$city_filter}";
              }

              $result = mysqli_query($connection, $searchQuery);

              if(mysqli_num_rows($result) > 0 ){
                while($row = mysqli_fetch_assoc($result)){
                  $state = ($row['state'] == '1' ? 'Available' : 'Not Available');
                  $id = $row['user_id'].$row['book_id'];
                  echo "<div class='divTableRow'>";
                  echo "<div class='divTableCell col-md-2'><img src='img/".$row['img_name']."'></div>";  
                  echo "<div class='divTableCell col-md-2'>". $row['author'] ."</div>";   
                  echo "<div class='divTableCell col-md-2'>". $row['title'] ."</div>";                  
                  echo "<div class='divTableCell col-md-2'>". $state."</div>";  
                  echo "<div class='divTableCell col-md-2'>". $row['first_name'].' '.$row['last_name'] ."</div>";
                  echo "<div class='divTableCell col-md-1'>". $row['city_name'] ."</div>";
                  echo "<div class='divTableCell col-md-1 text-right'><a href='changeBookStatus.php?isbn=$id'>Rent</a></div>";
                  echo "</div>";
                }
              } else {
                echo "There are no results matching your search";
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>

<?php 
include "includes/footer.php";
?>