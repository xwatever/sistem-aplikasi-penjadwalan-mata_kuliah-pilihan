<template>
<modal :show="showModal">

    <template v-slot:header>
        <h2>Discussion</h2>
    </template>

    <template v-slot:body>
        <div v-for="items in content">
            <div class="detail-forum">
                {{ items.fullname }} Asked, With Identity Number: {{ items.identity_number }}
            </div>
            <div class="contents-forum">
                <p style="white-space: pre-line;">
                    {{ items.content }}
                </p>
            </div>
        </div>

        <div v-for="items in replies">
            <div class="detail-forum_replies">
                {{ items.fullname }} Replied, With Identity Number : {{ items.identity_number }}
            </div>
            <div class="contents-forum">
                <p style="white-space: pre-line;">
                    {{ items.content }}
                </p>
            </div>
        </div>
    </template>

    <template v-slot:footer>

    </template>

</modal>
</template>
<script>
import Modal from './../layouts/Modal.vue';

export default {
    components: {
        'modal': Modal
    },
    props: ['showModal', 'content', 'replies']
}
</script>
