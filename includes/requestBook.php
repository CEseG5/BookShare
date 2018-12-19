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



      if(empty($return_date)){
         ?>
         <script type="text/javascript">
            alert('Data field is empty!');
         </script>
         <?php
         exit();
      }
     elseif(!strtotime($return_date)){
         ?>
         <script type="text/javascript">
            alert('Date is not valid!');
         </script>
         <?php
         exit();
     } elseif(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$return_date)){
         ?>
         <script type="text/javascript">
            alert('Incorrect Date input!');
         </script>
         <?php
         exit();
     }
      elseif($row >= 1){
         ?>
         <script type="text/javascript">
            alert('Request already sent!');
         </script>
         <?php
         exit();
      } 
      elseif(strtotime($return_date) < strtotime('now') ) {
         ?>
         <script type="text/javascript">
            alert('Date is in invalid format or is in the past!');
         </script>
         <?php
         exit();
      } 

      else {
          $return_date = date("Y-m-d", strtotime($return_date));

                  $sql = "INSERT INTO requests (borrower_id, owner_id, book_id, return_date) VALUES ('$borrower_id','$owner_id','$book_id','$return_date');";

                  if(mysqli_query($connection, $sql)){
                     ?>
                     <script type="text/javascript">
                        alert('Request successfully sent!');
                     </script>
                     <?php
                     exit();
             }
          }

 ?>
