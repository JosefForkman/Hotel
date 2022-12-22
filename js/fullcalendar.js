const fullCalendarOpt = {
    initialView: 'dayGridMonth',
    selectable: true,
    selectOverlap: false,
    select: ({endStr, startStr, end, start}) => {
        console.log({endStr, startStr, end, start});
    },
    locale: 'sv',
    firstDay: 1, // Måndag
    weekNumbers: true,
    weekText: 'v',
    validRange: {
        start: '2023-01-01',
        end: '2023-02-01'
    },
    aspectRatio: 1.2,
    buttonText: {
        today:    'Idag',
        month:    'Månad',
        week:     'vecka',
        day:      'dag',
        list:     'list'
    },
    headerToolbar: {
        left: 'title',
        center: '',
        right: ''
    },
    events: [
        {
        title:  'Bokad',
        start:  '2023-01-20T16:11:36.748Z',
        end: '2023-01-22T16:11:36.748Z',
        allDay: true
        },
        {
        title:  'Bokad',
        start:  '2023-01-01',
        end: '2023-01-06',
        allDay: true
        },
        {
        title:  'Bokad',
        start:  '2023-01-08',
        end: '2023-01-08',
        allDay: true
        },
        // other events here...
    ],
    eventColor: 'var(--Amaranth-Purplen)'
    }

document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, fullCalendarOpt);
    calendar.render();
});
