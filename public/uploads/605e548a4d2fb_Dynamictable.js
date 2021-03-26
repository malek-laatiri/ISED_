/* var response = request.open("get","https://wt.ops.labs.vu.nl/api21/d0bc1d06", true);
  

// convert string to JSON
response = $.parseJSON(response);

$(function() {
  $.each(response, function(i, item) {
      var $tr = $('<tr>').append(
          $('<td>').text(item.rank),
          $('<td>').text(item.content),
          $('<td>').text(item.UID)
      ); //.appendTo('#records_table');
      console.log($tr.wrap('<p>').html());
  });
}); */

//dynamic table


//get a reference to table body

const productsBody = document.querySelector("#ProductTable > tbody")

//function that will load the json file

function loadProducts() {

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //document.getElementById("demo").innerHTML = this.responseText;
      console.log(JSON.parse(this.responseText))
      for (let i in JSON.parse(this.responseText)) {
        $("#ProductTable > tbody").append("<tr>" +
          "<td> <img  width='200' height='200'src='" + JSON.parse(this.responseText)[i].image + "'></td>" +
          "<td>" + JSON.parse(this.responseText)[i].product + "</td>" +
          "<td>" + JSON.parse(this.responseText)[i].origin + "</td>" +
          "<td>" + JSON.parse(this.responseText)[i].best_before_date + "</td>" +
          "<td>" + JSON.parse(this.responseText)[i].amount + "</td>" +

          +"</tr>"

        )
      }
    }
  };
  xhttp.open("GET", "https://wt.ops.labs.vu.nl/api21/d0bc1d06", true);
  xhttp.send();


}

function clean() {
  $("#ProductTable > tbody").empty();
}

/* function populateProducts(json) {
  //clear current table body (instead of manually)
  while (productsBody.firstChild) {
    productsBody.removeChild(rankingsBody.firstChild);
  }

  //populate table

  json.forEach((row) => {
    // for each row we make a new <tr> elements
    const tr = document.createElement("tr");

    row.forEach((cell) => {
      const td = document.createElement("td");
      td.textContent = cell;
    //append the table cell to the table rows
      tr.appendChild(td);
    });

    productsBody.appendChild(tr);
}*/

document.addEventListener("DOMContentLoaded", () => {
  loadProducts();
});

function CreateTableFromJSON() {
  

  var xhttp = new XMLHttpRequest();
  var x = new FormData();

  x.append("image", document.getElementById("image").value);
  x.append("product", document.getElementById("product").value);
  x.append("origin", document.getElementById("origin").value);
  x.append("best_before_date", document.getElementById("best_before_date").value);
  x.append("amount", document.getElementById("amount").value);
  xhttp.onreadystatechange = function () {

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        $("#ProductTable > tbody").empty();

        if (this.readyState == 4 && this.status == 200) {
          //document.getElementById("demo").innerHTML = this.responseText;
          console.log(JSON.parse(this.responseText))
          for (let i in JSON.parse(this.responseText)) {
            $("#ProductTable > tbody").append("<tr>" +
              "<td> <img  width='200' height='200'src='" + JSON.parse(this.responseText)[i].image + "'></td>" +
              "<td>" + JSON.parse(this.responseText)[i].product + "</td>" +
              "<td>" + JSON.parse(this.responseText)[i].origin + "</td>" +
              "<td>" + JSON.parse(this.responseText)[i].best_before_date + "</td>" +
              "<td>" + JSON.parse(this.responseText)[i].amount + "</td>" +
    
              +"</tr>"
    
            )
          }
        }
      };
      xhttp.open("GET", "https://wt.ops.labs.vu.nl/api21/d0bc1d06", true);
      xhttp.send();
    


  }

  xhttp.open("POST", "https://wt.ops.labs.vu.nl/api21/d0bc1d06", true);
  xhttp.send(
    x
  );


}