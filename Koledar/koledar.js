document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
    locale: 'sl',
    defaultView: 'dayGridMonth',
    displayEventTime:true,
    columnHeaderFormat:{ weekday: 'long' },
    eventTimeFormat:{
      hour: 'numeric',
      minute: '2-digit',
      meridiem: false
    },
    allDaySlot: false,
    dayNames: ['Nedelja','Ponedeljek','Torek','Sreda','Cetrtek','Petek','Sobota'],
    monthNames: ['Januar', 'Februar', 'Marec', 'April', 'Maj', 'Junij', 'Julij',
  'Avgust', 'September', 'Oktober', 'November', 'December'],
    buttonText:{
      today: 'danes',
      month: 'mesec',
      week: 'teden',
      day: 'dan',
      list: 'seznam'
    },
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: {
      url:'PrikazTrening.php'
    }

  });

  calendar.render();
});
