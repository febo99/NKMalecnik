//isci so razlicni, glede na vrstico v kateri iscemo. možnost zapisa v eni funkciji s parametri
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
function focusT(me){
  let active = document.getElementById('focus');
  if(active != null){
    active.removeAttribute('id');
    me.setAttribute('id','focus');
  }else{
    me.setAttribute('id','focus');
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
$(document).ready(function() {
  $('.js-example-basic-multiple').select2();
});
function getJson(){
  //izbrišemo vse dosedanje zapise
  $("#tabela th").not(".def").remove();
  $("#tabela td").not(".def").remove();
  $("#tabela tr").not(".stat").remove();
  //dobimo JSON iz Prisotnost.php
  $.getJSON("./Prisotnost.php", function(data) {
    $("#tabela th").not(".def").remove();
    $("#tabela td").not(".def").remove();
    var table = document.getElementById('tabela');
    var training = [];
    var tabelaPrisotnost = [];
    var d = document.getElementsByName('datum')[0].value;
    var e = document.getElementsByName('ekipa')[0].value;//input na strani
    var counter=0;
    var vpis = false;
    var trening = false;
    var x;
    for(var i = 0; i < data.length; i++){//loop skozi vse json podatke
      for(var j = 0; j < data[i]['treningi'].length;j++){
        if(data[i]['treningi'][j] != null){//ce trening obstaja
          if(data[i]['treningi'][j].datum != null && data[i]['ekipaID'] == e){//pogledamo da je prava ekipa
            var s = data[i]['treningi'][j].datum;
            var s1 = data[i].ekipaID;
            if(s.indexOf(d) >= 0 && s1 == e){
              counter++; //ce se ujemata mesec in ekipa povečamo števec, ki nam pove celotno število treningov
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
              th.innerHTML = s.slice(-2);//odstranimo zadnja dva elementra v arrayu 
              tr.appendChild(th);//dodajanje datumov
              datum = data[i]['treningi'][j].datum;
              }
            }
          }

              //dodajanje igralcev
              if(trening){
              var tableRef = document.getElementById('tabela').getElementsByTagName('tbody')[0];//dobimo tabelo v katero zapisujemo stvari
              var newCell,newRow,newText;
              for(var k = 0; k < data[i]['treningi'][j]['prisotni'].length; k++){
                if(!$("#tabela td:contains("+data[i]['treningi'][j]['prisotni'][k]+")").length && data[i]['ekipaID'] == e){
                  vpis = true;
                  newRow   = tableRef.insertRow(tableRef.rows.length);
                  newText  = document.createTextNode(data[i]['treningi'][j]['prisotni'][k]);//ustvarjanje novih vrstic s tekstom
                  newCell  = newRow.insertCell(0);
                  newCell.appendChild(newText);
                  t  = document.createTextNode(counter);
                  newCell  = newRow.insertCell(1);
                  newCell.appendChild(t);
                  //v vsako vrstico dodamo novo celico v katero dodamo nov Textnode, ki vsebuje informacije o prisotnost
                }
                if(s.indexOf(d) >= 0 && s1 == e && data[i]['ekipaID'] == e){
                  if(!inTable(tabelaPrisotnost,data[i]['treningi'][j]['prisotni'][k])){ //če je igralec bil prisoten na treningu in še ni zapisan v tabeli, init spremenljivk
                    training[data[i]['treningi'][j]['prisotni'][k]] = data[i]['treningi'][j]['prisotni'][k];
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"] = [];
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['stevilo'] = 1;
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['prisoten'] = 1;
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['manjkal'] = 0;
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['prisotnostDatum'] = "1";
                    tabelaPrisotnost.push(training);
                  }
                  else{
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['stevilo'] += 1; //igralec je že v tabeli, vrednost samo povečamo
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['prisoten'] += 1;
                    training[data[i]['treningi'][j]['prisotni'][k]+"data"]['prisotnostDatum'] += "1";
                  }
                }
              }
              for(var k = 0; k < data[i]['treningi'][j]['manjkajoci'].length; k++){//za igralce, ki jih ni bilo
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
          for(var i = 1; i < table.rows.length; i++){
            if(vpis == true){
              x = table.rows[i].insertCell(-1);
              x.innerHTML = training[Object.keys(training)[(i-1)*2+1]]['prisoten']; //stevilo obiskov na treningu(kolikokrat je igralec bil oz. ni bil na treningu)
              //i-1*2+1 pomeni, da pogledamo vsaki 3ji element(for zanka začne z 0)
              x.classList.add("zelen");
              x = table.rows[i].insertCell(-1);
              x.innerHTML = training[Object.keys(training)[(i-1)*2+1]]['manjkal'];
              x.classList.add("rdec");
              for(var j = 0; j < training[Object.keys(training)[(i-1)*2+1]]['prisotnostDatum'].length; j++){
                // glede na prisotnost določimo value vsake celice na primeren text
                if(training[Object.keys(training)[(i-1)*2+1]]['prisotnostDatum'][j] == "1"){
                  x = table.rows[i].insertCell(-1);
                  x.innerHTML = "✔️";
                }else if(training[Object.keys(training)[(i-1)*2+1]]['prisotnostDatum'][j] == "0"){
                  x = table.rows[i].insertCell(-1);
                  x.innerHTML = "❌";
                }else if(training[Object.keys(training)[(i-1)*2+1]]['prisotnostDatum'][j] == "2"){
                  x = table.rows[i].insertCell(-1);
                  x.innerHTML = "⭕";
                }
              }
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
  function vnosLokacije(el){
    if(el.id == "inlineRadio1"){
      document.getElementById('gLokacija').style.display = "none";
      document.getElementById('gLokacija').value = ""; 
      document.getElementById('dLokacija').style.display = "initial";
    }
    if(el.id == "inlineRadio2"){
      document.getElementById('dLokacija').style.display = "none";
      document.getElementById('dLokacija').value = "";
      document.getElementById('gLokacija').style.display = "initial";
    }
  }
  function displayLokacija(){//nastavitev vnosa lokacije glede na vrednost inlineRadio2 pri vnosu nove tekme
    if(document.getElementById('inlineRadio2').checked){
      document.getElementById('dLokacija').style.display = "none";
      document.getElementById('dLokacija').value = "";
      document.getElementById('gLokacija').style.display = "initial";
    }else{
      document.getElementById('gLokacija').style.display = "none";
      document.getElementById('gLokacija').value = ""; 
      document.getElementById('dLokacija').style.display = "initial";
    }
  }
  function poMesecih(id){
    var datum = document.getElementById("datumAkcija").value;
    var ure = 0;
    const dd = new Date(datum);
    const mesec = dd.toLocaleString('sl',{month: 'long'});
    document.getElementById("mesec").innerHTML = mesec + "u";
    $.getJSON("./prisotnostJSON.php", function(data) {
      for(var i = 0; i < data.length; i++){
        if(data[i]['id'] == id && data[i]['datum'].includes(datum)){
          ure += parseInt(data[i]['ure'],10);
        }
      }
      document.getElementById("steviloUr").innerHTML = ure;
    });
    
  }
function spremembaPredloge(){
  var izbira = document.getElementById("izbiraPredloge");
  var izbranaPredloga = izbira.options[izbira.selectedIndex];
  var uvod = izbranaPredloga.getAttribute('data-uvod');
  var glavni = izbranaPredloga.getAttribute('data-glavni');
  var zakljucek = izbranaPredloga.getAttribute('data-zakljucek');
  document.getElementById("uvod").value = uvod;
  document.getElementById("glavni").value = glavni;
  document.getElementById("zakljucek").value = zakljucek;
  console.log(vrednost);
}
