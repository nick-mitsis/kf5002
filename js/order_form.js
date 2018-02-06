//<![CDATA[
    window.onload = function () {
        'use strict';

        // Calculate total cost of order
        function calcCost() {
            var selectBooks = document.getElementById('selectBooks'),
                books = selectBooks.querySelectorAll('input[type=checkbox]'),
                totalSection = document.getElementById('checkCost'),
                numBooks = books.length,
                total = 0,
                totalString,
                currentBook;

            // Books (checkboxes)
            for (var idx = 0; idx < numBooks; idx++) {
                currentBook = books[idx];
                currentBook.onclick = function () {
                    if (this.checked) {
                        total = parseFloat(total) + parseFloat(this.dataset.price);
                    }
                    else {
                        total = parseFloat(total) - parseFloat(this.dataset.price);
                    }
                    total = total.toFixed(2);
                    totalString = '&pound;' + total;
                    totalSection.innerHTML = '<h2>Total cost</h2>\n' +
                        '\t\t\tTotal <input type="text" name="total" value="' + totalString + '" size="10" readonly />\n';
                }
            }



            //-----------------------------------------------------------
            // Delivery method (radio buttons)
            var collectionMethods = document.querySelectorAll('input[type=radio]'),
                nodelivery = document.querySelector('input[value=trade]'),
                //totalSection = document.getElementById('checkCost'),
                numBCollectionMethods = collectionMethods.length,
                currentValue = 0,
                currentMethod;

            nodelivery.checked = true;

            for (var idx = 0; idx < numBCollectionMethods; idx++) {
                currentMethod= collectionMethods[idx];
                currentMethod.onclick = function () {
                    total = parseFloat(total) - parseFloat(currentValue);
                    total = parseFloat(total) + parseFloat(this.dataset.price);
                    total = total.toFixed(2);
                    totalString = '&pound;' + total;
                    currentValue = this.dataset.price;
                    totalSection.innerHTML = '<h2>Total cost</h2>\n' +
                        '\t\t\tTotal <input type="text" name="total" value="' + totalString + '" size="10" readonly />\n';
                }
            }

        }


        // Enable submit button and make terms text black only when checkbox is checked
        function terms() {
            var termsChkbx = document.querySelector('input[name=termsChkbx]'),
                termsText = document.getElementById('termsText'),
                submit = document.querySelector('input[name=submit]');

            termsChkbx.onclick = function(){
                if(submit.disabled === false){
                    submit.disabled = true;
                    termsText.style.fontWeight = "bold";
                    termsText.style.color = "#FF0000";
                }
                else{
                    submit.disabled = false;
                    termsText.style.fontWeight = "normal";
                    termsText.style.color = "#000000";
                }
            }

        }

        // Show the appropriate detail form according to customer selection
        function custDetails() {
            var retail = document.getElementById('retCustDetails'),
                trade = document.getElementById('tradeCustDetails'),
                select = document.querySelector('select[name=customerType]');


            select.onchange = function () {
                if (select.value == "trd"){
                    retail.style.visibility = 'hidden';
                    trade.style.visibility = 'visible';
                }
                else{
                    retail.style.visibility = 'visible';
                    trade.style.visibility = 'hidden';
                }
            }

        }


        var form = document.getElementById('orderForm');

        form.onsubmit = function (e) {
            if( checkform(this)) {
                return true; // form valid; submit it
            } else {
                e.preventDefault(); // don't let the form submit; errors found
                return false;
            }
        };


        // function to check if the form is valid
        // and only then submit
        function checkform(theForm){
            "use strict";

            var select = document.querySelector('select[name=customerType]');

            var selectBooks = document.getElementById('selectBooks'),
                books = selectBooks.querySelectorAll('input[type=checkbox]'),
                numBooks = books.length,
                currentBook,
                booksSelected = false;

            for (var idx = 0; idx < numBooks; idx++) {
                'use strict';
                currentBook = books[idx];
                if(currentBook.checked) {
                    booksSelected = true;
                    break;
                }
            }

            if (booksSelected === false){
                alert( "No books selected. \nPlease select at least one book to proceed with the order." );
                return false;
            }

            if (select.value === ''){
                alert( "Type of customer not selected. \nPlease select type of customer." );
                select.focus();
                return false;
            }

            if (select.value === "ret") {
                if (theForm.forename.value.trim() === '') {
                    alert( "Forename is blank. \nPlease provide your forename." );
                    theForm.forename.focus();
                    return false;
                }

                if (theForm.surname.value.trim() === '') {
                    alert( "Surname is blank. \nPlease provide your surname." );
                    theForm.surname.focus();
                    return false;
                }
            }


            if (select.value === "trd") {
                if (theForm.companyName.value.trim() === '') {
                    alert( "Company name is blank. \nPlease provide the name of your company." );
                    theForm.companyName.focus();
                    return false;
                }
            }


            return true;
        }

        calcCost();
        terms();
        custDetails();
    }
//]]>