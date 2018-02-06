//<![CDATA[
    window.addEventListener('load',function () {
        'use strict';

        // make search button appear when clicked and disappear when out of focus
        function showSearch() {
            var searchBox = document.getElementById('search'),
                searchButton = document.querySelector('button'),
                noResults = document.getElementById('noResults');

            searchButton.onclick = function () {
                if (searchBox.style.display == "block"){
					searchBox.search.value = "";
                }
                else{
                    searchBox.style.display = "block";
					searchBox.search.focus();
                }
				
            }
			
			document.getElementById("search").addEventListener("focusout", hide);
			
			function hide () {
				if (searchBox.style.display == "block"){
                    searchBox.style.display = "none";
					searchBox.search.value = "";
					noResults.style.display = "none";
					noResults.innerHTML = "";
                }
			}
        }
        showSearch();
    });
//]]>