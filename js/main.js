$( document ).ready(function() {
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
});