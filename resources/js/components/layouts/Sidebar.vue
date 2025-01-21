<template>
<div id="sidebar" :class="{ active: isActive }">
    <div v-if="role == 1 || role == 2">
        <div class="sidebar-options" @click="onClickViewDashboard">
            <i class="fas fa-home icons"></i>
            Dashboard
        </div>

        <div class="sidebar-options" @click="onClickViewManageUser">
            <i class="fas fa-user icons"></i>
            Manage Users
        </div>

        <div class="sidebar-options" @click="onClickViewManageSubject">
            <i class="fas fa-book icons"></i>
            Manage Subjects
        </div>

        <div class="sidebar-options" @click="onClickViewManageRoom">
            <i class="fas fa-chalkboard-teacher icons"></i>
            Manage Rooms
        </div>

        <div class="sidebar-options" @click="onClickViewManageGroup">
            <i class="fas fa-users icons"></i>
            Manage Groups
        </div>

        <div class="sidebar-options" @click="onClickViewManageSchedule">
            <i class="fas fa-calendar-week icons"></i>
            Manage Schedules
        </div>

        <div class="sidebar-options" @click="onClickViewForum">
            <i class="fas fa-comment-dots icons"></i>
            Forum
        </div>
    </div>

    <div v-else-if="role == 3">
        <div class="sidebar-options" @click="onClickViewDashboard">
            <i class="fas fa-home icons"></i>
            Dashboard
        </div>

        <div class="sidebar-options" @click="onClickViewSchedule">
            <i class="fas fa-calendar-week icons"></i>
            Look For Schedules
        </div>

        <div class="sidebar-options" @click="onClickViewForum">
            <i class="fas fa-comment-dots icons"></i>
            Forum
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['isActive', 'role'],
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
        onClickViewSchedule() {
            this.$emit('clicked', 'schedule')
        },
        onClickViewForum() {
            this.$emit('clicked', 'forum')
        },

    }
}
</script>
