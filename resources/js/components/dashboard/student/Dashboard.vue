<template>
<div id="content" class="fade-in">
    <div class="panel">
        <div class="title">
            Student Dashboard
        </div>
        <div class="card-contents">
            <div class="card" @click="onClickViewSchedule">
                <div class="header">
                    <i class="fas fa-calendar-week head"></i>
                    Look for your schedule
                </div>
                <div class="description">
                    Look for the schedules that is avalaible for you to attend to.
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

            <div class="card" @click="onClickViewUserSetting">
                <div class="header">
                    <i class="fas fa-user-cog head"></i>
                    Setting
                </div>
                <div class="description">
                    Change or set up your personal information.
                </div>
            </div>

        </div>
    </div>
</div>
</template>

<script>
export default {
    methods: {
        onClickViewSchedule() {
            this.$emit('clicked', 'schedule')
        },
        onClickViewForum() {
            this.$emit('clicked', 'forum')
        },
        onClickViewUserSetting() {
            this.$emit('clicked', 'userSetting')
        }
    }
}
</script>
