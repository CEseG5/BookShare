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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" src="js/book_requests.js"></script>
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
              $userId  =  $_SESSION['id'];
              $idlook  =  mysqli_query($connection,"select  id  from  users");
              $filter = ($city_filter != '')? "AND c.id = {$city_filter}" : "";

              $searchQuery = "SELECT u.address,b.img_name, b.title, b.author, ub.state, u.last_name, u.first_name, ub.book_id, ub.user_id, c.name as city_name, r.is_answered, r.borrower_id
                              FROM books b JOIN user_books ub on ub.book_id = b.isbn and ub.state = 1 and ub.user_id != '{$_SESSION['id']}'  
                              INNER JOIN users u on u.id = ub.user_id
                              INNER JOIN cities c on c.id = u.city_id $filter         
                              LEFT JOIN requests r on ub.book_id = r.book_id and ub.user_id = r.owner_id and r.borrower_id = '{$_SESSION['id']}' 
                              WHERE concat(b.title, b.author, b.isbn) LIKE '%$search%'and r.is_answered is null or r.is_answered != 'approved' and r.is_answered != 'pending'
                               " ;

              $result = mysqli_query($connection, $searchQuery);

              $id_borrower = $_SESSION['id'];
              
              if(mysqli_num_rows($result) > 0 ){
                while($row = mysqli_fetch_assoc($result)){
                  $state = ($row['state'] == '1' ? 'Available' : 'Not Available');
                  $id = $row['user_id'].$row['book_id'];
                  
                  $user_id = $row['user_id'];
                  $city_address = $row['city_name'].' '.$row['address'];
                  $book_id = $row['book_id'];

                  echo "<div class='divTableRow'>";
                  echo "<div class='divTableCell col-md-2'><img src='img/".$row['img_name']."'></div>";  
                  echo "<div class='divTableCell col-md-2'>". $row['author'] ."</div>";   
                  echo "<div class='divTableCell col-md-2'>". $row['title'] ."</div>";                  
                  echo "<div class='divTableCell col-md-2'>". $state."</div>";  
                  echo "<div class='divTableCell col-md-2'>". $row['first_name'].' '.$row['last_name'] ."</div>";
                  echo "<div class='divTableCell col-md-1'>". $row['city_name'] ."</div>";
                  echo "<div class='divTableCell col-md-1 text-right'><a role='button' data-toggle='modal' data-target='#rentModal' data-session='$id_borrower' book-id='$book_id' class='rent_book' data-id='$user_id' data-city='$city_address'>Rent</a></div>";
                  echo "</div>";
                }
              } else {
                echo "There are no results matching your search";
              }
            }
            ?>
          </div>
          <?php include 'includes/requestForm.php' ?>
        </div>
      </div>
    </div>
  </section>
</body>
</html>

<?php 
include "includes/footer.php";
?>
