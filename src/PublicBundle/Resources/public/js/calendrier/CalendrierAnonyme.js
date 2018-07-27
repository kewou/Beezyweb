$(document).ready(function(){
    var date = new Date();
    
    $("#calendrier").click(function(){
        $.get(link,function(data,status){
            $("#contenu").html(data);
        });
    })    

});