<?php 
	include 'server.php';

	$owner_id = $_SESSION['id'];
	$borrower_id = $_POST['borrowerId'];
	$book_id = $_POST['bookId'];
	$prevState = $_POST['prevState'];
	$state = $_POST['state'];

	if(isset($_POST['updateRequest']) && $state !== 'pending') {

		if($state === 'rejected'){
			$query = "UPDATE requests SET `is_answered` = '{$state}' WHERE `owner_id` = {$owner_id} AND `book_id` = {$book_id}  AND borrower_id =  {$borrower_id} ";
		}

		if($state === 'approved'){
			$query = "UPDATE requests
						SET `is_answered` = CASE 
    					WHEN `borrower_id`= $borrower_id THEN '{$state}' 
    					ELSE 'rejected' 
    					END
						WHERE ( `owner_id` =  $owner_id  AND `book_id` = $book_id )";
		}
		
		$result = mysqli_query($connection, $query);
		if($result){
			session_start();
			$_SESSION['msg'] = "Yey!";
			header('location: ../books.php');
		}
	}else {
		header('location: ../books.php');
	}

 ?>