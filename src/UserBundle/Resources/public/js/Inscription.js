/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    $("#formInscription").submit(function(event) {
        event.preventDefault();
        $("#formInscription").validate({
            debug: true
        });
 
        var data =$("#formInscription").serialize();
        $.post("/Beezyweb/web/app_dev.php/inscription",data,function(){
            window.location.replace("/Beezyweb/web/app_dev.php/");                                       
        });                           
    });
});