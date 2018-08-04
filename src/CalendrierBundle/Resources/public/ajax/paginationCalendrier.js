  
$(document).on('click', 'button.nextSevenDay', function(){
    alert("fuck");
    that = $(this);
    $.ajax({
        url:"{{ (path('Privee_calendrier')) }}",
        type: "POST",
        dataType: "json",
        data: {
            "plusSeptDays": "7"
        },
        async: true,
        success: function (data)
        {
            console.log(data)
            $('#contenu').html(data.output);

        }
    });
    return false;

});
    


