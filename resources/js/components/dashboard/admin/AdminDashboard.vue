<template>
    <navbar
        @clicked="sidebarCollapse"
        @clickedsec="changeView"
        :is-active="isActiveNavbar"
        :user="user"
        :width="width"
    />
    <div class="wrapper">
        <sidebar
            @clicked="changeView"
            :is-active="isActiveSidebar"
            :role="role"
        />

        <div id="content">
            <template v-if="view === 'dashboard'" class="fade-in">
                <admin-dashboard @clicked="changeView" />
            </template>

            <template v-if="view === 'manageUsers'" class="fade-in">
                <admin-manageusers
                    @created="togglePopup"
                    @failed="togglePopup"
                    @edited="togglePopup"
                    @deleted="togglePopup"
                />
            </template>

            <template v-else-if="view === 'manageSubjects'" class="fade-in">
                <admin-managesubjects
                    @created="togglePopup"
                    @failed="togglePopup"
                    @edited="togglePopup"
                    @deleted="togglePopup"
                />
            </template>

            <template v-else-if="view === 'manageRooms'" class="fade-in">
                <admin-managerooms
                    @created="togglePopup"
                    @failed="togglePopup"
                    @edited="togglePopup"
                    @deleted="togglePopup"
                />
            </template>

            <template v-else-if="view === 'manageGroups'" class="fade-in">
                <admin-managegroups
                    @created="togglePopup"
                    @failed="togglePopup"
                    @edited="togglePopup"
                    @deleted="togglePopup"
                />
            </template>

            <template v-else-if="view === 'manageSchedule'" class="fade-in">
                <admin-manageschedules
                    @created="togglePopup"
                    @failed="togglePopup"
                    @edited="togglePopup"
                    @deleted="togglePopup"
                />
            </template>

            <template v-else-if="view === 'forum'" class="fade-in">
                <forums
                    @created="togglePopup"
                    @failed="togglePopup"
                    @edited="togglePopup"
                    @deleted="togglePopup"
                />
            </template>

            <template v-else-if="view === 'userSetting'" class="fade-in">
                <user-setting
                    :user="user"
                    @failed="togglePopup"
                    @edited="togglePopup"
                    @clicked="changeView"
                />
            </template>
        </div>
    </div>
    <successPopup
        :showPopup="showPopupSuccess"
        :crudType="crudType"
        :crudTable="crudTable"
        @popupclose="showPopupSuccess = $event"
    ></successPopup>
    <failedPopup
        :showPopup="showPopupFailed"
        :errorMessage="errorMessage"
        @popupclose="showPopupFailed = $event"
    ></failedPopup>
</template>

<script>
import Navbar from "./../../layouts/Navbar.vue";
import Sidebar from "./../../layouts/Sidebar.vue";

import Dashboard from "./Dashboard.vue";
import ManageUsers from "./ManageUsers.vue";
import ManageSubjects from "./ManageSubjects.vue";
import ManageRooms from "./ManageRooms.vue";
import ManageGroups from "./ManageGroups.vue";
import ManageSchedules from "./ManageSchedules.vue";
import Forum from "./../Forum.vue";
import UserSetting from "./../UserSetting.vue";

import Success from "./../../popups/Success.vue";
import Failed from "./../../popups/Failed.vue";

export default {
    components: {
        navbar: Navbar,
        sidebar: Sidebar,
        "admin-dashboard": Dashboard,
        "admin-manageusers": ManageUsers,
        "admin-managesubjects": ManageSubjects,
        "admin-managerooms": ManageRooms,
        "admin-managegroups": ManageGroups,
        "admin-manageschedules": ManageSchedules,
        forums: Forum,
        "user-setting": UserSetting,
        successPopup: Success,
        failedPopup: Failed,
    },
    data: function () {
        return {
            view: "dashboard",
            isActiveNavbar: false,
            isActiveSidebar: false,
            width: window.innerWidth,
            showPopupSuccess: false,
            showPopupFailed: false,
            crudType: "",
            crudTable: "",
            errorMessage: [],
            user: [],
            role: "",
            user_id: document.head.querySelector('meta[name="user_id"]')
                .content,
        };
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    mounted() {
        axios
            .get("http://localhost:8000/api/user/" + this.user_id)
            .then((res) => {
                (this.user = res.data), (this.role = this.user[0].role);
            })
            .catch((err) => {
                console.log(err);
            });
    },
    methods: {
        handleResize() {
            this.width = window.innerWidth;
            if (this.width > 768) {
                this.isActiveNavbar = false;
                this.isActiveSidebar = false;
            } else {
                this.isActiveNavbar = true;
                this.isActiveSidebar = false;
            }
        },
        changeView(value) {
            this.view = value;
            this.isActiveSidebar = false;
        },
        sidebarCollapse() {
            this.isActiveSidebar = !this.isActiveSidebar;
            this.isActiveNavbar = !this.isActiveNavbar;
        },
        togglePopup(event) {
            if (event.status == "success") {
                this.crudType = event.type;
                this.crudTable = event.table;
                this.showPopupSuccess = !this.showPopupSuccess;
            } else if (event.status == "failed") {
                this.errorMessage = event.errorMessage;
                this.showPopupFailed = !this.showPopupFailed;
            }
        },
    },
    destroyed() {
        window.removeEventListener("resize", this.handleResize);
    },
};
</script>
