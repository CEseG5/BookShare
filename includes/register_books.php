<?php 
      $isbn = '';
      $author = '';
      $title = '';
      $img_name = '';
      $errors = array();

      $query = "SELECT id from users where email= '{$_SESSION['email']}'";
      $result = mysqli_query($connection, $query);
      $row = mysqli_fetch_assoc($result);
      $id = (int)$row['id'];

    if(isset($_POST['register_books'])){

        $isbn=mysqli_real_escape_string($connection,$_POST["isbn"]);
        $author=mysqli_real_escape_string($connection,$_POST["author"]);
        $title=mysqli_real_escape_string($connection,$_POST["title"]);
        $img_name=$_FILES['image']['name'];

        if (empty($isbn)) {
          array_push($errors, "ISBN is required!");
        }
        if (empty($author)){
          array_push($errors, "Book Author is required!");
        }
        if(empty($title)){
          array_push($errors, "Book Title is required!");
        }
        if(empty($img_name)){
          array_push($errors, "Book Image is required!");
        }
        
        $queryInsertBook = "INSERT INTO `user_books` (`user_id`, `book_id`, `date_registered`) VALUES ($id , '$isbn', NOW())";

        $query = "SELECT isbn, quantity FROM books WHERE isbn='$isbn'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
          
        //If book exists in database
        if ($row['isbn'] === $isbn && count($errors) == 0) {
          //User can save it on their library
          $result = mysqli_query ($connection, $queryInsertBook);
          if (!$result){
            array_push($errors, "This book exists on your 'library'");
          }else if(count($errors) == 0){
            $quantity = (int)$row['quantity']+1;
            $query = "UPDATE books set quantity = $quantity where isbn='$isbn' "; //Increment number of books
            $result = mysqli_query($connection, $query);
          }
        }else{
          //New book is registered
          $query = "INSERT INTO books (isbn,author,title, img_name) VALUES ('$isbn','$author','$title', '$img_name')";
          $result = mysqli_query($connection, $query);
          if($result){//If book is successfully registered 
            mysqli_query($connection, $queryInsertBook); //User can save it on their library
          }
        }     

        if(count($errors) == 0){
          move_uploaded_file($_FILES['image']['tmp_name'], "img/".$img_name);
          header('location: books.php');
        }       
        
      }
 ?>