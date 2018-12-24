 <?php 
      session_start();
      $session_id = $_SESSION['id'];   

      $connection = mysqli_connect('localhost', 'root', '', 'bookshare');

      $return_date = $_POST['return_date'];
      $borrower_id = $_POST['borrower_of_book'];
      $owner_id = $_POST['owner_of_book'];
      $book_id = $_POST['book_id_r'];

      $query_select = "SELECT book_id, borrower_id FROM requests where borrower_id = '$session_id' AND book_id = '$book_id';";

      $result = mysqli_query($connection, $query_select);

      $row = mysqli_num_rows($result);


      $error = '';
      $success = '';

      if(empty($return_date)){
         $error = '<span class="alert alert-danger"> Empty Date</span>';
         echo $error;
         exit();
      }
     elseif(!strtotime($return_date)){
         $error = '<span class="alert alert-danger"> Date is not valid </span>';
         echo $error;
         exit();
     } elseif(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$return_date)){
         $error = '<span class="alert alert-danger"> Date inputed is not in required format! </span>';
         echo $error;
         exit();
     }
      elseif($row >= 1){
         $error = '<span class="alert alert-danger"> The Request for this book has already been sent! </span>';
         echo $error;
         exit();
      } 
      elseif(strtotime($return_date) < strtotime('now') ) {
         $error = '<span class="alert alert-danger"> Date entered is in the past! </span>';
         echo $error;
         exit();
      } 

      else {
          $return_date = date("Y-m-d", strtotime($return_date));

                  $sql = "INSERT INTO requests (borrower_id, owner_id, book_id, return_date) VALUES ('$borrower_id','$owner_id','$book_id','$return_date');";

                  if(mysqli_query($connection, $sql)){
                     $success = "<span class='alert alert-success'>Successful Rent Request! Redirecting to your requests list!</span>";
                     echo $success;
                     
             }
          }

 ?>

