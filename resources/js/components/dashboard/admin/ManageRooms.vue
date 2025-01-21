<template>
<div id="content" class="fade-in">
    <div class="panel fade" v-if="room_view == ''">
        <div class="title">
            Options
        </div>
        <div class="contents">
            <label for="room_view">Select option to view</label>
            <select name="room_view" id="room_view" v-model="room_view" @change="viewToggle" class="input-box">
                <option>Manage Rooms</option>
                <option>Add New Room</option>
            </select>
        </div>
    </div>

    <div class="panel fade" v-if="room_view == 'Manage Rooms'">
        <div class="back_button" @click="room_view = ''">
            <i class="far fa-arrow-alt-circle-left"></i> &nbsp Kembali
        </div>
        <div class="title">
            Manage Rooms
        </div>
        <div class="contents">
            <datatable v-bind:rooms="rooms" @eventEdit="showModalEdit" @eventDelete="showModalDelete" />
        </div>
    </div>

    <div class="panel fade" v-if="room_view == 'Add New Room'">
        <div class="back_button" @click="room_view = ''">
            <i class="far fa-arrow-alt-circle-left"></i> &nbsp Kembali
        </div>
        <div class="title">
            Add New Room
        </div>
        <div class="contents">
            <form @submit.prevent="addRoom">
                <label for="room_name">Room name</label>
                <input type="name" id="room_name" name="room_name" v-model="room.room_name" class="input-box" />
                <button type="submit" class="button-submit">Add Room</button>
            </form>
        </div>
    </div>

    <modalEdit :showModal="showModalE" :data="roombe" :id="idbeingused" @reload="reloadRooms" @event="showModalE = $event" />
    <modalDelete :showModal="showModalD" :data="roombd" @reload="reloadRooms" @event="showModalD = $event" />

</div>
</template>

<script>
import DataTablejs from './../../datatables/Rooms.vue';
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
            room_view: '',
            rooms: [],
            dtHandle: null,
            room: {
                room_name: '',
                sks: '',
            },

            roombe: [],
            idbeingused: '',
            roombd: [],
            showModalE: false,
            showModalD: false,
        }
    },
    methods: {
        viewToggle() {
            if (this.room_view == 'Manage Rooms') {
                axios.get("http://localhost:8000/api/show/rooms")
                    .then(res => {
                        this.rooms = res.data
                    }).catch(err => {
                        console.log(err)
                    });
            }
        },
        addRoom() {
            axios.post('http://localhost:8000/api/room/create', this.room)
                .then(response => (
                    this.$emit('created', {
                        type: 'create',
                        table: 'room',
                        status: 'success'
                    }),
                    this.clearRoomValue()
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
        showModalEdit(idRoom) {
            axios.get("http://localhost:8000/api/room/" + idRoom.idRoom)
                .then(res => {
                    this.roombe = res.data
                    this.idbeingused = idRoom.idRoom
                }).catch(err => {
                    console.log(err)
                });
            setTimeout(() => {
                this.showModalE = !this.showModalE
            }, 350);
        },
        showModalDelete(idRoom) {
            axios.get("http://localhost:8000/api/room/" + idRoom.idRoom)
                .then(res => {
                    this.roombd = res.data
                }).catch(err => {
                    console.log(err)
                });
            setTimeout(() => {
                this.showModalD = !this.showModalD
            }, 350);
        },
        reloadRooms() {
            axios.get("http://localhost:8000/api/show/rooms")
                .then(res => {
                    this.rooms = res.data
                }).catch(err => {
                    console.log(err)
                });
        },
        clearRoomValue() {
            this.room.room_name = ''
            this.room.sks = ''
        }
    }
}
</script>
