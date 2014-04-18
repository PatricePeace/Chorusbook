$(document).ready(function()
{
    $( "#datepicker" ).datetimepicker({
        format:'Y-m-d H:i'
    });

    $( "#evenement option[value='3']").remove();

    $( "#evt_oeuvres" ).on("click","li", function() {
        $("#all_oeuvres").append($(this));
    });

    $( "#all_oeuvres" ).on("click","li", function() {
        $("#evt_oeuvres").append($(this));
    });

    $("#creerEvenement").submit(function()
    {
        var oeuvres = new Array();
        var i = 0;

        $("#evt_oeuvres li").each(function(){
               oeuvres[i] = $(this).attr("value");
               i++;
        });

        var data = {
            'oeuvres' : oeuvres
        };

        data = $(this).serialize() + '&' + $.param(data);

        $.ajax({
            type: "POST",
            url: "creationEvenementRequest.php",
            data: data,
            success: function(data)
            {
                alert(data);
            },
            error: function(data)
            {
                alert("Création impossible");
            }

        });

        return false;
    });

});