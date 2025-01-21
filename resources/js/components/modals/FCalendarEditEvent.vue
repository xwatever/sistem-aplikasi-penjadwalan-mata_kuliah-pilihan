<template>
<modal :show="showModal">

    <template v-slot:header>
        <h2>Change Current Schedule</h2>
    </template>

    <template v-slot:body>
        <!-- <Datepicker v-model="date" /> -->
        <div v-if="schedule[0].hasOwnProperty('start')">
            <div v-show="!deleting">
                <label for="title">Title For The Schedule</label>
                <input type="name" name="title" id="title" v-model="schedule[0].title" class="input-box" />
                <label for="group_name">Group That Will Be Using This Schedule</label>
                <select name="group_name" id="group_name" v-model="schedule[0].class_id" class="input-box">
                    <option :value="null">
                        Choose group name
                    </option>
                    <option v-for="option in options" :key="option.id" :value="option.id">
                        {{ option.group_name }}
                    </option>
                </select>

                <label for="room_name">Room That Will Be Used For The Schedule</label>
                <select name="room_name" id="room_name" v-model="schedule[0].room_id" class="input-box">
                    <option :value="null">
                        Choose room
                    </option>
                    <option v-for="option in optionssec" :key="option.id" :value="option.id">
                        {{ option.room_name }}
                    </option>
                </select>

                <label for="timepicker">Start Of The Schedule</label>
                <Datepicker v-model="schedule[0].start" :monthChangeOnScroll="false" format="MM/dd/yyyy HH:mm" />
                <label for="timepicker">End Of The Schedule</label>
                <Datepicker v-model="schedule[0].end" :monthChangeOnScroll="false" format="MM/dd/yyyy HH:mm" />
            </div>

            <div v-show="deleting" style="color: #5b5d5c; font-weight: bolder; font-size: 18px">
                <h3>Are you sure want to delete this data?</h3>
                <br />
                <div v-show="schedule[0].hasOwnProperty('group_name') && schedule[0].group_name != null">
                    <label for="group_name">Group That Will Attend This Schedule: </label>
                    <span id="group_name">{{schedule[0].group_name}}</span>
                    <br />
                </div>
                <label for="start">Start Of The Schedule: </label>
                <span id="start">{{schedule[0].start}}</span>
                <br />
                <label for="end">End Of The Schedule</label>
                <span id="end">{{schedule[0].end}}</span>
            </div>
        </div>
    </template>

    <template v-slot:footer>
        <div v-show="!deleting">
            <form @submit.prevent="editSchedule">
                <button type="submit" class="button-submit">Change</button>
            </form>
            <button type="submit" class="button-error2" @click="deleting = true">Delete</button>
        </div>
        <div v-show="deleting">
            <form @submit.prevent="deleteSchedule">
                <button type="submit" class="button-error">Delete</button>
            </form>
            <button type="submit" class="button-submit" @click="deleting = false">Back</button>
        </div>
    </template>

</modal>
</template>
<script>
import Modal from './../layouts/Modal.vue';

import Datepicker from 'vue3-date-time-picker';

export default {
    components: {
        'modal': Modal,
        Datepicker
    },
    props: ['showModal', 'schedule'],
    data() {
        return {
            scheduled: {
                id: '',
                class_id: null,
                room_id: null,
                title: '',
                start: '',
                end: ''
            },
            dateStart: '',
            options: [],
            optionssec: [],
            deleting: false
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
    },
    methods: {
        editSchedule() {
            if (this.schedule[0].hasOwnProperty('start')) {
                this.scheduled.id = this.schedule[0].id
                this.scheduled.class_id = this.schedule[0].class_id
                this.scheduled.room_id = this.schedule[0].room_id
                this.scheduled.title = this.schedule[0].title
                this.scheduled.start = this.schedule[0].start.toLocaleString('sv-SE')
                this.scheduled.end = this.schedule[0].end.toLocaleString('sv-SE')
                axios.post('http://localhost:8000/api/schedule/edit', this.scheduled)
                    .then(response => (
                        this.$emit('edited')
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
            }
        },
        deleteSchedule() {
            this.scheduled.id = this.schedule[0].id
            axios.post('http://localhost:8000/api/schedule/delete', this.scheduled)
                .then(response => (
                    this.$emit('deleted')
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
        }
    }
}
</script>
