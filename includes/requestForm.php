<div class="modal fade" id="rentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center font-weight-bold" id="exampleModalLabel">Book Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="frm">
          <div class="form-group">
          	<div class="container message alert col-md-offset-5" style="color:green" id="message"></div>
            <div class="font-weight-light text-center">Return Date:</div>
            <input class="form-control lg text-center" type="text" placeholder="Enter return date(YYYY-MM-DD)" name="returnDate" id="return_date">
          </div>
          <div class="form-group">
            <div class="font-weight-light text-center">Owner Address:</div>
            <input type="text" class="alert alert-info form-control text-center font-weight-bold" readonly id="address_id" name="city_address_r">
          </div>
          <div class="form-group">
            <input type="text" id="owner_id" name="owner_id_r" hidden disabled>
          </div>
          <div class="form-group">
            <input type="text" disabled id="borrower_id" name="borrower_id_r" hidden value="<?= $_SESSION['id'] ?>">
          </div>
          <div class="form-group">
            <input type="text" disabled id="book_id" name="book_id_r" hidden>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            <button type="submit" name="requestBook" class="btn btn-ghost" id="btn_save" name="submit">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> 
