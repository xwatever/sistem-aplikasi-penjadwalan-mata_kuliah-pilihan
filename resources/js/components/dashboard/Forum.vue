<template>
<div id="content" class="fade-in">
    <div class="panel">
        <div class="title">
            Forum Discussions
        </div>
        <div class="contents">
            <div class="back_button" @click="showModalAddForum">
                <i class="fas fa-plus"></i> &nbsp Add New Discussion
            </div>
            <br />
            <datatable v-bind:forums="forums" @eventReply="showModalShowReplies" @eventAddReply="showModalAddReply" />
        </div>
    </div>

    <modalShowReplies :showModal="showModalSR" :content="content" :replies="replies" @reload="reloadForums" @event="showModalSR = $event" />
    <modalAddReply :showModal="showModalAR" :idForum="id_forum" @reload="reloadForums" @event="showModalAR = $event" />
    <modalAddForum :showModal="showModalAF" @reload="reloadForums" @event="showModalAF = $event" />

</div>
</template>

<script>
import DataTablejs from './../datatables/Forums.vue';

import ForumReplies from './../modals/ForumReplies.vue';
import ForumAddReply from './../modals/ForumAddReply.vue';
import ForumAddForum from './../modals/ForumAddForum.vue';

export default {
    components: {
        'datatable': DataTablejs,
        'modalShowReplies': ForumReplies,
        'modalAddReply': ForumAddReply,
        'modalAddForum': ForumAddForum,

    },
    data: function() {
        return {
            forums: [],
            dtHandle: null,

            showModalAF: false,

            content: [],
            replies: [],
            showModalSR: false,

            id_forum: '',
            showModalAR: false,
        }
    },
    mounted() {
        axios.get("http://localhost:8000/api/show/forums")
            .then(res => {
                this.forums = res.data
            }).catch(err => {
                console.log(err)
            });
    },
    methods: {
        showModalShowReplies(val) {
            axios.get("http://localhost:8000/api/forum/" + val.idForum + "/content")
                .then(res => {
                    this.content = res.data
                }).catch(err => {
                    console.log(err)
                });
            axios.get("http://localhost:8000/api/forum/" + val.idForum + "/replies")
                .then(res => {
                    this.replies = res.data
                }).catch(err => {
                    console.log(err)
                });
            setTimeout(() => {
                this.showModalSR = !this.showModalSR
            }, 350);

        },
        showModalAddReply(val) {
            this.id_forum = val.idForum
            axios.get("http://localhost:8000/api/forum/" + val.idForum + "/content")
                .then(res => {
                    this.content = res.data
                }).catch(err => {
                    console.log(err)
                });
            axios.get("http://localhost:8000/api/forum/" + val.idForum + "/replies")
                .then(res => {
                    this.replies = res.data
                }).catch(err => {
                    console.log(err)
                });
            setTimeout(() => {
                this.showModalAR = !this.showModalAR
            }, 350);
        },
        showModalAddForum() {
            this.showModalAF = !this.showModalAF
        },
        reloadForums() {
            axios.get("http://localhost:8000/api/show/forums")
                .then(res => {
                    this.forums = res.data
                }).catch(err => {
                    console.log(err)
                });
        }
    }
}
</script>
