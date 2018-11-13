<?php 
      require ('required.php');
      $isbn = '';
      $author = '';
      $title = '';
      $errors = array();


    if(isset($_POST['register_books'])){

        $isbn=mysqli_real_escape_string($connection,$_POST["isbn"]);
        $author=mysqli_real_escape_string($connection,$_POST["author"]);
        $title=mysqli_real_escape_string($connection,$_POST["title"]);

        if (empty($isbn)) {
          array_push($errors, "ISBN is required!");
        }
        if (empty($author)){
          array_push($errors, "Book Author is required!");
        }
        if(empty($title)){
          array_push($errors, "Book Title is required!");
        }
        if(count($errors) == 0){
          $query = "insert into register_books (isbn,author,title) values('$isbn','$author','$title')";
          $result = mysqli_query($connection,$query);
          header('location: profile.php');
        } //Insert query to add book details
      }
      include ('errors.php');

 ?>