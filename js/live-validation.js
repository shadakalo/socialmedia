$(document).ready(function(){
    $('#reg_email').keyup(function(){
        var email = $(this).val();
        $.ajax({
            url:"checkuser.php",
            method:"POST",
            data:{email:email},
            success:function(data){
                $('#emailstatus').html(data);
            }
        });
    });
});