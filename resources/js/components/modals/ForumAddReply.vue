<template>
<modal :show="showModal">

    <template v-slot:header>
        <h2>Add Reply</h2>
    </template>

    <template v-slot:body>
        <label for="tanggapan" class="detail-forum">Reply Content</label>
        <textarea name="tanggapan" id="tanggapan" class="textarea-box" v-model="reply.content" />
    </template>

    <template v-slot:footer>
        <form @submit.prevent="submitAddForumReply">
            <button type="submit" class="button-submit">Add</button>
        </form>
    </template>

</modal>
</template>
<script>
import Modal from './../layouts/Modal.vue';

export default {
    components: {
        'modal': Modal
    },
    props: ['showModal', 'idForum'],
    data() {
        return {
            reply: {
                id: '',
                identity_number: '',
                content: ''
            },

            tesError: [],
            user_id: document.head.querySelector('meta[name="user_id"]').content
        }
    },
    methods: {
        submitAddForumReply() {
            this.reply.id = this.idForum
            this.reply.identity_number = this.user_id

            axios.post("http://localhost:8000/api/forum-reply/create", this.reply)
                .then(res => {
                    this.$parent.$emit('created', {
                        type: 'create',
                        table: 'reply',
                        status: 'success'
                    })
                    this.clearReplyValue()
                }).catch(err => {
                    this.tesError = error.response.data.errors
                    if (this.tesError != undefined)
                        this.$parent.$emit('failed', {
                            errorMessage: this.tesError,
                            status: 'failed'
                        })
                });

            this.$emit('event', false)
        },
        clearReplyValue() {
            this.reply.id = ''
            this.reply.identity_number = ''
            this.reply.content= ''
        }
    }
}
</script>
