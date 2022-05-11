$( document ).ready(function() {
    //console.log(document.cookie);
    let current_theme = getCookieValueByName('theme');
    if(current_theme == 'navbar-dark bg-dark') {
        $('#swicthTheme').prop('checked', true);
    }

    $('#swicthTheme').change(function() {
        let theme_classes = '';
        if ($('#swicthTheme').is(":checked"))
        {
            theme_classes = 'navbar-dark bg-dark';
            $('.navbar').removeClass('navbar-light bg-light');
            $('.navbar').addClass('navbar-dark bg-dark');
        }
        else
        {
            theme_classes = 'navbar-light bg-light';
            $('.navbar').removeClass('navbar-dark bg-dark');
            $('.navbar').addClass('navbar-light bg-light');
        }

        document.cookie = "theme=" + theme_classes + "; expires=Fri, 31 Dec 2100 23:59:59 GMT";
    });

    let counter = 9; 
    $('#loadNews').click(function() {
        $.getJSON( "loadNews.php?counter="+counter, function( news ) {
            $.each( news, function( key, item ) {
                console.log(key, item);
                $( "<div class=\"card my-2\">"+
                    "<img src=\""+item.img+"\" class=\"card-img-top\" alt=\""+item.title+"\">"+
                    "<div class=\"card-body\">"+
                        "<h5 class=\"card-title\">"+item.title+"</h5>"+
                        "<h6 class=\"card-subtitle mb-2 text-muted\">"+item.date+"</h6>"+
                        "<p class=\"card-text\">"+item.text.substring(0, 100)+"...</p>"+
                        "<a href=\"{$url}\" class=\"btn btn-primary\" target=\"_blank\">Подробнее</a>"+
                    "</div>"+
                "</div>" ).appendTo( ".news" );

            });
            counter = counter + 9;
        });
    });
});

function getCookieValueByName(cookieName) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
      let [key,value] = el.split('=');
      cookie[key.trim()] = value;
    })
    console.log(cookie);
    return cookie[cookieName];
<<<<<<< HEAD
  }
=======
  }
>>>>>>> dde619d234e686230fa701e186f64b040d4796bf
