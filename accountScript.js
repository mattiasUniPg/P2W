function inviaRichiesta()
{
    jQuery.ajax
    ({
        type: "POST",
        url: 'Assets/php/requestChangePassword.php',
        dataType: 'json',
        data: {},
        success: function (response) {
            if(!('error' in response))
            {
                alert(response.message);
            }
            else
                alert(response.error);
        }
    });
}