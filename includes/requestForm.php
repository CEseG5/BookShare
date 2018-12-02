<!-- Modal -->
<div class="modal fade" id="rentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Book Request</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="includes/requestBook.php">
					<div class="form-group">
						<input type="text" placeholder="Enter return date(mm-dd-yyyy)" name="returnDate">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
						<button type="submit" name="requestBook" class="btn btn-ghost">Save changes</button>
					</div>
				</form>
			</div>
			<?php include 'includes/errors.php' ?>

		</div>
	</div>
</div>
