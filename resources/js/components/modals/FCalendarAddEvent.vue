<template>
<modal :show="showModal">

    <template v-slot:header>
        <h2>Add New Schedule</h2>
    </template>

    <template v-slot:body>
        <label for="date">Date That Will Be Used</label>
        <input type="name" name="date" id="date" v-model="dateTaken" class="input-box" disabled />
        <label for="id_kelompok">Group That Will Be Using This Schedule</label>
        <select name="id_kelompok" id="id_kelompok" v-model="schedule.class_id" class="input-box">
            <option :value="null">
                Choose group name
            </option>
            <option v-for="option in options" :key="option.id" :value="option.id">
                {{ option.group_name }}
            </option>
        </select>
        <label for="room_name">Room That Will Be Used For The Schedule</label>
        <select name="room_name" id="room_name" v-model="schedule.room_id" class="input-box">
            <option :value="null">
                Choose room
            </option>
            <option v-for="option in optionssec" :key="option.id" :value="option.id">
                {{ option.room_name }}
            </option>
        </select>
        <label for="title">Title For The Schedule</label>
        <input type="name" name="title" id="title" v-model="schedule.title" class="input-box" />
        <label for="timepicker">Start Of The Schedule</label>
        <Datepicker v-model="timeStart" timePicker />
        <label for="timepicker">End Of The Schedule</label>
        <Datepicker v-model="timeEnd" timePicker />
    </template>

    <template v-slot:footer>
        <form @submit.prevent="addSchedule">
            <button type="submit" class="button-submit">Add</button>
        </form>
    </template>

</modal>
</template>
<script>
import Modal from './../layouts/Modal.vue';

import Datepicker from 'vue3-date-time-picker';
import {
    ref
} from 'vue';

export default {
    components: {
        'modal': Modal,
        Datepicker
    },
    props: ['showModal', 'dateTaken'],
    setup() {
        const timeStart = ref({
            hours: new Date().getHours(),
            minutes: new Date().getMinutes()
        });

        const timeEnd = ref({
            hours: new Date().getHours(),
            minutes: new Date().getMinutes()
        });

        return {
            timeStart,
            timeEnd
        }
    },
    data() {
        return {
            schedule: {
                class_id: null,
                room_id: null,
                title: '',
                start: '',
                end: ''
            }
        }
    },
    methods: {
        addSchedule() {
            this.schedule.start = this.dateTaken + ' ' + this.timeStart.hours + ':' + this.timeStart.minutes
            this.schedule.end = this.dateTaken + ' ' + this.timeEnd.hours + ':' + this.timeEnd.minutes
            axios.post('http://localhost:8000/api/schedule/create', this.schedule)
                .then(response => (
                    this.$emit('created'),
                    this.clearScheduleValue()
                ))
                .catch(error => {
                    this.tesError = error.response.data.errors
                    if (this.tesError != undefined)
                        this.$parent.$emit('failed', {
                            errorMessage: this.tesError,
                            status: 'failed'
                        })
                })
                .finally(() => this.loading = false);
        },
        clearScheduleValue() {
            this.schedule.title = ''
            this.schedule.start = ''
            this.schedule.end = ''
        }
    },
    mounted() {
        axios.get("http://localhost:8000/api/show/classrooms")
            .then(res => {
                this.options = res.data
            }).catch(err => {
                console.log(err)
            });

        axios.get("http://localhost:8000/api/show/rooms")
            .then(res => {
                this.optionssec = res.data
            }).catch(err => {
                console.log(err)
            });
    }
}
</script>
