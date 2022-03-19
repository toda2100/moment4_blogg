document.getElementById("element").style.display = "none";      //hämta via ID för själva div. 
document.getElementById("all").style.display = "none";

let open = document.getElementById('open');
open.onclick = function () {                 //funktion körs för att dölja och ta bort knappar vid klick på att visa mer. 
    document.getElementById('element').style.display = 'block';
    document.getElementById('open').style.display = "none";
    document.getElementById('all').style.display = "block";
}

