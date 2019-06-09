function isci(){
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("iskanje");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabela");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td){
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function isciE(){
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("iskanje");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabela");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td){
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function isciP(){
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("iskanje");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabela");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td){
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function set60(){
  document.getElementById('trajanje').value = 60;
}
function set90(){
  document.getElementById('trajanje').value = 90;
}
function set120(){
  document.getElementById('trajanje').value = 120;
}
function setDate(){
  var date = new Date();
  var currentDate = date.toISOString().slice(0,10);
  document.getElementById('datumTrening').value = currentDate;
}
$(document).ready(function() {
  $(".priso").click(function () {
    var id = $(this).val();
    console.log(id);
    $("#"+id).css("display","block");
  });
  $(".zapri").click(function () {
    var id = $(this).val();
    $("span").css("display","none");
    console.log("zapri");

  });
});
function getJson(){
  $("#tabela th").not(".def").remove()
  $.getJSON("./Prisotnost.php", function(data) {
    var d = document.getElementsByName('datum')[0].value;
    var e = document.getElementsByName('ekipa')[0].value;
    var datum,counter=0;
    var trening = false;
    for(var i = 0; i < data.length; i++){
      var listTH = document.getElementsByTagName("th");
      if(data[i]['treningi'].datum != null){
        var s = data[i]['treningi'].datum;
        var s1 = data[i].ekipaID;
        if(s.indexOf(d) >= 0 && s1 == e){
          trening = true;
          var tr = document.getElementById('tabela').tHead.children[0],
          th = document.createElement('th');
          th.innerHTML = s.slice(-2);
          tr.appendChild(th);
          datum = data[i].datum;
          counter++;
        }
    }
}
    if(trening){
      for(var i = 0; i < data[0].steviloIgralcev; i++){
      var tableRef = document.getElementById('tabela').getElementsByTagName('tbody')[0];
      var newRow   = tableRef.insertRow(tableRef.rows.length);
      var newCell  = newRow.insertCell(0);
      var newText  = document.createTextNode(data[i].ime);
      newCell.appendChild(newText);
      var newCell  = newRow.insertCell(1);
      var newText  = document.createTextNode(4);
      newCell.appendChild(newText);
      var newCell  = newRow.insertCell(2);
      var newText  = document.createTextNode(3);
      newCell.appendChild(newText);
      newCell.appendChild(newText);
      var newCell  = newRow.insertCell(2);
      var newText  = document.createTextNode(12);
      newCell.appendChild(newText);
      if(e.indexOf(data[i].id)){
        for(var j = 4; j < 4+counter; j++){
          var newCell  = newRow.insertCell(j);
          var newText  = document.createTextNode(data[i].prisotnost);
          newCell.appendChild(newText);
        }
      }
    }
  }
  });
  }
