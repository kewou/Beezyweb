var link ="listeClient";
$('input.typeahead').typeahead({
    minLength: 2,
    source: function (query, process) {
        tab = [];
        $.ajax({
            dataType: "json",
            type: "POST",
            url: link,
            data: {action: "adminListe_client"},
            success: function (data) {                
                for (var i = 0, c = data.length; i < c; i++) {
                    tab[i] = data[i].nom;
                }                
                process(tab);
            }
        });

    },
    updater: function (item) {
        /* navigate to the selected item */
        infosClient(item);        
    }
});


function infosClient(nomClient) {
    var link = "infos-client";
    $.ajax({
        type: "POST",
        url: link,
        data: {action: "infosClient", nomClient: nomClient},
        success: function (data) {           
            $("#contenu").html(data);
        }
    });
}

function ajouterArgent(){
    var link = "ajouter-argent";    
    var somme=$("#somme").val();
    confirm("Ajouter cette somme "+ somme +" € ?");
    var id=$(".wrapperDivContenu p").html();
    $.ajax({
            type: "POST",
             url: link,
             data: {somme: somme, id:id},
             success: function(data){
                    $("#contenu").html(data);					
             }
    });
}
