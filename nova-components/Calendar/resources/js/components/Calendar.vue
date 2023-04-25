<template>
    <div>
      <FullCalendar
        :plugins="calendarPlugins"
        :events="events"
        :header-toolbar="headerToolbar"
      />
    </div>
  </template>
  
  <script>
  import { ref } from "vue";
  import FullCalendar from "@fullcalendar/vue";
  import dayGridPlugin from "@fullcalendar/daygrid";
  import timeGridPlugin from "@fullcalendar/timegrid";
  import interactionPlugin from "@fullcalendar/interaction";
  
  export default {
    components: {
      FullCalendar,
    },
    setup() {
      const calendarPlugins = [dayGridPlugin, timeGridPlugin, interactionPlugin];
      const headerToolbar = {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay",
      };
      const events = ref([]);
  
      fetch("/api/tasks")
        .then((response) => response.json())
        .then((data) => {
          events.value = data;
        });
  
      return {
        calendarPlugins,
        headerToolbar,
        events,
      };
    },
  };
  </script>  