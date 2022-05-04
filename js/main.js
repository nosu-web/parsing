$( document ).ready(function() {
    $('#swicthTheme').change(function() {
        let classes = '';
        if ($('#swicthTheme').is(":checked"))
        {
            classes = 'navbar-dark bg-dark';
            $('.navbar').removeClass('navbar-light bg-light');
            $('.navbar').addClass('navbar-dark bg-dark');
        }
        else
        {
            classes = 'navbar-light bg-light';
            $('.navbar').removeClass('navbar-dark bg-dark');
            $('.navbar').addClass('navbar-light bg-light');
        }

        $.get("changeTheme.php?theme=" + classes, function(classes, status){
            console.log("Status: " + status);
        });
    });
});
