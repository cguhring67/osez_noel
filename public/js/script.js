
var $grid = $('#surprises_grid');
var $images_grid = $('#images_grid');
var $offcanvas_images_grid = $('#offcanvas_images_grid');

var tenor_client_key = 'osez_noel2';
var tenor_limit = 25;
var tenor_next = "";
var tenor_current_url = "";
var tenor_current_search = "";
var ajaxready = true;
var images_root = "/images/";
var current_surprise_url = "";
var current_background_image = "";
var current_case = "";

var tenor_base_url = "https://tenor.googleapis.com";
var featured_url = tenor_base_url + "/v2/featured?key=" + tenor_api_key + "&client_key=" + tenor_client_key + "&limit=" + tenor_limit + "&country=FR&locale=fr_FR&media_filter=gif,tinygif&contentfilter=high";
var categories_url = tenor_base_url + "/v2/categories?key=" + tenor_api_key + "&client_key=" + tenor_client_key + "&country=FR&locale=fr_FR";
var search_url = tenor_base_url + "/v2/search?key=" + tenor_api_key + "&client_key=" + tenor_client_key + "&limit=" + tenor_limit + "&country=FR&locale=fr_FR&media_filter=gif,tinygif&contentfilter=high";
var suggestions_url = tenor_base_url + "/v2/search_suggestions?key=" + tenor_api_key + "&client_key=" + tenor_client_key + "&limit=3&country=FR&locale=fr_FR";

document.addEventListener('click', function (event) {
    let id_element = event.target.id;
    let target_modal;
    var modale_titre = $('#modale_titre');
    var modale_contenu = $('#modale_body');

    if (event.target.matches('rect'))
    {
        let id_case;
        current_case = id_element;
        if (id_element.startsWith('case-'))
        {
            id_case = id_element.substring(5);
        }

        target_modal = 'modale_surprise';
        $('#modale_surprise_titre').text("Choisir une surprise pour le " + id_case + " décembre");

        tenor_current_search = "Noël";
        $('#tenor_search').val(tenor_current_search);
        tenor_search();

    }
    else if (event.target.matches('img'))
    {
        let image_url = event.target.getAttribute('data-imageUrl');
        let image_destination = event.target.getAttribute('data-imageDestination');
        if (image_destination == "fond")
        {
            current_background_image = image_url;
            current_surprise_url = "";
            $('#calendrier image').attr("href", current_background_image);
            image_url = "";
        }
        else
        {
            current_surprise_url = image_url;
            current_background_image = "";
        }

        console.log(image_url);
        if (image_url != "")
        {
            $('#image_choisie').attr("src", image_url);
            target_modal = 'modale_image';
        }
    }
    else if (id_element == 'choix_theme')
    {
        target_modal = 'modale_large';
        modale_titre.text("Choisir un thème");
        $('#modale_description').text("Cliquez sur un thème au choix pour l'appliquer. Vous pourrez ensuite personnaliser les couleurs.");
        $images_grid.empty();
        $images_grid.empty();
        $images_grid.append($('#images_themes').html());

    }
    else if (id_element == 'choix_couleurs')
    {
        $('#personnalisation_cases').addClass('show');

    }
    else if (id_element == 'choix_fond')
    {
        // target_modal = 'modale_large';
        $('#offcanvas_titre').text("Choisir une image d'arrière-plan");
        // $('#modale_description').html("Vous pouvez personnaliser l'image d'arrière-plan du calendrier.<br>Vous avez également la possibilité d'envoyer une photo de votre choix.");
        $offcanvas_images_grid.empty();
        $offcanvas_images_grid.append($('#images_fond').html());
        $('#offcanvas_images').addClass('show');

    }
    else if (id_element == 'partager')
    {
        target_modal = 'modale_partage';
    }

    else if (id_element == 'supprimer')
    {
        target_modal = 'modale_supprimer';
    }

    if (target_modal != undefined)
    {
        var myModal = new bootstrap.Modal(document.getElementById(target_modal), {});
        myModal.show();
    }

}, false);




// function to call the featured and category endpoints
function tenor_featured()
{
    $grid.empty();
    $grid.append( '<h4 class="mt-4">GIFs à la une sur Tenor</h4>' );
    tenor_current_url = featured_url;
    $('#tenor_search').val('');


    $.get(featured_url, function(data)
    {
        featured_gifs = data.results;
        tenor_next = data.next;

        console.log(data);

        for (var i = 0; i < featured_gifs.length; i++)
        {
            var featured_gif = featured_gifs[i];
            var previmgurl = featured_gif["media_formats"]["tinygif"]["url"];
            var imgurl = featured_gif["media_formats"]["gif"]["url"];
            var description = featured_gif.content_description;

            var $items = $('<img src="'+ previmgurl +'" alt="'+ description +'" data-imageUrl="'+imgurl+'" style="height: 200px" class="p-2">');
            // append items to grid
            $grid.append( $items );

        }

    });
}

// function to call the featured and category endpoints
function tenor_search()
{
    var $search_suggestions = $('#search_suggestions');
    $search_suggestions.empty();
    $grid.empty();
    $grid.append( '<h4 class="mt-4">Résultats de recherche pour " ' + tenor_current_search + ' "</h4>' );
    tenor_current_search = $('#tenor_search').val();
    search_url += "&q=" + tenor_current_search;
    suggestions_url += "&q=" + tenor_current_search;
    tenor_current_url = search_url;

    $.get(suggestions_url, function(data)
    {
        search_terms = data.results;

        console.log(search_terms);

        for (var i = 0; i < search_terms.length; i++)
        {
            var current_search_term = search_terms[i];
            console.log(current_search_term);

            var $button = $('<a href="javascript:search_term(\''+current_search_term+'\')" class="btn btn-primary mx-2">'+current_search_term+'</a>');
            $search_suggestions.append( $button );
        }
    });


    $.get(search_url, function(data)
    {
        search_gifs = data.results;
        tenor_next = data.next;

        console.log(search_gifs);

        for (var i = 0; i < search_gifs.length; i++)
        {
            var current_gif = search_gifs[i];
            var previmgurl = current_gif["media_formats"]["tinygif"]["url"];
            var imgurl = current_gif["media_formats"]["gif"]["url"];
            var description = current_gif.content_description;

            var $items = $('<img src="'+ previmgurl +'" alt="'+ description +'" data-imageUrl="'+imgurl+'" style="height: 200px" class="p-2">');
            $grid.append( $items );
        }
    });
}



function tenor_categories()
{
    $grid.empty();
    $grid.append( '<h4 class="mt-4">Catégories de GIFs sur Tenor</h4>' );
    $('#tenor_search').val('');
    tenor_next = '';


    $.get(categories_url, function(data)
    {
        categories = data.tags;

        console.log(categories);

        for (var i = 0; i < categories.length; i++)
        {
            var categorie = categories[i];
            console.log(categorie);
            var imgurl = categorie.image;
            var txt_overlay = categorie.name;
            var search_term = categorie.searchterm;

            var $items = $('<a href="javascript:search_term(\''+search_term+'\')" class="category_link">' +
                '<img src="'+ imgurl +'" alt="'+ txt_overlay +'" style="height: 200px" class="p-2">' +
                '<div class="centered">'+ txt_overlay +'</div>' +
                '</a>');
            // append items to grid
            $grid.append( $items );

        }
    });
}

function search_term(search_term)
{
    tenor_current_search = search_term;
    $('#tenor_search').val(search_term);
    tenor_search();
}


// SUPPORT FUNCTIONS ABOVE
// MAIN BELOW

$("#tenor_featured").on("click", function() {
    tenor_featured();
});

$("#tenor_categories").on("click", function() {
    tenor_categories();
});

$("#tenor_search").on("input", function() {
    tenor_current_search = $('#tenor_search').val();
    if (tenor_current_search != '') tenor_search();
});

$("#bouton_valider_image").on("click", function() {
    if (current_case != "")
    {
        console.log(current_case);
        // attribution de current_surprise_url;
        $('#' + current_case).css('stroke', 'green').css("stroke-width", "5px");
        $('#modale_image').modal('hide');
        $('#modale_surprise').modal('hide');
        current_case = "";
    }
});

$("#couleur_fond").on("input", function() { perso_style_cases(); });
$("#opacite_fond").on("input", function() { perso_style_cases(); });
$("#couleur_bordure").on("input", function() { perso_style_cases(); });
$("#opacite_bordure").on("input", function() { perso_style_cases(); });
$("#epaisseur_bordure").on("input", function() { perso_style_cases(); });
$("#couleur_texte").on("input", function() { perso_style_cases(); });
$("#opacite_texte").on("input", function() { perso_style_cases(); });
$("#couleur_bordure_texte").on("input", function() { perso_style_cases(); });
$("#opacite_bordure_texte").on("input", function() { perso_style_cases(); });
$("#epaisseur_bordure_texte").on("input", function() { perso_style_cases(); });
$("#choix_police").on("input", function() { perso_style_cases(); });

function perso_style_cases()
{
    couleur_fond = $("#couleur_fond").val();
    $('.cal_case').css('fill', couleur_fond);
    opacite_fond = $("#opacite_fond").val();
    $('.cal_case').css('fill-opacity', opacite_fond);
    couleur_bordure = $("#couleur_bordure").val();
    $('.cal_case').css('stroke', couleur_bordure);
    opacite_bordure = $("#opacite_bordure").val();
    $('.cal_case').css('stroke-opacity', opacite_bordure);
    epaisseur_bordure = $("#epaisseur_bordure").val();
    $('.cal_case').css('stroke-width', epaisseur_bordure);
    couleur_texte = $("#couleur_texte").val();
    $('.cal_numero').css('fill', couleur_texte);
    opacite_texte = $("#opacite_texte").val();
    $('.cal_numero').css('fill-opacity', opacite_texte);
    couleur_bordure_texte = $("#couleur_bordure_texte").val();
    $('.cal_numero').css('stroke', couleur_bordure_texte);
    opacite_bordure_texte = $("#opacite_bordure_texte").val();
    $('.cal_numero').css('stroke-opacity', opacite_bordure_texte);
    epaisseur_bordure_texte = $("#epaisseur_bordure_texte").val();
    $('.cal_numero').css('stroke-width', epaisseur_bordure_texte);
    choix_police = $("#choix_police").val();
    $('.cal_numero').css('font-family', choix_police);
}

$(".offcanvas .btn-close").on("click", function() {
    $('.offcanvas').addClass("hiding");
    setTimeout("$('.offcanvas').removeClass('hiding').removeClass('show')", 250);
});



// start the flow

$('#modale_surprise_body').bind('scroll', function()
{
    if (ajaxready == false) return;

    console.log("scrollTop : " + $(this).scrollTop());
    console.log("innerHeight : " + $(this).innerHeight());
    console.log("scrollTop + innerHeight : " + ($(this).scrollTop() + $(this).innerHeight()));

    console.log("scrollHeight : " + $(this)[0].scrollHeight);
    if($(this).scrollTop() + $(this).innerHeight() + 250 >= $(this)[0].scrollHeight)
    {
        if (tenor_next != "")
        {
            ajaxready = false;
            $.get(tenor_current_url + '&pos=' + tenor_next, function(data)
            {
                search_gifs = data.results;
                tenor_next = data.next;

                console.log(search_gifs);

                for (var i = 0; i < search_gifs.length; i++)
                {
                    var current_gif = search_gifs[i];
                    var previmgurl = current_gif["media_formats"]["tinygif"]["url"];
                    var imgurl = current_gif["media_formats"]["gif"]["url"];
                    var description = current_gif.content_description;

                    var $items = $('<img src="'+ previmgurl +'" alt="'+ description +'" data-imageUrl="'+imgurl+'" style="height: 200px" class="p-2">');
                    $grid.append( $items );
                }
                ajaxready = true;

            });
        }
    }
});

$.get('/ajax/liste_themes', function(images)
{
    for (var i = 0; i < images.length; i++)
    {
        var image = images[i];
        var image_url = "/images/modeles_calendriers/" + image;

        var $items = $('<img src="'+ image_url +'" data-imageUrl="'+image_url+'"  alt="'+ image +'" style="height: 200px" class="p-2">');
        // append items to grid
        $("#images_themes").append( $items );

    }
});

$.get('/ajax/liste_arriere_plans', function(images)
{
    for (var i = 0; i < images.length; i++)
    {
        var image = images[i];
        var image_url = "/images/fonds_calendriers/" + image;

        var $items = $('<img src="'+ image_url +'" data-imageUrl="'+image_url+'" data-imageDestination="fond"  alt="'+ image +'" style="max-width: 100%" class="p-2">');
        // append items to grid
        $("#images_fond").append( $items );

    }
});

