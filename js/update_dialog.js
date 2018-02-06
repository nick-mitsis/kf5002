$(document).ready(function() {
    $(function() { // function to display a jQuery dialog
        $( "#dialog-message" ).dialog( {
            maxWidth:600,
            maxHeight: 400,
            width: 400,
            height: 220,
            show: {
                effect : "fold",
                duration: 400
            },
            hide: {
                effect : "fold",
                duration : 400
            },
            modal: true,
            buttons: {
                Ok: function() {
                    $( this ).dialog( "close" );
                }

            }
        });
    } );
});