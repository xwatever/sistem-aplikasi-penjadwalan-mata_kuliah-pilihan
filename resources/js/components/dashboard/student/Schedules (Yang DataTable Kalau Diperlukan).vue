<template>
<div id="content" class="fade-in">
    <div class="panel fade" v-if="schedule_view == ''">
        <div class="title">
            Opsi Menampilkan Jadwal
        </div>
        <div class="contents">
            <label for="schedule_view">Tampilkan Opsi Menampilkan Jadwal</label>
            <select name="schedule_view" id="schedule_view" v-model="schedule_view" @change="viewToggle" class="input-box">
                <option>Lihat Jadwal Anda</option>
                <option>Lihat Seluruh Jadwal Yang Akan Datang</option>
            </select>
        </div>
    </div>

    <div class="panel fade" v-if="schedule_view == 'Lihat Jadwal Anda'">
        <div class="back_button" @click="schedule_view = ''">
            <i class="far fa-arrow-alt-circle-left"></i> &nbsp Kembali
        </div>
        <div class="title">
            Jadwal Anda
        </div>
        <div class="contents">
            <datatable v-bind:schedules="schedules" @showGroup="showModalGroupMembers" />
        </div>
    </div>

    <div class="panel fade" v-if="schedule_view == 'Lihat Seluruh Jadwal Yang Akan Datang'">
        <div class="back_button" @click="schedule_view = ''">
            <i class="far fa-arrow-alt-circle-left"></i> &nbsp Kembali
        </div>
        <div class="title">
            Seluruh Jadwal Yang Akan Datang
        </div>
        <div class="contents">
            <datatable v-bind:schedules="schedules" @showGroup="showModalGroupMembers" />
        </div>
    </div>
</div>

<modalGroupMember :showModal="showModal" :idKelas="class_id" :kelas="classroom" @event="showModal = $event" />
</template>

<script>
import DataTablejs from './../../datatables/Schedules.vue';
import GroupMember from './../../modals/GroupMemberStudent.vue';

export default {
    components: {
        'datatable': DataTablejs,
        'modalGroupMember': GroupMember
    },
    props: ['user'],
    data: function() {
        return {
            schedule_view: '',
            schedules: [],
            class_id: '',
            classroom: [],
            showModal: false
        }
    },
    methods: {
        viewToggle() {
            if (this.schedule_view == 'Lihat Jadwal Anda') {
                axios.post("http://localhost:8000/api/show/schedules/mine", this.user[0])
                    .then(res => {
                        this.schedules = res.data
                    }).catch(err => {
                        console.log(err)
                    });
            } else if (this.schedule_view == 'Lihat Seluruh Jadwal Yang Akan Datang') {
                axios.get("http://localhost:8000/api/show/schedules/present")
                    .then(res => {
                        this.schedules = res.data
                    }).catch(err => {
                        console.log(err)
                    });
            }
        },
        showModalGroupMembers(val) {
            this.class_id = val.idClassroom
            axios.get("http://localhost:8000/api/classroom/" + val.idClassroom)
                .then(res => {
                    this.classroom = res.data
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
