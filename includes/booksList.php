 <!-- Books list-->
 <div class="divTable col-md-12">
  <div class="divTableHeading">
    <div class="divTableRow">
      <div class="divTableHead col-md-2"></div>
      <div class="divTableHead col-md-2">Author</div>
      <div class="divTableHead col-md-2">Title</div>                
      <div class="divTableHead col-md-1">Status</div>                
      <div class="divTableHead col-md-2">Owner</div>                
      <div class="divTableHead col-md-2">Location</div>                
      <div class="divTableHead col-md-1">&nbsp</div>
    </div>
  </div>
  <div class="divTableBody">
    <?php 
    $added_by = $_SESSION['email'];
    $query = "SELECT b.img_name, b.title, b.author, ub.state, u.last_name, u.first_name,c.name, ub.book_id, ub.user_id, c.id, c.name as city_name FROM books b 
              LEFT JOIN user_books ub on b.isbn = ub.book_id 
              LEFT JOIN users u on u.id = ub.user_id
              LEFT JOIN cities c on u.city_id = c.id";
              
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)){
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
    ?>

  </div>
</div>