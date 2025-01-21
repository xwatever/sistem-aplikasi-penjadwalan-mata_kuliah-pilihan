<template>
<div id="content" class="fade-in">
    <div class="panel fade" v-if="user_view == ''">
        <div class="title">
            Option
        </div>
        <div class="contents">
            <label for="user_view">Select option to view</label>
            <select name="user_view" id="user_view" v-model="user_view" @change="viewToggle" class="input-box">
                <option>Manage Users</option>
                <option>Add New User</option>
            </select>
        </div>
    </div>

    <div class="panel fade" v-if="user_view == 'Manage Users'">
        <div class="back_button" @click="user_view = ''">
            <i class="far fa-arrow-alt-circle-left"></i> &nbsp Back
        </div>
        <div class="title">
            Manage Users
        </div>
        <div class="contents">
            <datatable :users="users" @eventEdit="showModalEdit" @eventDelete="showModalDelete" />
        </div>
    </div>

    <div class="panel fade" v-if="user_view == 'Add New User'">
        <div class="back_button" @click="user_view = ''">
            <i class="far fa-arrow-alt-circle-left"></i> &nbsp Back
        </div>
        <div class="title">
            Add New User
        </div>
        <div class="contents">
            <form @submit.prevent="addUser">
                <label for="id">Identity Number</label>
                <input type="name" id="id" name="id" v-model="user.identity_number" class="input-box" />
                <label for="fullname">Full Name</label>
                <input type="name" id="fullname" name="fullname" v-model="user.fullname" class="input-box" />
                <label for="user_status">User Role</label>
                <select name="user_status" id="user_status" v-model="user.role" class="input-box">
                    <option :value="null">Role for the user</option>
                    <option value="2">Admin</option>
                    <option value="3">Student</option>
                </select>
                <label for="password">
                    Password
                </label>
                <div id="sama-baris">
                    <input :type="passVisibility" id="password" name="password" v-model="user.password" class="input-box_no-block" />
                    <span class="fas mata" :class="{
                        'fa-eye': !isActive,
                        'fa-eye-slash': isActive
                        }" @click="togglePassword"></span>
                </div>
                <button type="submit" class="button-submit">Add</button>
            </form>
        </div>
    </div>

    <modalEdit :showModal="showModalE" :data="userbe" :ni="ni_yangdigunakan" @reload="reloadUsers" @event="showModalE = $event" />
    <modalDelete :showModal="showModalD" :data="userbd" @reload="reloadUsers" @event="showModalD = $event" />

</div>
</template>

<script>
import DataTablejs from './../../datatables/Users.vue';
import Edit from './../../modals/Edit.vue';
import Delete from './../../modals/Delete.vue';

export default {
    components: {
        'datatable': DataTablejs,
        'modalEdit': Edit,
        'modalDelete': Delete
    },
    data: function() {
        return {
            user_view: '',
            users: [],

            passVisibility: 'password',
            isActive: false,
            user: {
                identity_number: '',
                fullname: '',
                role: null,
                password: ''
            },

            userbe: [],
            ni_yangdigunakan: '',
            userbd: [],
            showModalE: false,
            showModalD: false,

            tesError: []
        }
    },
    methods: {
        viewToggle() {
            if (this.user_view == 'Manage Users') {
                axios.get("http://localhost:8000/api/show/users")
                    .then(res => {
                        this.users = res.data
                    }).catch(err => {
                        console.log(err)
                    });
            }
        },
        togglePassword() {
            this.isActive = !this.isActive
            if (this.passVisibility === 'password')
                this.passVisibility = 'text'
            else
                this.passVisibility = 'password'
        },
        clearUserValue() {
            this.user.identity_number = ''
            this.user.fullname = ''
            this.user.role = null
            this.user.password = ''
        },
        addUser() {
            axios.post('http://localhost:8000/api/user/create', this.user)
                .then(response => (
                    this.$emit('created', {
                        type: 'create',
                        table: 'user',
                        status: 'success'
                    }),
                    this.clearUserValue()
                ))
                .catch(error => {
                    this.tesError = error.response.data.errors
                    if (this.tesError != undefined)
                        this.$emit('failed', {
                            errorMessage: this.tesError,
                            status: 'failed'
                        })
                })
                .finally(() => this.loading = false);

        },
        showModalEdit(idUser) {
            axios.get("http://localhost:8000/api/user/" + idUser.idUser)
                .then(res => {
                    this.userbe = res.data
                    this.ni_yangdigunakan = idUser.idUser
                }).catch(err => {
                    console.log(err)
                });
            setTimeout(() => {
                this.showModalE = !this.showModalE
            }, 350);
        },
        showModalDelete(idUser) {
            axios.get("http://localhost:8000/api/user/" + idUser.idUser)
                .then(res => {
                    this.userbd = res.data
                }).catch(err => {
                    console.log(err)
                });
            setTimeout(() => {
                this.showModalD = !this.showModalD
            }, 350);
        },
        reloadUsers() {
            axios.get("http://localhost:8000/api/show/users")
                .then(res => {
                    this.users = res.data
                }).catch(err => {
                    console.log(err)
                });
        }

    }
}
</script>
