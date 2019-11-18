
$(document).ready(function(){
    $.validator.addMethod("validNom",function(value,element) {
            if(/.{2}/.test(value)){
                return true;
            }else{
                return false;
            };
        }, "Veuillez saisir un nom de 3 lettres min.");
        
    $.validator.addMethod("validPrenom",function(value,element) {
            if(/.{2}/.test(value)){
                return true;
            }else{
                return false;
            };
        }, "Veuillez saisir un prénom de 3 lettres min.");
        
    $.validator.addMethod("validPhone",function(value,element) {
            if(/0[6|7]{1}[0-9]{8}/.test(value)){
                return true;
            }else{
                return false;
            };
        }, "Veuillez saisir un numéro correct ! ex => 0615664758.");
         
    var form = $("#formInscription");
    form.validate({
        rules: {
            'fos_user_registration_form[nom]':{
               validNom: true,
               required: true
            },
            'fos_user_registration_form[prenom]':{
               validPrenom: true,
               required: true
            },
            'fos_user_registration_form[telephone]':{
                validPhone: true,
                required: true
            },
            'fos_user_registration_form[plainPassword][first]':{
                minlength: 5
            },
            'fos_user_registration_form[plainPassword][second]':{
                minlength: 5,
                equalTo: "#fos_user_registration_form_plainPassword_first"
            }
        }
    });
    /* $("#formInscription").submit(function(event) {
        event.preventDefault();
        if(form.valid()){
            var data =$("#formInscription").serialize();
  
        }
    });
    */
});