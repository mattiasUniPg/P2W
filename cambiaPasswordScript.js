password = "";
passwordRepeat = "";

function inviaRichiesta()
{
    password = $("#passwordUtente").val();
    passwordRepeat = $("#repeatPasswordUtente").val();
    
    if(password == passwordRepeat)
        jQuery.ajax
        ({
            type: "POST",
            url: 'Assets/php/changePassword.php',
            dataType: 'json',
            data: {password: password},
            success: function (response) {
                if(!('error' in response))
                    document.location.href = "index.php?message="+response.message;
                else
                    alert(response.error);
            }
        });
    else
        alert("Le password non coincidono!");
}