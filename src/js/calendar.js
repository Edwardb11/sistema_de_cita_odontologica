document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: '2021-06-07',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
            {
                title: 'Ejemplo',
                start: '2021-06-01'
            },
            {
                title: 'Endodoncia',
                start: '2021-06-07',
                end: '2021-06-10'
            },
            {
                title: 'Ortodoncia',
                start: '2021-06-16T16:00:00'
            },
            {
                title: 'Edward',
                start: '2021-06-11',
                end: '2021-06-13'
            },
            {
                title: 'Limpieza Bucal',
                start: '2021-06-12T10:30:00',
                end: '2021-06-12T12:30:00'
            },
            {
                title: 'Revisión general',
                start: '2021-06-12T12:00:00'
            },
            {
                title: 'Empaste',
                start: '2021-06-12T14:30:00'
            },

            {
                title: 'Ejemplo de link',
                url: 'http://google.com/',
                start: '2021-06-28'
            }
        ]
    });

    calendar.render();
});