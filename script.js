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
    for(var i = 0; i < data.length; i++){
      var s = data[i].datum;
      var s1 = data[i].ekipa;
      if(s.indexOf(d) >= 0 && s1 == e){
        var tr = document.getElementById('tabela').tHead.children[0],
        th = document.createElement('th');
        console.log(d + " " + s);
        console.log(s1 + " " + e);
          th.innerHTML = s.slice(-2);
          tr.appendChild(th);
        }
    }
  });
  }
