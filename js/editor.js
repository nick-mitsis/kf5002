 //<![CDATA[
    window.onload = function () {
        'use strict';

        // Only when a change is detected and the text does not match
        // the initial one the book can be updated
        function detectChange (element) {
            var input = element,
                submit = document.querySelector('input[type=submit]'),
                initialValue;

            initialValue = input.value;

            input.onchange = function (){
                if (initialValue == input.value){
                    submit.disabled = true;
                }
                else{
                    submit.disabled = false;
                }
            }
        }

        // Run function multiple times for all text inputs
        detectChange(document.querySelector('input[name=bookTitle]'));
        detectChange(document.querySelector('input[name=bookYear]'));
        detectChange(document.querySelector('select[name=catID]'));
        detectChange(document.querySelector('select[name=pubID]'));
        detectChange(document.querySelector('input[name=bookPrice]'));
    }
 //]]>