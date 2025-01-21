<template>
<modal :show="showModal">

    <template v-slot:header>
        <h2>Group Members</h2>
    </template>

    <template v-slot:body>
        <div v-show="!showDeleteAttendance" class="back_button" @click="toggleAddAttendance">
            <i class="fas fa-plus"></i> &nbsp Add New Member
        </div>

        <div v-show="showAddAttendance && !showDeleteAttendance">
            <label for="mahasiswa">The Name Or Identity Number Of The Student That Will Be Added</label>

            <input type="text" list="mahasiswa" class="input-box" placeholder="Please choose the student" ref="mahasiswa" @keyup.enter="onChange" />
            <datalist id="mahasiswa">
                <option v-for="student in students" :key="student.identity_number" :value="student.identity_number">{{ student.fullname }} - {{ student.identity_number }}</option>
            </datalist>

            <input type="hidden" name="identity_number" id="identity_number" class="input-box" v-model="anotherAttendance.identity_number" disabled />
            <input type="hidden" name="class_id" id="class_id" class="input-box" v-model="anotherAttendance.class_id" disabled />
        </div>

        <div v-show="!showAddAttendance && !showDeleteAttendance">
            <datatable :groupMembers="classroomAttendances" @eventDelete="deleteAttendance" />
        </div>

        <div v-if="showDeleteAttendance" style="color: #5b5d5c; font-weight: bolder; font-size: 18px">
            <h3>Are you sure to delete this member from group {{group[0].group_name}}?</h3>
            <br />
            <label for="identity_number">Identity Number: </label>
            <span id="identity_number">{{student[0].identity_number}}</span>
            <br />
            <label for="fullname">Full Name: </label>
            <span id="fullname">{{student[0].fullname}}</span>

        </div>

    </template>

    <template v-slot:footer>
        <div v-show="showAddAttendance && !showDeleteAttendance">
            <form @submit.prevent="addAttendance">
                <button type="submit" class="button-submit">Add</button>
            </form>
        </div>
        <div v-if="showDeleteAttendance">
            <button type="submit" class="button-error" @click="deleteAttendanceConfirmation">Delete</button>
            <button type="submit" class="button-submit" @click="showDeleteAttendance = false">Back</button>
        </div>
    </template>

</modal>
</template>
<script>
import Modal from './../layouts/Modal.vue';
import DataTablejs from './../datatables/GroupMembers.vue';

export default {
    components: {
        'modal': Modal,
        'datatable': DataTablejs
    },
    props: ['showModal', 'idgroup', 'group'],
    data() {
        return {
            classroomAttendances: [],
            showAddAttendance: false,
            showDeleteAttendance: false,
            students: [],

            anotherAttendance: {
                class_id: '',
                identity_number: ''
            },

            anotherAttendanceFD: {
                class_id: '',
                identity_number: ''
            },

            student: []
        }
    },
    watch: {
        showModal(val, oldVal) {
            if (this.showModal == true) {
                axios.get("http://localhost:8000/api/classroom/" + this.idgroup + "/attendances")
                    .then(res => {
                        this.classroomAttendances = res.data
                    }).catch(err => {
                        console.log(err)
                    });
            }
        }
    },
    mounted() {
        axios.get("http://localhost:8000/api/show/students")
            .then(res => {
                this.students = res.data
            }).catch(err => {
                console.log(err)
            });
    },
    methods: {
        toggleAddAttendance() {
            this.showAddAttendance = !this.showAddAttendance
        },
        onChange($event) {
            this.anotherAttendance.identity_number = $event.currentTarget.value
            this.anotherAttendance.class_id = this.idgroup

            const index = this.students.findIndex(s => s.identity_number == $event.currentTarget.value)
            setTimeout(() => {
                this.$refs.mahasiswa.value = this.students[index].fullname + ' - ' + $event.currentTarget.value
            }, 350);
        },
        addAttendance() {
            axios.post('http://localhost:8000/api/classroom-attendance/create', this.anotherAttendance)
                .then(response => (
                    this.$parent.$emit('created', {
                        type: 'create',
                        table: 'group member',
                        status: 'success'
                    }),
                    axios.get("http://localhost:8000/api/classroom/" + this.idgroup + "/attendances")
                    .then(res => {
                        this.classroomAttendances = res.data
                    }).catch(err => {
                        console.log(err)
                    }),
                    setTimeout(() => {
                        this.showAddAttendance = false
                    }, 350)
                ))
                .catch(error => {
                    this.tesError = error.response.data.errors
                    if (this.tesError != undefined)
                        this.$parent.$emit('failed', {
                            errorMessage: this.tesError,
                            status: 'failed'
                        })
                })
        },
        deleteAttendance(row) {
            axios.get("http://localhost:8000/api/user/" + row.idAttendance)
                .then(res => {
                    this.student = res.data
                }).catch(err => {
                    console.log(err)
                });
            setTimeout(() => {
                this.showDeleteAttendance = !this.showDeleteAttendance
            }, 350);
        },
        deleteAttendanceConfirmation() {
            this.anotherAttendanceFD.class_id = this.idgroup
            this.anotherAttendanceFD.identity_number = this.student[0].identity_number
            axios.post('http://localhost:8000/api/classroom-attendance/delete', this.anotherAttendanceFD)
                .then(response => (
                    this.$parent.$emit('deleted', {
                        type: 'delete',
                        table: 'group member',
                        status: 'success'
                    }),
                    this.$emit('reload')
                ))
                .catch(error => {
                    this.tesError = error.response.data.errors
                    if (this.tesError != undefined)
                        this.$parent.$emit('failed', {
                            errorMessage: this.tesError,
                            status: 'failed'
                        })
                })
            axios.get("http://localhost:8000/api/classroom/" + this.idgroup + "/attendances")
                .then(res => {
                    this.classroomAttendances = res.data
                }).catch(err => {
                    console.log(err)
                });
            setTimeout(() => {
                this.showDeleteAttendance = false
            }, 350);
        }
    }
}
</script>
