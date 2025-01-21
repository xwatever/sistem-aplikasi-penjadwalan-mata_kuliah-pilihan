<template>
<modal :show="showModal">

    <template v-slot:header>
        <h2>Schedule Picked</h2>
    </template>

    <template v-slot:body>
        <div v-if="schedule[0].hasOwnProperty('room_name')">
            <p style="color: #5b5d5c; font-size: 1.175em; font-weight: bolder;">
                Schedule Date : {{ schedule[0].start.split(" ")[0] }} <br />
                Start Of The Schedule : {{ schedule[0].start.split(" ")[1] }} <br />
                End Of The Schedule : {{ schedule[0].end.split(" ")[1] }} <br />
                Room Used : {{ schedule[0].room_name }} <br /> <br />
                Group : {{ schedule[0].group_name }} <br />
                Group Member : <br /><br />
            </p>
            <datatable :groupMembers="classroomAttendances" />
        </div>
    </template>

    <template v-slot:footer>

    </template>

</modal>
</template>
<script>
import Modal from './../layouts/Modal.vue';
import DataTablejs from './../datatables/GroupMembersForStudent.vue';

export default {
    components: {
        'modal': Modal,
        'datatable': DataTablejs
    },
    props: ['showModal', 'schedule'],
    data() {
        return {
            classroomAttendances: []
        }
    },
    watch: {
        showModal(val, oldVal) {
            if (this.showModal == true) {
                axios.get("http://localhost:8000/api/classroom/" + this.schedule[0].class_id + "/attendances")
                    .then(res => {
                        this.classroomAttendances = res.data
                    }).catch(err => {
                        console.log(err)
                    });
            }
        }
    },
}
</script>
