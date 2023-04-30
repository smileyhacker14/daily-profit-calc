// $(document).ready(function() {
//  var num = 1;
// $('#add-income').on('click' , function(){
//     var getIncome = '<div class="form-group">'+
//     '<input type="text" class="form-control item" id="birth-date" name="income-method-'+num+'" placeholder="">'+
//     '</div>'    
//     if (num <= 3){
//         $('form #income-method-area').append(getIncome);
//     }else{
//         swal("Limit is 3 Only", {
//             button: false,
//           });
//     }
//     num++;
// });

// var num2 =1 ;
// $('#add-expense').on('click' , function(){
//     var getExpense = '<div class="form-group">'+
//     '<input type="text" class="form-control item" id="birth-date" name="income-method-'+num2+'" placeholder="">'+
//     '</div>'
//     if (num2 <= 3){
//         $('#expense-method-area').append(getExpense);
//     }else{
//         swal("Limit is 3 Only", {
//             button: false,
//           });
//     }
    
//     num2++;
// })


$('#submit-btn').on('click', function () {
    $.ajax({
        url: 'libs/load.php',
        method: 'POST',
        data: {
          income: 'income',
          id : user_id
        },
        success: function(response) {
            $(this).parents("tr").remove();
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    
});

// });

