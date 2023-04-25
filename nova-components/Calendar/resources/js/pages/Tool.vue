<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import axios from 'axios'
import moment from 'moment'

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  mounted() {
    this.getTasks();
  },
  data() {
    return {
      calendarOptions: {
        plugins: [ dayGridPlugin, interactionPlugin ],
        initialView: 'dayGridMonth',
        locale: 'fr',
        firstDay: 1,
        height: 'auto',
        // editable: false,
        // selectable: true,
        // selectMirror: false,
        // dayMaxEvents: false,
        // weekends: false,
        // droppable: false,
        // select: this.handleDateSelect,
        // eventClick: this.handleEventClick,
        // eventsSet: this.handleEvents,
        // dateClick: this.handleDateClick,
        events: [],
        headerToolbar: {
          left: 'prev,next today toggleCalendarView toggleWeekends',
          center: 'title',
          right: 'toggleNewEvent'
        },
        customButtons: {
          toggleCalendarView: {
            text: 'Mois / Semaine',
            click: this.toggleCalendarView,
          },
          toggleWeekends: {
            text: 'Weekend',
            click: this.toggleWeekends,
          },
          toggleNewEvent: {
            text: 'Ajouter un évènement',
            click: this.toggleNewEvent,
          },
        },
      },
    }
  },
  methods: {
    toggleNewEvent: function() {
      window.location.href = '/nova/resources/tasks/new';
    },
    toggleCalendarView() {
      const calendarApi = this.$refs.calendar.getApi();
      const currentView = calendarApi.view.type;

      if (currentView === 'dayGridMonth') {
        calendarApi.changeView('dayGridWeek');
      } else if (currentView === 'dayGridWeek') {
        calendarApi.changeView('dayGridMonth');
      }
    },
    toggleWeekends: function() {
      this.calendarOptions.weekends = !this.calendarOptions.weekends // toggle the boolean!
    },
    async getTasks() {
      try {
        const response = await axios.get('/nova-api/tasks');
        const tasks = await Promise.all(response.data.resources.map(async (resource) => {
          const userField = resource.fields.find(field => field.attribute === 'user');
          const userColor = await getUserColor(userField.value);

          const startDateField = resource.fields.find(field => field.attribute === 'start_date');
          const durationField = resource.fields.find(field => field.attribute === 'duration');

          const start = startDateField.value;
          const duration = durationField.value;
          const end = moment(start).add(duration, 'hours').toDate();
          return {
            id: resource.fields.find(field => field.attribute === 'id').value,
            title: resource.fields.find(field => field.attribute === 'client').value + ' (' + userField.value + ')',
            // date: resource.fields.find(field => field.attribute === 'start_date').value,
            start: start,
            end: end,
            department: 'department',
            description: 'description',
            display: 'block',
            color: userColor, // Yeni renk özelliğini ekleyin
            textColor: 'white',
            borderColor: '#b6ad90',
            url: `/nova/resources/tasks/${resource.fields.find(field => field.attribute === 'id').value}/edit`,

          };
        }));

        // Şimdi, elde ettiğimiz 'tasks' dizisini 'calendarOptions.events' ile değiştirin
        this.calendarOptions.events = tasks;
      } catch (error) {
        console.error('Error fetching tasks:', error);
      }

      async function getUserColor(username) {
        try {
          const response = await axios.get(`/nova-api/users?search=${username}`);
          const userResource = response.data.resources.find(resource => {
            const nameField = resource.fields.find(field => field.attribute === 'name');
            return nameField.value === username;
          });

          if (userResource) {
            const colorField = userResource.fields.find(field => field.attribute === 'color');
            return colorField.value || '#ffffff'; // Varsayılan renk belirtin, örneğin: '#ffffff'
          } else {
            return '#ffffff'; // Kullanıcı bulunamazsa varsayılan renk kullanın
          }
        } catch (error) {
          console.error('Error fetching user color:', error);
          return '#ffffff'; // Hata durumunda varsayılan renk kullanın
        }
      }
    },    
    // handleDateClick: function(arg) {
    //   window.location.href = '/nova/resources/tasks/new';
    // },
    // handleWeekendsToggle() {
    //   this.calendarOptions.weekends = !this.calendarOptions.weekends // update a property
    // },
    // handleDateSelect(selectInfo) {
    //   window.location.href = '/nova/resources/tasks/new';
    // },
    // handleEventClick(clickInfo) {
    //   const taskId = clickInfo.event.id;
    //   window.location.href = `/nova/resources/tasks/${taskId}/edit`;
    // },
    // handleEvents(events) {
    //   this.currentEvents = events
    // },
  }
}
</script>
<template>
  <FullCalendar ref="calendar" :options="calendarOptions" />
</template>
