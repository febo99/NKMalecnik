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
function inTable(t,name){
  for(var i = 0; i < t.length; i++){
    if(t[i][name] == name)return true;
  }
  return false;
}
function getJson(){
  $("#tabela th").not(".def").remove();
  $("#tabela td").not(".def").remove();
  $("#tabela tr").not(".stat").remove();
  $.getJSON("./Prisotnost.php", function(data) {
    $("#tabela th").not(".def").remove();
    $("#tabela td").not(".def").remove();
    var table = document.getElementById('tabela');
    var training = [];
    var tabelaPrisotnost = [];
    var d = document.getElementsByName('datum')[0].value;
    var e = document.getElementsByName('ekipa')[0].value;
    var counter=0;
    var vpis = false;
    var trening = false;
    var x;
    for(var i = 0; i < data.length; i++){
      var listTH = document.getElementsByTagName("th");
      for(var j = 0; j < data[i]['treningi'].length;j++){
        if(data[i]['treningi'][j] != null){
          if(data[i]['treningi'][j].datum != null && data[i]['ekipaID'] == e){
            var s = data[i]['treningi'][j].datum;
            var s1 = data[i].ekipaID;
            if(s.indexOf(d) >= 0 && s1 == e){
              counter++;
            }}}}}
    for(var i = 0; i < data.length; i++){
      for(var j = 0; j < data[i]['treningi'].length;j++){
        if(data[i]['treningi'][j] != null){
          if(data[i]['treningi'][j].datum != null){
            var s = data[i]['treningi'][j].datum;
            var s1 = data[i].ekipaID;
            if(s.indexOf(d) >= 0 && s1 == e){
              trening = true;
              var tr = document.getElementById('tabela').tHead.children[0],
              th = document.createElement('th');
              th.innerHTML = s.slice(-2);
              tr.appendChild(th);//dodajanje datumov
              datum = data[i]['treningi'][j].datum;
              }
            }
          }

              //dodajanje igralcev
              if(trening){
              var tableRef = document.getElementById('tabela').getElementsByTagName('tbody')[0];
              var newCell,newRow,newText;
              for(var k = 0; k < data[i]['treningi'][j]['prisotni'].length; k++){
                if(!$("#tabela td:contains("+data[i]['treningi'][j]['prisotni'][k]+")").length && data[i]['ekipaID'] == e){
                  vpis = true;
                  newRow   = tableRef.insertRow(tableRef.rows.length);
                  newText  = document.createTextNode(data[i]['treningi'][j]['prisotni'][k]);
                  newCell  = newRow.insertCell(0);
                  newCell.appendChild(newText);
                  t  = document.createTextNode(counter);
                  newCell  = newRow.insertCell(1);
                  newCell.appendChild(t);

                }
                if(s.indexOf(d) >= 0 && s1 == e && data[i]['ekipaID'] == e){
                  if(!inTable(tabelaPrisotnost,data[i]['treningi'][j]['prisotni'][k])){
                    training[data[i]['treningi'][j]['prisotni'][k]] = data[i]['treningi'][j]['prisotni'][k];
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"] = [];
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['stevilo'] = 1;
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['prisoten'] = 1;
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['manjkal'] = 0;
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['prisotnostDatum'] = "1";
                    tabelaPrisotnost.push(training);
                  }
                  else{
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['stevilo'] += 1;
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['prisoten'] += 1;
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['prisotnostDatum'] += "1";
                  }
                }
              }
              for(var k = 0; k < data[i]['treningi'][j]['manjkajoci'].length; k++){
                if(!$("#tabela td:contains("+data[i]['treningi'][j]['manjkajoci'][k]+")").length && data[i]['ekipaID'] == e){
                  vpis = true;
                  newRow   = tableRef.insertRow(tableRef.rows.length);
                  newText  = document.createTextNode(data[i]['treningi'][j]['manjkajoci'][k]);
                  newCell  = newRow.insertCell(0);
                  newCell.appendChild(newText);
                  t  = document.createTextNode(counter);
                  newCell  = newRow.insertCell(1);
                  newCell.appendChild(t);
                }
                if(s.indexOf(d) >= 0 && s1 == e && data[i]['ekipaID'] == e){
                    if(!inTable(tabelaPrisotnost,data[i]['treningi'][j]['manjkajoci'][k])){
                      training[data[i]['treningi'][j]['manjkajoci'][k]] = data[i]['treningi'][j]['manjkajoci'][k];
                      training[data[i]['treningi'][j]['manjkajoci'][k]+"data"] = [];
                      training[data[i]['treningi'][j]['manjkajoci'][k]+"data"]['stevilo'] = 1;
                      training[data[i]['treningi'][j]['manjkajoci'][k]+"data"]['prisoten'] = 0;
                      training[data[i]['treningi'][j]['manjkajoci'][k]+"data"]['manjkal'] = 1;
                      training[data[i]['treningi'][j]['manjkajoci'][k]+"data"]['prisotnostDatum'] = "0";
                      tabelaPrisotnost.push(training);
                  }else{
                    training[data[i]['treningi'][j]['manjkajoci'][k]+"data"]['stevilo'] += 1;
                    training[data[i]['treningi'][j]['manjkajoci'][k]+"data"]['manjkal'] += 1;
                    training[data[i]['treningi'][j]['manjkajoci'][k]+"data"]['prisotnostDatum'] += "0";
                  }
                }
              }
             }
             }
          }
          console.log(training);
          for(var i = 1; i < table.rows.length; i++){
            if(vpis == true){
              x = table.rows[i].insertCell(-1);
              x.innerHTML = training[Object.keys(training)[(i-1)*2+1]]['prisoten'];
              x = table.rows[i].insertCell(-1);
              x.innerHTML = training[Object.keys(training)[(i-1)*2+1]]['manjkal'];
              for(var j = 0; j < training[Object.keys(training)[(i-1)*2+1]]['prisotnostDatum'].length; j++){
                if(training[Object.keys(training)[(i-1)*2+1]]['prisotnostDatum'][j] == "1"){
                  x = table.rows[i].insertCell(-1);
                  x.innerHTML = "✔️";
                }else if(training[Object.keys(training)[(i-1)*2+1]]['prisotnostDatum'][j] == "0"){
                  x = table.rows[i].insertCell(-1);
                  x.innerHTML = "❌";
                }
              }
            }
            if(vpis == true){

            }
          }
          training = [];
  });

  }
  jQuery(document).ready(function($) {
    $('.elementiIgralec') .hide()
    $('#splosno').toggle();
  $('a[href^="#"]').on('click', function(event) {
  $('.elementiIgralec') .hide()
      var target = $(this).attr('href');
      $('.tt').removeClass('active');
      $(this).addClass('active');
      
  
      $('.elementiIgralec'+target).toggle();
  
  });
  });