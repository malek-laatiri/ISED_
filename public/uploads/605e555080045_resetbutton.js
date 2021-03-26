function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("delete").innerHTML = "SUCCES!!";
      }
    };
    xhttp.open("GET", "https://wt.ops.labs.vu.nl/api21/d0bc1d06/reset", true);
    xhttp.send();
  }