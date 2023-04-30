
$(document).ready(function () {
    $('.delete').on('click' , function(e){
      //Gets the line id for Delete it from database...
        var user_id = $(this).parents('tr').find('.value').text()
        e.preventDefault();
        $.ajax({
          url: 'libs/load.php',
          type: 'POST',
          data: {
            action : 'delete',
            id : user_id,
          },

          success: function(response) {
            //alert
            swal({
              title: "Success!",
              text: "Removed successfully",
              icon: "success",
            })
            $(this).parent('tr').remove();       
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
          }
      });

      
    })
    
});

$('#insert-button').on('click', function () {
  
   
      var des = $('#description').val();
      var date = $('#date').val();
      var amount = $('#amount').val();
      var type = $('#type').val();
      if(des=='' || date=='' || amount == ''){
        swal("Something went wrong try", {
          button: false,
        });
        
      }else{
        $.ajax({
          url: 'libs/load.php',
          method: 'POST',
          data: {
            action: 'insert',
            description : des,
            date : date,
            amount : amount,
            type : type
          },
          success: function(response) {
            swal({
              title: "Success!",
              text: "Your " +type+ " inserted successfully.",
              icon: "success",
            })
            $('#description').val('');
            $('#date').val('');
            $('#amount').val('');

         
          },
          error: function(xhr, status, error) {
            swal("Something went wrong try", {
              button: false,
            });
          }
        });
      };

        
  
  

     
});

$('#active-filter').on('click', function () {
  $('#show-filter').addClass('d-flex');
  $('#show-filter').removeClass('d-none');
  $('#filter-options').addClass('d-flex');
  $('#filter-options').removeClass('d-none');
  $('#custom-filter').addClass('d-flex');
  $('#custom-filter').removeClass('d-none');


});


$('#cancel-filter').on('click', function () {
  $('#show-filter').removeClass('d-flex');
  $('#show-filter').addClass('d-none');
  $('#filter-options').removeClass('d-flex');
  $('#filter-options').addClass('d-none');
  $('#custom-filter').removeClass('d-flex');
  $('#custom-filter').addClass('d-none');
});


$('#session-destroy').on('click', function () {
  session.destroy();
  location.reload();
});

