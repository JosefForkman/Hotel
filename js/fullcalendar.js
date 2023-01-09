const urlSearchParams = new URLSearchParams(window.location.search);
const { rum } = Object.fromEntries(urlSearchParams.entries());

const startDate = document.querySelector('#startDate');
const endDate = document.querySelector('#endDate');

/* Skapar en datum om användaren inte väljer något i kalendern */
const date = new Date()

startDate.textContent = date.getDate();
endDate.textContent = date.getDate();

/* fullCalendar option */
/* För att se mer om fullCalendar https://fullcalendar.io/ */
const fullCalendarOpt = {
    initialView: 'dayGridMonth',
    selectable: true,
    selectOverlap: false,
    select: ({ end, start }) => {



        localStorage.setItem("BookDate",JSON.stringify({
            start,
            end,
            rum: parseInt(rum)
        }));

        startDate.textContent = start.getDate();
        endDate.textContent = end.getDate() - 1;

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
    events: `API/calender?id=${rum}`,
    eventColor: 'var(--Amaranth-Purplen)'
    }

/* Lägger till fullCalendar på rum.php */
document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, fullCalendarOpt);
    calendar.render();
});
