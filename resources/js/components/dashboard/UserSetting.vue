<template>
<div id="content" class="fade-in">
    <div class="panel">
        <div class="title">
            Your Account Settings
        </div>
        <div class="contents">
            <div v-if="user[0].hasOwnProperty('role')">
                <form @submit.prevent="editUser">
                    <label for="id">Identity Number</label>
                    <input type="name" id="id" name="id" v-model="user[0].identity_number" class="input-box" disabled />
                    <label for="fullname">Full Name</label>
                    <input type="name" id="fullname" name="fullname" v-model="user[0].fullname" class="input-box" />
                    <label for="email">Email</label>
                    <input type="name" id="email" name="email" v-model="user[0].email" class="input-box" />
                    <label for="date">Birthdate</label>
                    <Datepicker v-model="user[0].birthdate" :format="format" />
                    <br />
                    <label for="jen_kel">Gender</label>
                    <br /><br />
                    <input type="radio" id="jen_kel" value="Male" v-model="user[0].gender" class="radio-box">
                    &nbsp<span class="sama-baris2">Male</span>
                    <br />
                    <input type="radio" id="jen_kel" value="Female" v-model="user[0].gender" class="radio-box">
                    &nbsp<span class="sama-baris2">Female</span>
                    <br />
                    <input type="radio" id="jen_kel" value="Other" v-model="user[0].gender" class="radio-box">
                    &nbsp<span class="sama-baris2">Other</span>
                    <br />
                    <br />
                    <label for="phone_number">Phone Number</label>
                    <input type="name" id="phone_number" name="phone_number" v-model="user[0].phone_number" class="input-box" />
                    <label for="address">address</label>
                    <textarea name="address" id="address" class="textarea-box" v-model="user[0].address" />
                    <label for="password">
                        New Password For User
                    </label>
                    <div id="sama-baris">
                        <input :type="passVisibility" id="password_confirmation" name="password_confirmation" class="input-box_no-block" v-model="usere.password" />
                        <span class="fas mata" :class="{
                      'fa-eye': !isActive,
                      'fa-eye-slash': isActive
                      }" @click="togglePassword"></span>
                    </div>
                    <label for="password">
                        Confirm Password
                    </label>
                    <div id="sama-baris">
                        <input :type="passVisibility2" id="password" name="password" class="input-box_no-block" v-model="usere.password_confirmation" />
                        <span class="fas mata" :class="{
                      'fa-eye': !isActive2,
                      'fa-eye-slash': isActive2
                      }" @click="togglePassword2"></span>
                    </div>
                    <button type="submit" class="button-submit">Change</button>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Datepicker from 'vue3-date-time-picker';
import {
    ref
} from 'vue';

export default {
    components: {
        Datepicker
    },
    props: ['user'],
    setup() {
        const format = (date) => {
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();

            return `${year}-${month}-${day}`;
        }

        return {
            format
        }
    },
    data: function() {
        return {
            passVisibility: 'password',
            isActive: false,
            passVisibility2: 'password',
            isActive2: false,

            usere: {
                identity_number: '',
                fullname: '',
                email: '',
                birthdate: '',
                gender: '',
                phone_number: '',
                address: '',
                password: '',
                password_confirmation: ''
            }
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
        togglePassword2() {
            this.isActive2 = !this.isActive2
            if (this.passVisibility2 === 'password')
                this.passVisibility2 = 'text'
            else
                this.passVisibility2 = 'password'
        },
        editUser() {
            if (this.user[0].hasOwnProperty('role')) {
                this.usere.identity_number = this.user[0].identity_number
                this.usere.fullname = this.user[0].fullname
                if (this.user[0].email != null) {
                    this.usere.email = this.user[0].email
                } else {
                    this.usere.email = ' '
                }
                if (this.user[0].birthdate != null) {
                    const dateTime = this.user[0].birthdate.toLocaleString('sv-SE')
                    const date = dateTime.split(' ')[0]
                    this.usere.birthdate = date
                }
                this.usere.gender = this.user[0].gender
                if (this.user[0].phone_number != null) {
                    this.usere.phone_number = this.user[0].phone_number
                }
                if (this.user[0].address != null) {
                    this.usere.address = this.user[0].address
                }

                axios.post('http://localhost:8000/api/user/edit/mine', this.usere)
                    .then(response => (
                        this.$emit('edited', {
                            type: 'edite',
                            table: 'user',
                            status: 'success'
                        }),
                        this.$emit('clicked', 'dashboard')
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
            }
        },

    }
}
</script>
