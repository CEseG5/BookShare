<?php

	include "server.php";

	if(isset($_POST['return'])){
		$borrowerId = $_POST['borrower_Id'];
		$query = "INSERT INTO return_requests (request_id,is_returned) VALUES ('$borrowerId','pending')";
		$result=mysqli_query($connection,$query);
		header ('location: ../books.php');
	}
?>