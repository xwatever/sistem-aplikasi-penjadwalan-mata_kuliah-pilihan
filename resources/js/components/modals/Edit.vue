<template>
<modal :show="showModal">

    <template v-slot:header>
        <h2>Ubah Data</h2>
    </template>

    <template v-slot:body>

        <div v-if="data[0].hasOwnProperty('role')">
            <input type="hidden" name="identity_number_lama" id="identity_number_lama" :value="ni" class="input-box" />
            <label for="identity_number">Identity Number</label>
            <input type="name" name="identity_number" id="identity_number" v-model="data[0].identity_number" class="input-box" />
            <label for="fullname">Full Name</label>
            <input type="name" name="fullname" id="fullname" v-model="data[0].fullname" class="input-box" />
            <label for="role">Role For The User</label>
            <select v-model="data[0].role" class="input-box">
                <option value="2">Admin</option>
                <option value="3">Student</option>
            </select>
            <label for="password">New Password</label>
            <div id="sama-baris">
                <input :type="passVisibility" id="password" name="password" v-model="data[0].password" class="input-box_no-block" />
                <span class="fas mata" :class="{
                    'fa-eye': !isActive,
                    'fa-eye-slash': isActive
                    }" @click="togglePassword"></span>
            </div>
        </div>

        <div v-else-if="data[0].hasOwnProperty('acs')">
            <input type="hidden" name="id" id="id" :value="data[0].id" class="input-box" />
            <label for="subject_name">Subject Name</label>
            <input type="name" name="subject_name" id="subject_name" v-model="data[0].subject_name" class="input-box" />
            <label for="acs">ACS</label>
            <input type="number" name="acs" id="acs" v-model="data[0].acs" class="input-box" />
        </div>

        <div v-else-if="data[0].hasOwnProperty('room_name')">
            <input type="hidden" name="id" id="id" :value="data[0].id" class="input-box" />
            <label for="room_name">Room Name</label>
            <input type="name" name="room_name" id="room_name" v-model="data[0].room_name" class="input-box" />
        </div>

    </template>

    <template v-slot:footer>
        <form @submit.prevent="submitEditData">
            <button type="submit" class="button-submit">Change</button>
        </form>
    </template>

</modal>
</template>
<script>
import Modal from './../layouts/Modal.vue';

export default {
    components: {
        'modal': Modal
    },
    props: ['showModal', 'data', 'ni'],
    data() {
        return {
            passVisibility: 'password',
            isActive: false,
            tesError: []
        }
    },
    methods: {
        togglePassword() {
            this.isActive = !this.isActive
            if (this.passVisibility === 'password')
                this.passVisibility = 'text'
            else
                this.passVisibility = 'password'
        },
        submitEditData() {
            if (this.data[0].hasOwnProperty('role')) {
                const data = {
                    identity_number_lama: this.ni,
                    identity_number: this.data[0].identity_number,
                    fullname: this.data[0].fullname,
                    role: this.data[0].role,
                    password: this.data[0].password
                }
                axios.post('http://localhost:8000/api/user/edit', data)
                    .then(response => (
                        this.$parent.$emit('edited', {
                            type: 'edit',
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
            }

            else if (this.data[0].hasOwnProperty('acs')) {
                const data = {
                    id: this.data[0].id,
                    subject_name: this.data[0].subject_name,
                    acs: this.data[0].acs,
                }
                axios.post('http://localhost:8000/api/subject/edit', data)
                    .then(response => (
                        this.$parent.$emit('edited', {
                            type: 'edit',
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
            }

            else if (this.data[0].hasOwnProperty('room_name')) {
                const data = {
                    id: this.data[0].id,
                    room_name: this.data[0].room_name,
                }
                axios.post('http://localhost:8000/api/room/edit', data)
                    .then(response => (
                        this.$parent.$emit('edited', {
                            type: 'edit',
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
