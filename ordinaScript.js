class Prodotto {
    constructor(nomeProdotto, dettagliProdotto, costoProdotto, idProdotto, categoriaProdotto) {
        this.nomeProdotto = nomeProdotto;
        this.dettagliProdotto = dettagliProdotto;
        this.costoProdotto = costoProdotto;
        this.idProdotto = idProdotto;
        this.categoriaProdotto = categoriaProdotto;
        this.quantita = 1;
        this.costoTotale = costoProdotto;
    }
}

class Ordine { 
    constructor() {
        this.prodotti = [];
        this.costoTotale = 0;
    }
    
    addProdotto(nomeProdotto, dettagliProdotto, costoProdotto, idProdotto, categoriaProdotto)
    {
        let p = new Prodotto(nomeProdotto, dettagliProdotto, costoProdotto, idProdotto, categoriaProdotto);
        
        var exists = false;
        
        for(i=0;i<this.prodotti.length;i++)
            if(p.nomeProdotto == this.prodotti[i]["nomeProdotto"])
                if(this.arraysMatch(p.dettagliProdotto,this.prodotti[i]["dettagliProdotto"]))
                {
                    this.prodotti[i]["quantita"] += 1;
                    this.prodotti[i]["costoTotale"] += p.costoProdotto;
                    exists = true;
                }
        
        if(!exists)
            this.prodotti.push(p);
    }
    
    removeItemProdotto(index)
    {
        if(this.prodotti[index]["quantita"] != 1)
        {
            this.prodotti[index]["quantita"] -= 1;
            this.prodotti[index]["costoTotale"] -= this.prodotti[index]["costoProdotto"];
            
            this.costoTotale -= this.prodotti[index]["costoProdotto"];
        }
        else
        {
            this.costoTotale -= this.prodotti[index]["costoProdotto"];
            this.prodotti.splice(index,1);
        }
    }
    
    addItemProdotto(index)
    {
        this.prodotti[index]["quantita"] += 1;
        this.prodotti[index]["costoTotale"] += this.prodotti[index]["costoProdotto"];
        
        this.costoTotale += this.prodotti[index]["costoProdotto"];
    }
    
    visualizzaProdotti()
    {
        console.log(this.prodotti);
    }
    
    svuotaArray()
    {
        this.prodotti = [];
        this.costoTotale = 0;
    }
    
    getProdotti()
    {
        return this.prodotti;
    }
    
    arraysMatch(arr1, arr2){

	if (arr1.length !== arr2.length) return false;

	for (var i = 0; i < arr1.length; i++) {
            if (arr1[i] !== arr2[i]) return false;
	}

	return true;
    }
}

prodotti = [];
ingredienti = [];
paniniMenu = [];
prodotti_cat = [];
categoryId = 1;
prodotto = null;

ordine = new Ordine();

jQuery.ajax
({
    type: "POST",
    url: 'Assets/php/prodotti.php',
    dataType: 'json',
    data: {request: "Prodotti"},
    success: function (response) {
        if(!('error' in response))
        {
            prodotti = response.prodotti;
            getPaniniMenu();
            getIngredienti();
            populateProdotti();
        }
        else
            console.log(response.error);
    }
});

$(".categoria").click(function(event) {
    if(categoryId != event.target.id) {
        categoryId = event.target.id;
        populateProdotti();
    }
});

$("#exitIcon").click(function(event) {
    hideProdottoOrdina();
});

function getIngredienti()
{
    jQuery.ajax
    ({
        type: "POST",
        url: 'Assets/php/ingredienti.php',
        dataType: 'json',
        data: {request: "Ingredienti"},
        success: function (response) {
            if(!('error' in response))
            {
                ingredienti = response.ingredienti;
            }
            else
                console.log(response.error);
        }
    });
}

function getPaniniMenu()
{
    jQuery.ajax
    ({
        type: "POST",
        url: 'Assets/php/paniniMenu.php',
        dataType: 'json',
        data: {request: "PaniniMenu"},
        success: function (response) {
            if(!('error' in response))
            {
                paniniMenu = response.paniniMenu;
            }
            else
                console.log(response.error);
        }
    });
}

function populateProdotti()
{
    html = "";
    
    prodotti_cat = [];
    index = 0;
    
    for(i=0;i<prodotti.length;i++)
        if(prodotti[i]["idCategoria"] == categoryId)
        {
            prodotti_cat[index] = prodotti[i];
            index++;
        }
    
    for(i=0;i<prodotti_cat.length;i++)
    {
        if(prodotti_cat[i]["disponibile"] == 1)
        {
            html+="<div class=\"prodotto\" id=\"" + prodotti_cat[i]["idProdotto"] + "\">" 
            + "<div class=\"fotoProdotto\"> <img class=\"foto\" src=\"" + prodotti_cat[i]["linkImmagine"] + "\"\"> </div>"
            + "<div class=\"nomeProdotto\">" + prodotti_cat[i]["nome"] + "</div>"
            + "<div class=\"costoProdotto\">" + prodotti_cat[i]["costo"] + "€</div>"
            + "<div class=\"buttonProdotto\"> <button class=\"button\" onclick=\"showProdottoOrdina("+ prodotti_cat[i]["idProdotto"] +")\">Aggiungi</button> </div>"
            + "</div>";
        }
    }
    
    $(".prodotti").html(html);
}

function showProdottoOrdina(id)
{
    window.scrollTo(0, 0);
    $('#page').css('display', 'none');
    $('#windowOrdina').css('display', 'flex');
    
    html = "";
    prodotto = getProdottoFromId(id);
    scelteProdotto = getScelteProdotto(id);
    
    html += "<div class=\"sez1\">";
    
    if(prodotto["idCategoria"] == 1)
    {
        idPanino = getPaninoFromMenu(id);
        panino = getProdottoFromId(idPanino);
        scelteProdotto = getScelteProdotto(idPanino);
        html += "<div class=\"sez1Item\" id=\"nomePanino\">" + panino["nome"] + "</div>";
        html += "<div class=\"sez1Item breaker\">Personalizza il panino: </div>";
    }
    else if(prodotto["idCategoria"] == 2)
        html += "<div class=\"sez1Item breaker\">Personalizza il panino: </div>";
    
    for(i=0;i<scelteProdotto.length;i++)
        html += "<div class=\"sez1Item ingrediente\"> No " + scelteProdotto[i]["nome"] + "<input type=\"checkbox\" class=\"checkbox\" name=\"ingredienti\" value=\"No " + scelteProdotto[i]["nome"] + "\"></div>";
    
    html += "</div>";
    
    if(prodotto["idCategoria"] == 1)
    {    
        html += "<div class=\"sez2\">";
        html += "<div class=\"sez2Item breaker\">Seleziona una bibita: </div>";
        
        bibite = getArrayFromIdCategoria(4 /*BIBITE*/);
    
        for(i=0;i<bibite.length;i++)
            html += "<div class=\"sez2Item ingrediente\">" + bibite[i]["nome"] + "<input type=\"radio\" class=\"radio\" name=\"bibite\" value=\"" + bibite[i]["nome"] + "\"></div>";

        html += "</div>";
        
        html += "<div class=\"sez3\">";
        html += "<div class=\"sez3Item breaker\">Seleziona un fritto: </div>";
        
        fritti = getArrayFromIdCategoria(3 /*FRITTI*/);
        
        for(i=0;i<fritti.length;i++)
            html += "<div class=\"sez2Item ingrediente\">" + fritti[i]["nome"] + "<input type=\"radio\" class=\"radio\" name=\"fritti\" value=\"" + fritti[i]["nome"] + "\"></div>";
        
        html += "</div>";
    }
    
    $("#titoloOrdina").text(prodotto["nome"]);
    $("#fotoOrdina").attr("src",prodotto["linkImmagine"]);
    $("#scelteOrdina").html(html);
    $("#buttonOrdina").text(prodotto["costo"] + "€");
}

function hideProdottoOrdina()
{
    window.scrollTo(0, 0);
    prodotto = null;
    $('#windowOrdina').css('display', 'none');
    $('#page').css('display', 'flex');
}

function getPaninoFromMenu(id)
{
    for(i=0;i<paniniMenu.length;i++)
        if(paniniMenu[i]["idMenu"] == id)
            return paniniMenu[i]["idProdotto"];
    
    return null;
}

function getScelteProdotto(id)
{
    scelte = [];
    index = 0;
    
    for(i=0;i<ingredienti.length;i++)
        if(ingredienti[i]["idProdotto"] == id && ingredienti[i]["modificabile"] == 1)
        {
            scelte[index] = ingredienti[i];
            index++;
        }
        
    return scelte;
}

function getProdottoFromId(id)
{
    for(i=0;i<prodotti.length;i++)
        if(prodotti[i]["idProdotto"] == id)
            return prodotti[i];
    
    return null;
}

function getArrayFromIdCategoria(id)
{
    array = [];
    index = 0;
    
    for(i=0;i<prodotti.length;i++)
        if(prodotti[i]["idCategoria"] == id)
        {
            array[index] = prodotti[i];
            index++;
        }
        
    return array;
}

function addProdottoToOrdine()
{
    index = 0;
    dettagli = [];
    var ingredienti = document.getElementsByName("ingredienti");
    var bibite = document.getElementsByName("bibite");
    checkBibite = 0;
    fritti = document.getElementsByName("fritti");
    checkFritti = 0;
    
    if(prodotto["idCategoria"] == 1 || prodotto["idCategoria"] == 2)
        for(i=0;i<ingredienti.length;i++)
            if(ingredienti[i].checked)
            {
                dettagli[index] = ingredienti[i].value;
                index++;
            }
       
    if(prodotto["idCategoria"] == 1)
        for(i=0;i<bibite.length;i++)
            if(bibite[i].checked)
            {
                dettagli[index] = bibite[i].value;
                index++;
                checkBibite++;
            }
    if(prodotto["idCategoria"] == 1)    
        for(i=0;i<fritti.length;i++)
            if(fritti[i].checked)
            {
                dettagli[index] = fritti[i].value;
                index++;
                checkFritti++;
            }
    
    if(prodotto["idCategoria"] == 1)
        if(checkBibite == 0 || checkFritti == 0)
            return false;
    
    ordine.addProdotto(prodotto["nome"],dettagli,prodotto["costo"],prodotto["idProdotto"],prodotto["idCategoria"]);
    
    html = "";
    prodottiOrdine = ordine.getProdotti();
    
    prodottiOrdine.sort(function(a ,b){
        if(a.categoriaProdotto > b.categoriaProdotto) return 1;
        if(a.categoriaProdotto < b.categoriaProdotto) return -1;
        return 0;
    });
    
    for(i=0;i<prodottiOrdine.length;i++)
    {
        html += "<div class=\"ordineProdotto\">";
        
        html += "<div class=\"ordineProdottoQuantity\"><span class=\"ordineProdottoQuantita\"> Quantità: <button onclick=\"rimuoviItem("+i+")\"> < </button>" + prodottiOrdine[i].quantita + "<button onclick=\"aggiungiItem("+i+")\"> > </button></span></div>";
        html += "<div class=\"ordineProdottoTop\"> <span class=\"ordineProdottoNome\"> -" + prodottiOrdine[i].nomeProdotto + " </span><span class=\"ordineProdottoCosto\">" + prodottiOrdine[i].costoTotale + "€ </span>" + "</div>";
        html += "<div class=\"ordineProdottoDettagli\">";
        
        for(o=0;o<prodottiOrdine[i].dettagliProdotto.length;o++)
            html += "<div class=\"ordineProdottoDettagliItem\"> -" + prodottiOrdine[i].dettagliProdotto[o] +"</div>";
        
        html += "</div>";
        
        html += "</div>";
    }
    
    ordine.costoTotale += prodotto["costo"];
    
    $(".prodottiOrdine").html(html);
    $(".prezzoOrdine").text("Totale : " + ordine.costoTotale + "€");
    
    hideProdottoOrdina();
}

function inviaOrdine()
{
    if(ordine.getProdotti().length > 0)
        jQuery.ajax
        ({
            type: "POST",
            url: 'Assets/php/inviaOrdine.php',
            dataType: 'json',
            data: {prodotti: ordine.getProdotti()},
            success: function (response) {
                if(!('error' in response))
                {
                    alert(response.message);
                    ordine.svuotaArray();
                    $(".prodottiOrdine").html("");
                    $(".prezzoOrdine").text("");
                }
                else
                    alert(response.error);
            }
        });
    else
        alert("Nessun prodotto presente nell'ordine, riprovare!");
}

function aggiungiItem(index)
{
    ordine.addItemProdotto(index);
    refreshGUI();
}

function rimuoviItem(index)
{
    ordine.removeItemProdotto(index);
    refreshGUI();
}

function refreshGUI()
{
    html = "";
    prodottiOrdine = ordine.getProdotti();
    
    prodottiOrdine.sort(function(a ,b){
        if(a.categoriaProdotto > b.categoriaProdotto) return 1;
        if(a.categoriaProdotto < b.categoriaProdotto) return -1;
        return 0;
    });
    
    for(i=0;i<prodottiOrdine.length;i++)
    {
        html += "<div class=\"ordineProdotto\">";
        
        html += "<div class=\"ordineProdottoQuantity\"><span class=\"ordineProdottoQuantita\"> Quantità: <button onclick=\"rimuoviItem("+i+")\"> < </button>" + prodottiOrdine[i].quantita + "<button onclick=\"aggiungiItem("+i+")\"> > </button></span></div>";
        html += "<div class=\"ordineProdottoTop\"> <span class=\"ordineProdottoNome\"> -" + prodottiOrdine[i].nomeProdotto + " </span><span class=\"ordineProdottoCosto\">" + prodottiOrdine[i].costoTotale + "€ </span>" + "</div>";
        html += "<div class=\"ordineProdottoDettagli\">";
        
        for(o=0;o<prodottiOrdine[i].dettagliProdotto.length;o++)
            html += "<div class=\"ordineProdottoDettagliItem\"> -" + prodottiOrdine[i].dettagliProdotto[o] +"</div>";
        
        html += "</div>";
        
        html += "</div>";
    }
    
    $(".prodottiOrdine").html(html);
    if(prodottiOrdine.length > 0)
        $(".prezzoOrdine").text("Totale : " + ordine.costoTotale + "€");
    else
        $(".prezzoOrdine").text("");
}

function disableScroll() {
    // Get the current page scroll position
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
  
    // if any scroll is attempted, set this to the previous value
    window.onscroll = function() {
        window.scrollTo(scrollLeft, scrollTop);
    };
}
  
function enableScroll() {
    window.onscroll = function() {};
}