$(function() {
    /* initialize the calendar
      -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    //var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------
    /*
    new Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function(eventEl) {
            return {
                title: eventEl.innerText,
                backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
            };
        }
    });
    */

    var calendar = new Calendar(calendarEl, {
        titleFormat: { // will produce something like "Tuesday, September 18, 2018"
            month: 'long',
            year: 'numeric',
            day: 'numeric',
            weekday: 'long',
            hour12: false
        },
        buttonText: {
            today:    'bugün',
            month:    'ay',
            week:     'hafta',
            day:      'gün',
            list:     'liste'
        },
        locale: 'tr',
        headerToolbar: {
            left  : 'prev,next today',
            center: 'title',
            right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        //Random default events
        events: events,
        editable  : false,
        droppable : false, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
            // is the "remove after drop" checkbox checked?
            if (checkbox.checked) {
                // if so, remove the element from the "Draggable Events" list
                info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        }
    });

    calendar.render();
})
