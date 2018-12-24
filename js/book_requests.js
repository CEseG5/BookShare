 $(document).ready(function(){
    
    $('.rent_book').click(function(e){
        e.preventDefault();

        let url = $(this).attr('data-id');
        let book_id = $(this).attr('book-id');
        let session_id = $(this).attr('data-session');
        let city = $(this).attr('data-city');
        

        $("#owner_id").val(url);
        
        $('#book_id').val(book_id);

        $("#address_id").val(city);

        $('#frm').submit(function(e){
          
          e.preventDefault();
          e.stopImmediatePropagation();
          let removable_fields = $("#removable-fields");
          let return_date = $("input[name=returnDate]").val();
          let city_address = $("input[name=city_address_r]").val();
          let owner_of_book = $("input[name=owner_id_r]").val();
          let borrower_of_book = $("input[name=borrower_id_r]").val();
          let book_id_r = $("input[name=book_id_r]").val();
          let submit = $("#btn_save").val();

          $.ajax({url:"includes/requestBook.php",
                  method:"POST",
                  data:{
                  return_date:return_date,
                  owner_of_book:owner_of_book,
                  borrower_of_book:borrower_of_book,
                  book_id_r:book_id_r
              },
              success:function(data){
                let result = $.trim(data);
                if(result == '<span class="alert alert-danger"> Empty Date</span>' || result == '<span class="alert alert-danger"> Date is not valid </span>' || result == '<span class="alert alert-danger"> Date inputed is not in required format! </span>' || result == '<span class="alert alert-danger"> Date entered is in the past! </span>') {
                  $('#message').html(data).show().delay(3000).fadeOut();
                  $("input[name=returnDate]").val('');
                } else if(result == '<span class="alert alert-danger"> The Request for this book has already been sent! </span>') {
                  $('#message').html(data).show().delay(5000).fadeOut();;
                  $("#removable-fields").hide();
                  $("#btn_save").val('').hide();
                  $("#btn_close").val('').hide();
                  setTimeout(() => {$("#rentModal").modal('hide');}, 4000);
                  setTimeout(() => {location.reload();}, 4000);
                } else {
                  $('#message').html(data).show();
                  $("#removable-fields").hide();
                  $("#btn_save").val('').hide();
                  $("#btn_close").val('').hide();
                  setTimeout(() => {window.location.replace('books.php#sent_requests');}, 4000);
                }
              }
            });

          return false;
        });

      });
   });
