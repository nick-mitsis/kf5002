$(document).ready( function () {
    'use strict';
   
    $('#searchBox').autocomplete({
        source: "http://unn-w16003995.newnumyspace.co.uk/nbc/php/search.php",
        
        minLength: 3, // min 3 characters to start search
        position: {collision: "flip" }, // makes suggestions look well placed
        
        response: function(event, ui) {
            if (ui.content.length === 0) { // In case search finds nothing
                $("#noResults").css('display', 'block');
                $("#noResults").text("No matching books found");
            } 
            else { // Else hide message in case it was already shown
                $("#noResults").empty();
                $("#noResults").css('display', 'none');
            }
        },
        
        select: function(event, ui) {
            console.log(ui);
            // add details of a book to DOM
            $('#chosenBook').text(ui.item.label); 
            $('#ISBN').text('ISBN: ' + ui.item.value);
            $('#category').text('Category: ' + ui.item.cat);
            $('#publisher').text('Publisher: ' + ui.item.pub);
            $('#year').text('Year: ' + ui.item.year);
            $('#price').css('visibility', 'visible');
            $('#price').append(ui.item.price);
            
            var ISBN = ui.item.value;

            // show dialog
            $(function() {
                    $( "#dialog-book" ).dialog( {
                        maxWidth:600,
                        maxHeight: 400,
                        width: 500,
                        height: 350,
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
                            Edit: function() {
                                $( location ).attr( 'href', 'http://unn-w16003995.newnumyspace.co.uk/nbc/edit/bookEditor.php?bookISBN=' + ISBN);
                            },
                            Ok: function() {
                                $('#chosenBook').text( );
                                $('#price').css('visibility', 'hidden');
                                $( this ).dialog( "close" );
                            }
                        }
                    });
            } );
        
        }
    });
});