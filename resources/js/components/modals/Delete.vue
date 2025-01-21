<template>
<modal :show="showModal">

    <template v-slot:header>
        <h2>Delete Data</h2>
    </template>

    <template v-slot:body>

        <div style="color: #5b5d5c; font-weight: bolder; font-size: 18px">
            <h3>Are you sure you want to delete this data?</h3>
            <br />
            <div v-if="data[0].hasOwnProperty('role')">
                <label for="identity_number">Identity Number: </label>
                <span id="identity_number">{{data[0].identity_number}}</span>
                <br />
                <label for="fullname">Full Name: </label>
                <span id="fullname">{{data[0].fullname}}</span>

                <br /><br />
                <h3>Deleting this user will delete all of his/her/them class informations, schedules that will attended by the user, etc all information that related to the user!</h3>
            </div>

            <div v-if="data[0].hasOwnProperty('acs')">
                <label for="subject_name">Subject Name: </label>
                <span id="subject_name">{{data[0].subject_name}}</span>
                <br />
                <label for="acs">ACS: </label>
                <span id="acs">{{data[0].acs}}</span>

                <br /><br />
                <h3>Deleting this subject will delete all of the information of subject's class, schedules for the subject, etc all information that related to the subject!</h3>
            </div>

            <div v-if="data[0].hasOwnProperty('group_name')">
                <label for="group_name">Group Name: </label>
                <span id="group_name">{{data[0].group_name}}</span>
                <br />
                <label for="subject_name">Subject Name For The Group: </label>
                <span id="subject_name">{{data[0].subject_name}}</span>
                <br /><br />
                <h3>Deleting this group will delete all the information of group members, schedule for the group, etc all information that related to the group!</h3>
            </div>

            <div v-if="data[0].hasOwnProperty('room_name')">
                <label for="room_name">Room Name: </label>
                <span id="room_name">{{data[0].room_name}}</span>
                <br /><br />
                <h3>Deleting this room will delete all the information of schedules for the room, etc all information that related to the room!</h3>
            </div>
        </div>


    </template>

    <template v-slot:footer>
        <button type="submit" class="button-error" @click="deleteData">Delete</button>
        <button type="submit" class="button-submit" @click="$emit('event', false)">Back</button>
    </template>

</modal>
</template>
<script>
import Modal from './../layouts/Modal.vue';

export default {
    components: {
        'modal': Modal
    },
    props: ['showModal', 'data'],
    methods: {
        deleteData() {
            if (this.data[0].hasOwnProperty('role')) {
                const data = {
                    identity_number: this.data[0].identity_number
                }
                axios.post('http://localhost:8000/api/user/delete', data)
                    .then(response => (
                        this.$parent.$emit('deleted', {
                            type: 'delete',
                            table: 'user',
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
            } else if (this.data[0].hasOwnProperty('acs')) {
                const data = {
                    id: this.data[0].id
                }
                axios.post('http://localhost:8000/api/subject/delete', data)
                    .then(response => (
                        this.$parent.$emit('deleted', {
                            type: 'delete',
                            table: 'subject',
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
            } else if (this.data[0].hasOwnProperty('group_name')) {
                const data = {
                    id: this.data[0].id
                }
                axios.post('http://localhost:8000/api/classroom/delete', data)
                    .then(response => (
                        this.$parent.$emit('deleted', {
                            type: 'delete',
                            table: 'group',
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
            } else if (this.data[0].hasOwnProperty('room_name')) {
                const data = {
                    id: this.data[0].id
                }
                axios.post('http://localhost:8000/api/room/delete', data)
                    .then(response => (
                        this.$parent.$emit('deleted', {
                            type: 'delete',
                            table: 'room',
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
            }

            this.$emit('event', false)
        }
    }
}
</script>
