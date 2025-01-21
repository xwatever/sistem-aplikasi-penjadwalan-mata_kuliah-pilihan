<template>
<popup :show="showPopup" :errorMessage="errorMessage" :type="type">

    <template v-slot:header>
        <span class="fas fa-times">&nbspFail</span>
    </template>

    <template v-slot:body>
        <b>There is error found:</b>
        <div v-for="index in errorMessage">
            <div v-for="value in index">
                {{ value }}
            </div>
        </div>
    </template>

</popup>
</template>

<script>
import PopupNotification from './../layouts/PopupNotification.vue';

export default {
    components: {
        'popup': PopupNotification
    },
    props: ['showPopup', 'errorMessage'],
    data() {
        return {
            type: 'failed'
        }
    }
}
</script>
