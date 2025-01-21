<template>
<div id="content" class="fade-in">
    <div class="panel fade" v-if="group_view == ''">
        <div class="title">
            Options
        </div>
        <div class="contents">
            <label for="group_view">Select option to view</label>
            <select name="group_view" id="group_view" v-model="group_view" @change="viewToggle" class="input-box">
                <option>Manage Groups</option>
                <option>Add New Group</option>
            </select>
        </div>
    </div>

    <div class="panel fade" v-if="group_view == 'Manage Groups'">
        <div class="back_button" @click="group_view = ''">
            <i class="far fa-arrow-alt-circle-left"></i> &nbsp Back
        </div>
        <div class="title">
            Manage Groups
        </div>
        <div class="contents">
            <datatable v-bind:classrooms="classrooms" @eventEdit="showModalEdit" @eventDelete="showModalDelete" />
        </div>
    </div>

    <div class="panel fade" v-if="group_view == 'Add New Group'">
        <div class="back_button" @click="group_view = ''">
            <i class="far fa-arrow-alt-circle-left"></i> &nbsp Back
        </div>
        <div class="title">
            Add New Group
        </div>
        <div class="contents">
            <form @submit.prevent="addClass">
                <label for="group_name">Group Name</label>
                <input type="name" name="group_name" id="group_name" v-model="group.group_name" class="input-box" />
                <label for="subject_name">Subject for the group</label>
                <select name="subject_name" id="subject_name" v-model="group.subject_name" class="input-box">
                    <option :value="null">
                        Choose the subject
                    </option>
                    <option v-for="option in options.subject" :key="option.id" :value="option.subject_name">
                        {{ option.subject_name }}
                    </option>
                </select>
                <button type="submit" class="button-submit">Add Group</button>
            </form>
        </div>
    </div>

    <modalGroupMember :showModal="showModalE" :idgroup="class_id" :group="classroombd" @event="showModalE = $event" />
    <modalDelete :showModal="showModalD" :data="classroombd" @reload="reloadClassrooms" @event="showModalD = $event" />
</div>
</template>

<script>
import DataTablejs from './../../datatables/Groups.vue';
import GroupMember from './../../modals/GroupMember.vue';
import Delete from './../../modals/Delete.vue';

export default {
    components: {
        'datatable': DataTablejs,
        'modalGroupMember': GroupMember,
        'modalDelete': Delete
    },
    data: function() {
        return {
            group_view: '',
            classrooms: [],
            dtHandle: null,

            group: {
                group_name: '',
                subject_name: null
            },
            options: {
                subject: [],
            },

            class_id: '',
            classroombd: [],
            classroomabd: [],
            showModalE: false,
            showModalD: false
        }
    },
    methods: {
        viewToggle() {
            if (this.group_view == 'Manage Groups') {
                axios.get("http://localhost:8000/api/show/classrooms")
                    .then(res => {
                        this.classrooms = res.data
                    }).catch(err => {
                        console.log(err)
                    });
            } else if (this.group_view == 'Add New Group') {
                axios.get("http://localhost:8000/api/show/subjects")
                    .then(res => {
                        this.options.subject = res.data
                    }).catch(err => {
                        console.log(err)
                    });
            }
        },
        addClass() {
            axios.post('http://localhost:8000/api/classroom/create', this.group)
                .then(response => (
                    this.$emit('created', {
                        type: 'create',
                        table: 'group',
                        status: 'success'
                    }),
                    this.clearClassroomValue()
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
        clearClassroomValue() {
            this.group.subject_name = null
            this.group.group_name = ''
        },
        showModalEdit(val) {
            this.class_id = val.idClassroom
            axios.get("http://localhost:8000/api/classroom/" + val.idClassroom)
                .then(res => {
                    this.classroombd = res.data
                }).catch(err => {
                    console.log(err)
                });
            setTimeout(() => {
                this.showModalE = !this.showModalE
            }, 350);
        },
        showModalDelete(val) {
            axios.get("http://localhost:8000/api/classroom/" + val.idClassroom)
                .then(res => {
                    this.classroombd = res.data
                }).catch(err => {
                    console.log(err)
                });
            setTimeout(() => {
                this.showModalD = !this.showModalD
            }, 350);
        },
        reloadClassrooms() {
            axios.get("http://localhost:8000/api/show/classrooms")
                .then(res => {
                    this.classrooms = res.data
                }).catch(err => {
                    console.log(err)
                });
        }
    }
}
</script>
