email = "";

function inviaRichiesta()
{
    email = $("#emailUtente").val();
    
    jQuery.ajax
    ({
        type: "POST",
        url: 'Assets/php/requestChangePassword.php',
        dataType: 'json',
        data: {email : email},
        success: function (response) {
            if(!('error' in response))
            {
                document.location.href = "index.php?message="+response.message;
            }
            else
                alert(response.error);
        }
    });
}