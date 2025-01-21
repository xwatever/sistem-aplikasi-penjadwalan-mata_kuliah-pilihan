<template>
<div id="content" class="fade-in">
    <div class="panel fade" v-if="schedule_view == ''">
        <div class="title">
            Options
        </div>
        <div class="contents">
            <label for="schedule_view">Select option to view</label>
            <select name="schedule_view" id="schedule_view" v-model="schedule_view" class="input-box">
                <option>Look For Your Schedule</option>
                <option>Look For All Schedules Avalaible</option>
            </select>
        </div>
    </div>

    <div class="panel fade" v-if="schedule_view == 'Look For Your Schedule'">
        <div class="back_button" @click="schedule_view = ''">
            <i class="far fa-arrow-alt-circle-left"></i> &nbsp Kembali
        </div>
        <div class="title">
            Your Schedules
        </div>
        <div class="contents">
            <FullCalendar :options="calendarOptionsone" ref="fullCalendar" />
        </div>
    </div>

    <div class="panel fade" v-if="schedule_view == 'Look For All Schedules Avalaible'">
        <div class="back_button" @click="schedule_view = ''">
            <i class="far fa-arrow-alt-circle-left"></i> &nbsp Kembali
        </div>
        <div class="title">
            Every Schedules
        </div>
        <div class="contents">
            <FullCalendar :options="calendarOptionstwo" ref="fullCalendar" />
        </div>
    </div>
</div>

<modalShowEvent :showModal="showModal" :schedule="schedule" @event="showModal = $event" />

</template>

<script>
import '@fullcalendar/core/vdom';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';

import FCalendarShowEventDetails from './../../modals/FCalendarShowEventDetails.vue';

export default {
    components: {
        FullCalendar,
        'modalShowEvent': FCalendarShowEventDetails
    },
    props: ['user'],
    data: function() {
        return {
            schedule_view: '',
            schedule: [],
            showModal: false,

            calendarOptionsone: {
                headerToolbar: {
                    left: 'dayGridMonth timeGridWeek listWeek',
                    center: 'title',
                    right: 'prev next today',
                },
                plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                eventClick: this.handleEventClick,
                eventSources: [{
                    url: 'http://localhost:8000/api/show/schedules/mine/' + this.user[0].identity_number,
                    color: 'blue',
                    textColor: 'white',
                }]
            },

            calendarOptionstwo: {
                headerToolbar: {
                    left: 'dayGridMonth timeGridWeek listWeek',
                    center: 'title',
                    right: 'prev next today',
                },
                plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                eventClick: this.handleEventClick,
                eventSources: [{
                    url: 'http://localhost:8000/api/show/schedules/present',
                    color: 'yellow',
                    textColor: 'black',
                }]
            }
        }
    },
    methods: {
        handleEventClick: function(info) {
            axios.get("http://localhost:8000/api/schedule/" + info.event.id)
                .then(res => {
                    this.schedule = res.data
                }).catch(err => {
                    console.log(err)
                });
            setTimeout(() => {
                this.showModal = !this.showModal
            }, 350);
        },
    }
}
</script>
