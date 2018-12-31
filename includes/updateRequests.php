<?php 
	include 'server.php';

	$owner_id = $_SESSION['id'];
	$borrower_id = $_POST['borrowerId'];
	$book_id = $_POST['bookId'];
	$request_id = $_POST['requestId'];

	if(isset($_POST['approve'])) {

		$query = "UPDATE requests
				SET `is_answered` = CASE 
				WHEN `borrower_id`= $borrower_id THEN 'approved' 
				ELSE 'rejected' 
				END
				WHERE ( `owner_id` =  $owner_id  AND `book_id` = $book_id )";

		$result = mysqli_query($connection, $query);
		if($result){		
			$query = "UPDATE user_books SET `state` = 0 WHERE `user_id` = {$owner_id} AND `book_id` = {$book_id} ";
			$result = mysqli_query($connection, $query);
			if($result){
				session_start();
				$_SESSION['msg'] = "Updated!";
				header('location: ../books.php');
				exit();
			} 					
		}

	}else if(isset($_POST['reject'])){
		$query = "UPDATE requests SET `is_answered` = 'rejected' WHERE `owner_id` = {$owner_id} AND `book_id` = {$book_id}  AND borrower_id =  {$borrower_id} ";

	}else if(isset($_POST['returned'])) {

		$query = "UPDATE return_requests SET `is_returned` = 'returned' WHERE `request_id` =  $request_id ";

	}else if(isset($_POST['notreturned'])){
		$query = "UPDATE return_requests SET `is_returned` = 'not returned' WHERE `request_id` =  $request_id ";
	}
	else {
		header('location: ../books.php');
	}

	$result = mysqli_query($connection, $query);
		if($result){
			session_start();
			$_SESSION['msg'] = "Updated!";
			header('location: ../books.php');
	}
 ?>