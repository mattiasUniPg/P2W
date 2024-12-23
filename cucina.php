<html lang="it">
    <head>
        <link rel="stylesheet" href="Assets/css/cucinaStyle.css" type="text/css"/>
        <script src="Assets/js/jquery-3.6.0.js"></script>
        <title>Burgerchain</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body> 
        <div class="content"></div>
    </body>
    <script>
        getOrdini();
        
        function getOrdini()
        {
            jQuery.ajax
            ({
                type: "POST",
                url: 'Assets/php/ordiniCucina.php',
                dataType: 'json',
                data: {},
                success: function (response) {
                    if(!('error' in response))
                    {
                        html = "";
                        ordini = response.message;
                        idOrdine = ordini[0]["idOrdine"] + 1;

                        for(index = 0;index<ordini.length;index++)
                        {
                            if(ordini[index]["idOrdine"] != idOrdine)
                            {
                                if(index == 1)
                                    html += "<div class=\"ordineBox\" id=\"" + ordini[index]["idOrdine"] + "\">";
                                else
                                {
                                    html +=  "</div>";
                                    html +=  "<div class=\"ordineBox\" id=\"" + ordini[index]["idOrdine"] + "\">";
                                }

                                html +=  "<div class=\"ordineBoxItem titolo\">Ordine n." + ordini[index]["idOrdine"] + "</div>";
                                html +=  "<div class=\"buttonBox\"><button onclick=\"removeItem(" + ordini[index]["idOrdine"] + ")\" class=\"button\">Rimuovi Ordine</button></div>";
                                idOrdine = ordini[index]["idOrdine"];
                            }

                            html +=  "<div class=\"ordineBoxItem\">-" + ordini[index]["nome"] + " x" + ordini[index]["quantità"] + "</div>";
                            if(ordini[index]["dettagli"] != "")
                                html +=  "<div class=\"ordineBoxItem dettaglio\">Dettagli: " + ordini[index]["dettagli"] + "</div>";
                        }
                        
                        $(".content").html(html);
                    }
                    else
                        alert(response.error);
                }
            });
            
            setTimeout(getOrdini, 60000); //1 minuti
        }
        
        function removeItem(index)
        {
            $("#" + index).remove();
            
            jQuery.ajax
            ({
                type: "POST",
                url: 'Assets/php/setOrdinePronto.php',
                dataType: 'json',
                data: {idOrdine : index},
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
    </script>
</html>