// Provides functionality once the document/page loads
document.addEventListener("DOMContentLoaded", () => {
    const lookupCoButton = document.getElementById("lookupCountries"); 
    const lookupCiButton = document.getElementById("lookupCities"); 
    const resultDiv = document.getElementById("result");

    lookupCoButton.addEventListener("click", () => { 
        // Store the value entered in the "country" search bar
        const country = document.getElementById("country").value; 
        const xhr = new XMLHttpRequest(); //initialize AJAX request
        xhr.open("GET", `world.php?country=${country}`, true); //GET request to world.php
        xhr.onload = function() { 
            if (xhr.status === 200) { 
                // Prints the data into the result div if the GET status is 200
                resultDiv.innerHTML = xhr.responseText; 
            } else { 
                console.error('Error fetching data:', xhr.statusText); 
            } 
        };
        xhr.send();
    });
    lookupCiButton.addEventListener("click", () => { 
        // Store the value entered in the "country" search bar
        const country = document.getElementById("country").value; 
        const xhr = new XMLHttpRequest(); //initialize AJAX request
        xhr.open("GET", `world.php?country=${country}&lookup=cities`, true); //GET request to world.php
        xhr.onload = function() { 
            if (xhr.status === 200) { 
                // Prints the data into the result div if the GET status is 200
                resultDiv.innerHTML = xhr.responseText; 
            } else { 
                console.error('Error fetching data:', xhr.statusText); 
            } 
        };
        xhr.send();
    });
});