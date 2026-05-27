document.addEventListener("DOMContentLoaded", function(){

    const search = document.getElementById("search");

    if(search)
    {
        search.addEventListener("keyup", function(){

            let keyword = search.value;

            fetch("search.php?keyword=" + keyword)

            .then(response => response.text())

            .then(data => {

                document.getElementById("jobResults").innerHTML = data;

            });

        });
    }

});