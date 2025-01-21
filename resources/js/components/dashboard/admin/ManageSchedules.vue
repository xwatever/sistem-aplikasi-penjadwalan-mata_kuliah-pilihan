<template>
<div id="content" class="fade-in">
    <div class="panel">
        <div class="title">
            Manage Schedules
        </div>
        <div class="contents">
            <FullCalendar :options="calendarOptions" ref="fullCalendar" />
        </div>
    </div>

    <modalAddEvent :showModal="showModalDate" :dateTaken="dateTaken" @event="showModalDate = $event" @created="addedSchedule" />
    <modalEditEvent :showModal="showModalEvent" :schedule="schedule" @event="showModalEvent = $event" @edited="editedSchedule" @deleted="deletedSchedule" />

</div>
</template>

<script>
import '@fullcalendar/core/vdom';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';

import FCalendarAddEvent from './../../modals/FCalendarAddEvent.vue';
import FCalendarEditEvent from './../../modals/FCalendarEditEvent.vue';

export default {
    components: {
        FullCalendar,
        'modalAddEvent': FCalendarAddEvent,
        'modalEditEvent': FCalendarEditEvent,
    },
    data() {
        return {
            calendarOptions: {
                headerToolbar: {
                    left: 'dayGridMonth timeGridWeek listWeek',
                    center: 'title',
                    right: 'prev next today',
                },
                plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                dateClick: this.handleDateClick,
                eventClick: this.handleEventClick,
                eventSources: [{
                    url: 'http://localhost:8000/api/show/schedules',
                    color: 'yellow',
                    textColor: 'black',
                }]
            },
            showModalDate: false,
            dateTaken: '',

            showModalEvent: false,
            schedule: []
        }
    },
    methods: {
        handleDateClick: function(arg) {
            this.dateTaken = '' + arg.dateStr
            this.showModalDate = !this.showModalDate
        },
        handleEventClick: function(info) {
            axios.get("http://localhost:8000/api/schedule/" + info.event.id)
                .then(res => {
                    this.schedule = res.data
                }).catch(err => {
                    console.log(err)
                });
            setTimeout(() => {
                this.showModalEvent = !this.showModalEvent
            }, 350);
        },
        addedSchedule() {
            this.showModalDate = !this.showModalDate
            this.$refs.fullCalendar.getApi().refetchEvents()
            this.$emit('created', {
                type: 'create',
                table: 'schedule',
                status: 'success'
            })
        },
        editedSchedule() {
            this.showModalEvent = !this.showModalEvent
            this.$refs.fullCalendar.getApi().refetchEvents()
            this.$emit('edited', {
                type: 'edit',
                table: 'schedule',
                status: 'success'
            })
        },
        deletedSchedule() {
            this.showModalEvent = !this.showModalEvent
            this.$refs.fullCalendar.getApi().refetchEvents()
            this.$emit('deleted', {
                type: 'delete',
                table: 'schedule',
                status: 'success'
            })
        }
    }
}
</script>
