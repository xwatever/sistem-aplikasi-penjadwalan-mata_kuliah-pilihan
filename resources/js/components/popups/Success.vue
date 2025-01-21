<template>
<popup :show="showPopup" :type="type">

    <template v-slot:header>
        <span class="fas fa-check">&nbspSuccess</span>
    </template>

    <template v-slot:body>

        <span v-if="crudType == 'create'">You have successfuly created new {{ crudTable }}</span>
        <span v-if="crudType == 'edit'">You have successfuly edited certain {{ crudTable }}</span>
        <span v-if="crudType == 'edite'">You have successfuly change information of your {{ crudTable }}</span>
        <span v-if="crudType == 'delete'">You have successfuly deleted certain{{ crudTable }}</span>

    </template>

</popup>
</template>
<script>
import PopupNotification from './../layouts/PopupNotification.vue';

export default {
    components: {
        'popup': PopupNotification
    },
    props: ['showPopup', 'crudType', 'crudTable'],
    data() {
        return {
            type: 'success'
        }
    }
}
</script>
