<?php 
	include 'server.php';

	$owner_id = $_SESSION['id'];
	$borrower_id = $_POST['borrowerId'];
	$book_id = $_POST['bookId'];

	if(isset($_POST['approve'])) {

		$query = "UPDATE requests
				SET `is_answered` = CASE 
				WHEN `borrower_id`= $borrower_id THEN 'approved' 
				ELSE 'rejected' 
				END
				WHERE ( `owner_id` =  $owner_id  AND `book_id` = $book_id )";

	}else if(isset($_POST['reject'])){
		$query = "UPDATE requests SET `is_answered` = 'rejected' WHERE `owner_id` = {$owner_id} AND `book_id` = {$book_id}  AND borrower_id =  {$borrower_id} ";

	}else {
		header('location: ../books.php');
	}

	$result = mysqli_query($connection, $query);
		if($result){
			session_start();
			$_SESSION['msg'] = "Updated!";
			header('location: ../books.php');
	}
 ?>