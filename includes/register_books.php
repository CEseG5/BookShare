<?php 
      $isbn = '';
      $author = '';
      $title = '';
      $img_path = '';
      $errors = array();


    if(isset($_POST['register_books'])){

        $isbn=mysqli_real_escape_string($connection,$_POST["isbn"]);
        $author=mysqli_real_escape_string($connection,$_POST["author"]);
        $title=mysqli_real_escape_string($connection,$_POST["title"]);
        $img_path=$_FILES['image']['name'];

        if (empty($isbn)) {
          array_push($errors, "ISBN is required!");
        }
        if (empty($author)){
          array_push($errors, "Book Author is required!");
        }
        if(empty($title)){
          array_push($errors, "Book Title is required!");
        }
        if(empty($img_path)){
          array_push($errors, "Book Image is required!");
        }

        if(count($errors) == 0){
          $query = "insert into register_books (isbn,author,title, img_path) values('$isbn','$author','$title', '$img_path')";
          $result = mysqli_query($connection,$query);
          if ($result) {

            move_uploaded_file($_FILES['image']['tmp_name'], "img/".$img_path);
          }
          header('location: profile.php');
        }
      }
 ?>