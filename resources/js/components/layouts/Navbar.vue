<template>
    <nav class="navbar">
        <div class="title" style="font-size: 1.25em">Scheduling System</div>
        <i
            class="far toggle-sidebar-button centerofcontent"
            :class="{
                active: isActive,
                'fa-arrow-alt-circle-left': !isActive,
                'fa-arrow-alt-circle-right': isActive,
            }"
            @click="onClickSidebarCollapse"
        >
        </i>
        <div class="notificationnuser">
            <img
                :src="'images/profile/user.png'"
                width="24"
                height="24"
                class="white-filter user center"
                @click="showUserPopup = !showUserPopup"
            />
            <i class="far fa-question-circle"></i>
        </div>
    </nav>
    <div v-if="showUserPopup" class="popupUser">
        <span class="items"> Hi, {{ user[0].fullname.split(" ")[0] }}! </span>
        <span class="items">
            You are logged as :
            <span v-if="user[0].role == 1"> Super Admin </span>
            <span v-else-if="user[0].role == 2"> Admin </span>
            <span v-else-if="user[0].role == 3"> Student </span>
        </span>
        <span class="accountItem" @click="onClickViewUserSetting">
            Account Setting
        </span>
        <a
            href="/logout"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            class="lastItem"
        >
            Logout
        </a>
    </div>
</template>

<script>
export default {
    props: ["width", "user", "isActive"],
    data() {
        return {
            showUserPopup: false,
            showHelpPopup: false,
        };
    },
    methods: {
        onClickSidebarCollapse() {
            this.$emit("clicked");
        },
        onClickViewUserSetting() {
            this.$emit("clickedsec", "userSetting");
            this.showUserPopup = false;
        },
    },
};
</script>
