$(
    $('#currentPassword').keyup(function(){
        var currentPassword = $('#currentPassword').val();
        $.ajax(
           { 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            type:'post',
            url:'confirm_admin_password',
            data:{'current_password':currentPassword},
            success:function(resp){
                if(resp == 'true'){
                    $('#currentPasswordMessage').html('Current password is correct');
                    $('#currentPasswordMessage').css('color','green');
                }else{
                    $('#currentPasswordMessage').html('Current password is wrong');
                    $('#currentPasswordMessage').css('color','red');
                }
            },
            error:function(){
                alert('Error');
            }
        }
        )
    })
)