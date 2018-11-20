<?php 
	include 'includes/server.php';

	$user_id = $_POST['userId'];
	$book_id = $_POST['bookId'];
	$prevState = $_POST['prevState'];
	$state = $_POST['state'];

	if(isset($_POST['changeState']) && $state !== $prevState) {
		$query = "UPDATE `user_books` SET `state` = $state WHERE `user_id` = $user_id AND `book_id` = $book_id ";
		$result = mysqli_query($connection, $query);

		if($result){
			session_start();
			$_SESSION['msg'] = "Yey!";
			header('location: books.php');
		}
	}else {
		header('location: books.php');
	}

 ?>