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
        <div> 
          <ul class="nav nav-fill nav-tabs" id="myTab" role="tablist" ata-animate-effect="fadeIn" >
            <li class="active nav-item">
              <a class="nav-link" id="mybooks-tab" data-toggle="tab" href="#mybooks" role="tab" aria-controls="mybooks" aria-selected="false">My Books</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" id="rentals-tab" data-toggle="tab" href="#rentals" role="tab" aria-controls="rentals" aria-selected="false">Current Rentals</a>
            </li>            
            <li class="nav-item">
              <a class="nav-link" id="requests-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="false" >Requests</a>
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
                  <div class="divTableHead col-md-3">Author</div>
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
                 $selected = $row['state'] === '1' ? 'selected' : '';
                 echo "<div class='divTableRow'>";
                 echo "<form action='changeBookStatus.php' method='POST'>";
                 echo "<div class='divTableCell col-md-2'><img src='img/".$row['img_name']."'></div>";
                 echo "<div class='divTableCell col-md-3'>". $row['author'] ."</div>";   
                 echo "<div class='divTableCell col-md-3'>". $row['title'] ."</div>";   
                 echo "<div class='divTableCell col-md-2'><select name='state'>
                                                           <option value='0' ".$selected.">Not available</option>
                                                           <option value='1' ".$selected.">Available</option>
                                                          </select></div>";
                 echo "<input type='hidden' name='prevState' value='".$row['state']."'>"; 
                 echo "<input type='hidden' name='userId' value='".$row['user_id']."'>"; 
                 echo "<input type='hidden' name='bookId' value='".$row['book_id']."'>"; 
                 echo "<div class='divTableCell col-md-2 text-right'><input class='btn-link' type='submit' name='changeState' value='Save'></div>";
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
        <!-- Requests tab -->
        <div class="tab-pane" id="requests" role="tabpanel" aria-labelledby="requests-tab">

          <div class="divTable col-md-12">
            <h1>Requests</h1>
            <div class="divTableHeading">
              <div class="divTableRow">
                <div class="divTableHead col-md-3">Book</div>
                <div class="divTableHead col-md-3">Requested by</div>
                <div class="divTableHead col-md-3">Return Date</div>
                <div class="divTableHead col-md-2">State</div>
                <div class="divTableHead col-md-1">&nbsp</div>
              </div>
            </div>
            <div class="divTableBody">
               <?php 
                $query = "SELECT * FROM requests WHERE owner_id = '{$_SESSION['id']}' and is_answered = 'Pending' ";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)){

                  echo "<div class='divTableRow'>";
                  echo "<form action='includes/updateRequests.php' method='POST'>";
                  echo "<div class='divTableHead col-md-3'>".$row['book_id']."</div>";
                  echo "<div class='divTableHead col-md-3'>".$row['borrower_id']."</div>";
                  echo "<div class='divTableHead col-md-3'>".$row['return_date']."</div>";
                  echo "<div class='divTableCell col-md-2'><select name='state'>
                                                           <option value='pending'>Pending</option>
                                                           <option value='approved'>Approve</option>
                                                           <option value='rejected'>Reject</option>
                                                          </select></div>";
                  echo "<input type='hidden' name='prevState' value='".$row['is_answered']."'>"; 
                  echo "<input type='hidden' name='bookId' value='".$row['book_id']."'>"; 
                  echo "<input type='hidden' name='borrowerId' value='".$row['borrower_id']."'>"; 
                  echo "<div class='divTableCell col-md-1 text-right'><input class='btn-link' type='submit' name='updateRequest' value='Save'></div>";
                  echo "</form>";
                  echo "</div>";
                }
                 ?>   
            </div>
          </div>
          
          <div class="divTable col-md-12">
            <h1>Approved</h1>
            <div class="divTableHeading">
              <div class="divTableRow">
                <div class="divTableHead col-md-3">Book</div>
                <div class="divTableHead col-md-3">Borrowed by</div>
                <div class="divTableHead col-md-3">Due Date</div>
                <div class="divTableHead col-md-2">Status</div>
                <div class="divTableHead col-md-1">&nbsp</div>    
              </div>
            </div>
            <div class="divTableBody">
               <?php 

                $query = "SELECT * FROM requests r left join borrowed b on r.id = b.request_id WHERE r.owner_id = '{$_SESSION['id']}' and r.is_answered = 'approved' ";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)){

                  $selection = "<select name='state'>
                                 <option value='pending'>Pending</option>
                                 <option value='returned'>Returned</option>
                                 <option value='not returned'>Not Returned</option>
                                </select>";     

                  $hide = ( is_null($row['is_returned']) && ( strtotime($row['return_date']) > strtotime(date("Y-m-d"))) )? "" : $selection;

                  echo "<div class='divTableRow'>";                  
                  echo "<form action='includes/updateRequests.php' method='POST'>";
                  echo "<div class='divTableHead col-md-3'>".$row['book_id']."</div>";
                  echo "<div class='divTableHead col-md-3'>".$row['borrower_id']."</div>";
                  echo "<div class='divTableHead col-md-3'>".$row['return_date']."</div>";
                  echo "<div class='divTableCell col-md-2'>".$hide."</div>";
                  //echo "<input type='hidden' name='prevState' value='".$row['is_answered']."'>"; 
                  echo "<input type='hidden' name='bookId' value='".$row['book_id']."'>"; 
                  echo "<input type='hidden' name='borrowerId' value='".$row['borrower_id']."'>"; 
                  echo "<div class='divTableCell col-md-1 text-right'><input class='btn-link' type='submit' name='updateApprovedRequest' value='Save'></div>";
                  echo "</form>";
                  echo "</div>";
                }
                 ?>   
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