<form class="searchBar col-md-12" method="POST" action="searchBooks.php">
	<div class="row form-group">
		<select class="col-md-2" id="filter" name="city">
			<option value="">City</option>
			<?php
			$query = "select * from cities";
			$result = mysqli_query($connection, $query);
			$search = $_POST['bsearch'];
			while ($row = mysqli_fetch_assoc($result)){

				echo "<option value='{$row['id']}'".($row['id'] == $_POST['city'] ? 'selected': ''). ">".$row['name']."</option>";
			}
			?>
		</select>
		<input type="text" class="inputSearch col-md-8" id="searchbox" value="<?php echo $search; ?>" placeholder="Search book by title, author, ISBN..." name="bsearch">
		<button type="submit" name="search" class="btn btn-primary col-md-2">Search</button>
	</div>
</form>