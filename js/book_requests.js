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
                $('#message').html(data).show().delay(3000).fadeOut();
                $("#rentModal").modal('hide');
                $("#frm")[0].reset();
              }
            });

          return false;
        });

      });
   });
