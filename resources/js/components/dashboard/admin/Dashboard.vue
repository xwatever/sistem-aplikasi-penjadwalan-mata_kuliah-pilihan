<template>
<div id="content" class="fade-in">
    <div class="panel">
        <div class="title">
            Admin's Dashboard
        </div>
        <div class="card-contents">
            <div class="card" @click="onClickViewManageUser">
                <div class="header">
                    <i class="fas fa-user head"></i>
                    Manage Users
                </div>
                <div class="description">
                    Manage users like adding, modifying, deleting certain users.
                </div>
            </div>

            <div class="card">
                <div class="header" @click="onClickViewManageSubject">
                    <i class="fas fa-book head"></i>
                    Manage Subjects
                </div>
                <div class="description">
                    Manage avalaible subjects for students.
                </div>
            </div>

            <div class="card" @click="onClickViewManageRoom">
                <div class="header">
                    <i class="fas fa-chalkboard-teacher head"></i>
                    Manage Classrooms
                </div>
                <div class="description">
                    Manage rooms for student to attend to.
                </div>
            </div>

            <div class="card" @click="onClickViewManageGroup">
                <div class="header">
                    <i class="fas fa-users head"></i>
                    Manage Groups
                </div>
                <div class="description">
                    Manage group of students for attending classes.
                </div>
            </div>

            <div class="card" @click="onClickViewManageSchedule">
                <div class="header">
                    <i class="fas fa-calendar-week head"></i>
                    Manage Schedules
                </div>
                <div class="description">
                    Manage schedules for the students.
                </div>
            </div>

            <div class="card" @click="onClickViewForum">
                <div class="header">
                    <i class="fas fa-comment-dots head"></i>
                    Forum
                </div>
                <div class="description">
                    Place to ask about the schedule that have been made or anything that is on your mind.
                </div>
            </div>

            <!-- <div class="card" @click="onClickViewUserSetting">
                <div class="header">
                    <i class="fas fa-user-cog head"></i>
                    Pengaturan
                </div>
                <div class="description">
                    Mengatur informasi pribadi anda
                </div>
            </div> -->


        </div>
    </div>
</div>
</template>

<script>
export default {
    methods: {
        onClickViewDashboard() {
            this.$emit('clicked', 'dashboard')
        },
        onClickViewManageUser() {
            this.$emit('clicked', 'manageUsers')
        },
        onClickViewManageSubject() {
            this.$emit('clicked', 'manageSubjects')
        },
        onClickViewManageRoom() {
            this.$emit('clicked', 'manageRooms')
        },
        onClickViewManageGroup() {
            this.$emit('clicked', 'manageGroups')
        },
        onClickViewManageSchedule() {
            this.$emit('clicked', 'manageSchedule')
        },
        onClickViewForum() {
            this.$emit('clicked', 'forum')
        },
        // onClickViewUserSetting() {
        //     this.$emit('clicked', 'userSetting')
        // },

    }
}
</script>
