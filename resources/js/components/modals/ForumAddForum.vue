<template>
<modal :show="showModal">

    <template v-slot:header>
        <h2>Add New Discussion</h2>
    </template>

    <template v-slot:body>
        <label for="title" class="detail-forum">Title Discussion</label>
        <input type="name" name="title" id="title" class="input-box" v-model="forum.title" />
        <label for="pertanyaan" class="detail-forum">Discussion Content</label>
        <textarea name="pertanyaan" id="pertanyaan" class="textarea-box" v-model="forum.content"></textarea>
    </template>

    <template v-slot:footer>
        <form @submit.prevent="submitAddForum">
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
    props: ['showModal'],
    data() {
        return {
            forum: {
                identity_number: '',
                title: '',
                content: ''
            },

            tesError: [],
            user_id: document.head.querySelector('meta[name="user_id"]').content
        }
    },
    methods: {
        submitAddForum() {
            this.forum.identity_number = this.user_id

            axios.post("http://localhost:8000/api/forum/create", this.forum)
                .then(res => {
                    this.$parent.$emit('created', {
                        type: 'create',
                        table: 'new discussion',
                        status: 'success'
                    })
                    this.$emit('reload')
                    this.clearForumValue()
                })
                .catch(error => {
                    this.tesError = error.response.data.errors
                    if (this.tesError != undefined)
                        this.$parent.$emit('failed', {
                            errorMessage: this.tesError,
                            status: 'failed'
                        })
                }).finally(() => this.loading = false);


            this.$emit('event', false)
        },
        clearForumValue() {
            this.forum.identity_number = ''
            this.forum.content= ''
        }
    }
}
</script>
