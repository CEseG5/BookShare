<?php 
include 'includes/server.php';
require 'includes/required.php';
?>

<!DOCTYPE html>
<html>
<?php 
$page_title = "Books";
include "includes/head.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="js/book_requests.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script>
  
  $(document).ready(()=>{
    
    function getUrlVars()
    {
      let vars = [], hash;
      let hashes = window.location.href.slice(window.location.href.indexOf('#')).split('&');
      for(var i = 0; i < hashes.length; i++)
      {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
      }
      return vars;
    }

    if(getUrlVars()[0] === '#sent_requests') {
      $("#sent_requests").addClass('active');
      $("#mybooks").removeClass('active');
      $("#books").removeClass('active');
      $("#sent_requests-tab").addClass('active');
    }
  });

</script>

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
        <div id='tabs'> 
          <ul class="nav nav-fill nav-tabs nav-justified" id="myTab" role="tablist" ata-animate-effect="fadeIn" >
            <li class="active nav-item" id="books">
              <a class="nav-link" id="mybooks-tab" data-toggle="tab" href="#mybooks" role="tab" aria-controls="mybooks" aria-selected="false">My Books</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" id="rentals-tab" data-toggle="tab" href="#rentals" role="tab" aria-controls="rentals" aria-selected="false">Current Rentals</a>
            </li>            
            <li class="nav-item">
              <a class="nav-link" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="false" >Lend Requests</a>
            </li>
            <li class="nav-item" id="sent_requests-tab">
              <a class="nav-link" data-toggle="tab" href="#sent_requests" role="tab" aria-controls="sent_requests" aria-selected="false" >Borrow Requests</a>
            </li>
          </ul>
        </div>

        <!-- Tab content -->
        <div class="tab-content">
          <!-- My books tab -->
          <div class="tab-pane active" id="mybooks" role="tabpanel" aria-labelledby="mybooks-tab">
            <div class="divTable col-md-12">
              <div class="divTableHeading">
                <div class="divTableRow">
                  <div class="divTableHead col-md-2"></div>
                  <div class="divTableHead col-md-2">Author</div>
                  <div class="divTableHead col-md-3">Title</div>                
                  <div class="divTableHead col-md-2">Status</div>                
                  <div class="divTableHead col-md-2">
                    <?php if(isset($_SESSION['msg'])){
                      echo "<span>{$_SESSION['msg']}</span>";
                      unset($_SESSION['msg']);
                     } ?> 
                  </div>
                </div>
              </div>
              <div class="divTableBody">

                <?php 
                $query = "SELECT b.img_name, b.title, b.author, u.email, ub.state, ub.user_id, ub.book_id FROM books b
                LEFT JOIN user_books ub on b.isbn = ub.book_id 
                LEFT JOIN users u on ub.user_id = u.id 
                WHERE u.email = '{$_SESSION['email']}' ";
                $result = mysqli_query($connection, $query);
                
                while ($row = mysqli_fetch_assoc($result)){
                 $state = $row['state'] === '1' ? 'Available' : 'Not Available';

                 echo "<div class='divTableRow'>";
                 echo "<form action='changeBookStatus.php' method='POST'>";
                 echo "<div class='divTableCell col-md-2'><img src='img/".$row['img_name']."'></div>";
                 echo "<div class='divTableCell col-md-2'>". $row['author'] ."</div>";   
                 echo "<div class='divTableCell col-md-3'>". $row['title'] ."</div>";  
                 echo "<div class='divTableCell col-md-2'>". $state ."</div>";   
                 echo "<input type='hidden' name='prevState' value='".$row['state']."'>"; 
                 echo "<input type='hidden' name='userId' value='".$row['user_id']."'>"; 
                 echo "<input type='hidden' name='bookId' value='".$row['book_id']."'>"; 

                 if($row['state'] === '1'){
                    echo "<input type='hidden' name='state' value='0'>"; 
                    echo "<div class='divTableCell col-md-2'>
                    <input class='btn btn-primary' type='submit' name='changeState' value='Make it Unavailable'>
                    </div>";
                   }else {
                    echo "<input type='hidden' name='state' value='1'>"; 
                    echo "<div class='divTableCell col-md-2'>
                    <input class='btn btn-primary' type='submit' name='changeState' value='Make it Available'>
                    </div>";
                   }
                 echo "</form>";
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
                <div class="divTableHead col-md-6">Book</div>
                <div class="divTableHead col-md-2">Owner</div>
                <div class="divTableHead col-md-2">Due Date</div>
                <div class="divTableHead col-md-1">Action</div>                
              </div>
            </div>
            <div class="divTableBody">
           <?php
              $query = "SELECT concat(u.first_name, ' ', u.last_name) as fullName, b.title,ub.book_id, r.borrower_id, b.author,r.return_date, r.is_answered FROM requests r join user_books ub on r.book_id = ub.book_id join books b on r.book_id = b.isbn join users u on r.owner_id = u.id WHERE borrower_id = {$_SESSION['id']} and is_answered = 'approved';";
              $result = mysqli_query($connection, $query);
              while ($row = mysqli_fetch_assoc($result)){

                echo "<div class='divTableRow'>";
                echo "<form action='includes/updateRequests.php' method='POST'>";
                echo "<div class='divTableHead col-md-6'><strong>\"".$row['title']."\" </strong>By: ".$row['author']."</div>";
                echo "<div class='divTableHead col-md-2'>".$row['fullName']."</div>";
                echo "<div class='divTableHead col-md-2'>".$row['return_date']."</div>";
                echo "<div class='divTableHead'><input type='submit' name='return' value='Return'/></div>";
                echo "</form>";
                echo "</div>";
              }
               ?>
            </div>
          </div>
        </div>
        <!-- Requests tab -->
        <div class="tab-pane" id="requests" role="tabpanel" aria-labelledby="requests-tab">

          <div class="divTable col-md-12">
            <!-- <h1>Lend Requests</h1> -->
            <div class="divTableHeading">
              <div class="divTableRow">
                <div class="divTableHead col-md-6">Book</div>
                <div class="divTableHead col-md-2">Requested by</div>
                <div class="divTableHead col-md-2">Return Date</div>
                <div class="divTableHead col-md-2">Action</div>
              </div>
            </div>
            <div class="divTableBody">
               <?php 
                $query = "SELECT concat(u.first_name, ' ', u.last_name) as fullName, b.title, b.author, r.* FROM requests r 
                          join books b on r.book_id = b.isbn
                          join users u on r.borrower_id = u.id 
                          WHERE owner_id = '{$_SESSION['id']}' and is_answered = 'Pending' ";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)){

                  echo "<div class='divTableRow'>";
                  echo "<form action='includes/updateRequests.php' method='POST'>";
                  echo "<div class='divTableHead col-md-6'><strong>\"".$row['title']."\" </strong>By: ".$row['author']."</div>";
                  echo "<div class='divTableHead col-md-2'>".$row['fullName']."</div>";
                  echo "<div class='divTableHead col-md-2'>".$row['return_date']."</div>";
                  echo "<div class='divTableCell col-md-1'><input class='btn bg-success' type='submit' name='approve' value='Approve'></div>";
                  echo "<div class='divTableCell col-md-1'><input class='btn bg-danger' type='submit' name='reject' value='Reject'></div>";
                  echo "<input type='hidden' name='prevState' value='".$row['is_answered']."'>"; 
                  echo "<input type='hidden' name='bookId' value='".$row['book_id']."'>"; 
                  echo "<input type='hidden' name='borrowerId' value='".$row['borrower_id']."'>"; 
                  echo "</form>";
                  echo "</div>";
                }
                 ?>   
            </div>
          </div>
          
          <div class="divTable col-md-12">
            <h1>Return Requests <small>This can be moved to current rentals as <strong>Lent</strong></small></h1>
            <div class="divTableHeading">
              <div class="divTableRow">
                <div class="divTableHead col-md-6">Book</div>
                <div class="divTableHead col-md-2">Lent to</div>
                <div class="divTableHead col-md-2">Return Date</div>
                <div class="divTableHead col-md-2">Action</div>    
              </div>
            </div>
            <div class="divTableBody">
               <?php 
                $query = "SELECT concat(u.first_name, ' ', u.last_name) as fullName, b.title, b.author, r.* , bo.* FROM requests r 
                          left join borrowed bo on r.id = bo.request_id
                          join books b on r.book_id = b.isbn
                          join users u on r.borrower_id = u.id 
                          WHERE r.owner_id = '{$_SESSION['id']}' and r.is_answered = 'approved' ";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)){
    
                  echo "<div class='divTableRow'>";                  
                  echo "<form action='includes/updateRequests.php' method='POST'>";
                  echo "<div class='divTableHead col-md-6'><strong>\"".$row['title']."\" </strong>By: ".$row['author']."</div>";
                  echo "<div class='divTableHead col-md-2'>".$row['fullName']."</div>";
                  echo "<div class='divTableHead col-md-2'>".$row['return_date']."</div>";
                  if(!(is_null($row['is_returned']) && ( strtotime($row['return_date']) > strtotime(date("Y-m-d")) ))){
                    echo "<div class='divTableCell col-md-1'><input class='btn bg-success' type='submit' name='updateApprovedRequest' value='Returned'></div>" ;
                    echo"<div class='divTableCell col-md-1'><input class='btn bg-danger text-right' type='submit' name='updateApprovedRequest' value='Lost'></div>";
                  }else{
                    echo "<div class='divTableCell col-md-2'>Rented</div>";
                  }
                  echo "<input type='hidden' name='bookId' value='".$row['book_id']."'>"; 
                  echo "<input type='hidden' name='borrowerId' value='".$row['borrower_id']."'>"; 
                  
                  echo "</form>";
                  echo "</div>";
                }
                 ?>  
            </div>
          </div>

          

        </div>
        <!-- SENT REQUEST TAB -->
        <div class="tab-pane" id="sent_requests" role="tabpanel" aria-labelledby="requests-tab">

          <div class="divTable col-md-12">
            <!-- <h1>Sent Requests</h1> -->
            <div class="divTableHeading">
              <div class="divTableRow">
                <div class="divTableHead col-md-6">Book</div>
                <div class="divTableHead col-md-2">Book Owner</div>
                <div class="divTableHead col-md-2">Return Date</div>
                <div class="divTableHead col-md-2">Status</div>
              </div>
            </div>
            <div class="divTableBody">
               <?php 
                
                $query = "SELECT r.*, concat(u.first_name, ' ', u.last_name) as full_name,b.author, b.img_name, b.title FROM requests r join users u on r.owner_id = u.id join books b on r.book_id = b.isbn WHERE is_answered = 'pending' and borrower_id = '{$_SESSION['id']}';";
                $result = mysqli_query($connection, $query);
                
                while ($row = mysqli_fetch_assoc($result)){
                  echo "<div class='divTableRow'>";
                  echo "<div class='divTableHead col-md-6'><i>Title: </i>\" <b>".$row['title']."</b>\"<br><i> Written by:</i> <b>".$row['author']."</b></div>";
                  echo "<div class='divTableHead col-md-2'>".$row['full_name']."</div>";
                  echo "<div class='divTableHead col-md-2'>".$row['return_date']."</div>";
                  echo "<div class='divTableHead col-md-2'>Pending</div>";
                  echo "</div>";
                }
                
                 ?>   
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
