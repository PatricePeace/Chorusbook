$(document).ready(function()
{
    $("#programmeForm").submit(function()
    {
        $("#programme").empty();

        $.ajax({
            type: "POST",
            url: "programmeAjax.php",
            data: $(this).serialize(),
            datatype: 'json',
            success: function(data)
            {
                console.log(data);
                var style = $("#style option:selected").text();
                if(style == "all")
                {
                    $("#style option").each(function(){
                        style = $(this).text();
                        if($(this).text() != "all")
                        {
                            addOeuvres(style, data[""+style+""], data["login"]);
                        }
                    })
                }
                else
                {
                    addOeuvres(style, data[""+style+""], data["login"]);
                }
            },
            error: function()
            {
                console.log("ERROR");
            }
        });

        return false;
    });

    function addOeuvres(style, oeuvres, login)
    {
        $('#programme').append(
            "<div class='style'>"
            +   "<strong>"+style+"</strong>"
            +   "<ul class='oeuvre_programme'>"
            +   "</ul>"
            + "</div>"
        )

        if(login != 1)
        {
            for(var i=0; i<oeuvres.length; i++)
            {
                $('.oeuvre_programme:last').append(
                    "<li>"+oeuvres[i]['titre']+"</li>"
                )
            }
        }
        else
        {
            for(var i=0; i<oeuvres.length; i++)
            {
                switch(oeuvres[i]['statut'])
                {
                    case 1: $('.oeuvre_programme:last').append(
                            "<li>"+oeuvres[i]['titre']+"</li>"
                            + '<div class="voyant_rouge"></div>'
                            ); break;

                    case 2: $('.oeuvre_programme:last').append(
                            "<li>"+oeuvres[i]['titre']+"</li>"
                            + '<div class="voyant_jaune"></div>'
                             ); break;

                    case 3: $('.oeuvre_programme:last').append(
                        "<li>"+oeuvres[i]['titre']+"</li>"
                            + '<div class="voyant_vert"></div>'
                    ); break;
                }
            }
        }
    }
});