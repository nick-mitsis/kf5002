function getRequest( url, callbackFunction, config ) {
    'use strict';
    var httpRequest, useJSON, useXML,
        responseType = config && config.responseType;

    useJSON = responseType === 'json'; // true if responseType is 'json'
    useXML  = responseType === 'xml'; // true if responseType is 'xml'

    if (window.XMLHttpRequest) { // Mozilla, Safari, ...

        httpRequest = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) { // IE
        try {
            httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {}
        }
    }

    if (!httpRequest) {
        alert('Giving up :( Cannot create an XMLHTTP instance');
        return false;
    }

    httpRequest.open('get', url, true);
    if (useXML && httpRequest.overrideMimeType) {
        httpRequest.overrideMimeType('text/xml');
    }
    else if (useJSON && httpRequest.overrideMimeType) {
        httpRequest.overrideMimeType('application/json');
    }
    httpRequest.onreadystatechange = function() {
        var completed = 4, successful = 200, returnValue;
        if (httpRequest.readyState == completed) {
            if (httpRequest.status == successful) {
                if (useXML) {
                    returnValue = httpRequest.responseXML;
                } else if (useJSON) {
                    returnValue = JSON.parse(httpRequest.responseText);
                } else {
                    returnValue = httpRequest.responseText;
                }
                callbackFunction( returnValue );
            } else {
                alert('There was a problem with the request.');
            }
        }
    }
    httpRequest.send(null);
}  // end of function getRequest

//------------------------------------------------------------------

function updateTarget( txt ) {
    'use strict';
    document.getElementById('target').innerHTML = txt;
}


//------------------------------------------------------------------
window.addEventListener('load',function () {
    'use strict';

    var aside = document.querySelector("aside"),
        mainText = document.getElementById("mainText"),
        section = document.querySelector("section");

    setTimeout(
        function () {
            $('#mainText').fadeIn("slow");
        }
       ,1000);




            setTimeout(function () {
                $('aside').slideDown();
                getRequest('php/getOffers.php', updateTarget);
            }, 1000);

            var autoplay = setInterval( // every 5 seconds (5 + 1 for the animation, total 6) offer updates
                function () {
                    $('aside').slideUp();
                    setTimeout(function () { //animation timeout
                        $('aside').slideDown();
                        getRequest('php/getOffers.php', updateTarget);
                    }, 1000);
                }, 6000);


});