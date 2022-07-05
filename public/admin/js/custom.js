$(
    $('.nav-item').removeClass('active'),
    $('.nav-link').removeClass('active'),
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
    }),

    $('.vendors').on('change',function(){
        let adminId =  $(this).attr("adm_id");
        let status = Number(document.getElementById('inp-'+adminId).checked);
        $.post(
            {
                url:'/admin/update_admin_status',
                type:'post',
                data:{status:status,adm_id:adminId},
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(resp){
                    if(resp.statuscode!=200){
                        alert('Error');
                    }
                },
                error:function(){
                    alert('Error');
                }
            }
        )
    })
)

