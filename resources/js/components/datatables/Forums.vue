<template>
<table id="myTable" class="display" />
</template>

<script>
export default {
    props: ['forums'],
    data() {
        return {
            headers: [{
                    title: '',
                    width: '0.3em',
                },
                {
                    title: 'Forum ID'
                },
                {
                    title: 'Identity Number'
                },
                {
                    title: 'Full Name'
                },
                {
                    title: 'Phone Number'
                },
                {
                    title: 'Time Uploaded'
                },
                {
                    title: 'Discussion Title'
                },
                {
                    title: 'Option',
                    width: '3.9em'
                },
            ],
            rows: [],
            dtHandle: null
        }
    },
    watch: {
        forums(val, oldVal) {
            let vm = this;
            vm.rows = [];

            val.forEach(function(item) {
                let row = [];

                row.push('');
                row.push(item.id);
                row.push(item.identity_number);
                row.push(item.fullname);
                row.push(item.phone_number);
                row.push(item.created_at);
                row.push(item.title);
                row.push('<div class="button-read"><i class="fas fa-eye"></i></div>&nbsp&nbsp<div class="button-reply"><i class="fas fa-comments"></i></div>');

                vm.rows.push(row);
            });

            vm.dtHandle.clear();
            vm.dtHandle.rows.add(vm.rows);
            vm.dtHandle.draw();
        }
    },
    mounted() {
        this.dtHandle = $('#myTable').DataTable({
            responsive: true,
            "autoWidth": false,
            columns: this.headers,
            data: this.rows,
            "rowId": 1,

            "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                },
                {
                    "targets": 1,
                    "visible": false
                },
            ],
            "order": [],
        });

        const read = this
        $('#myTable tbody').on('click', '.button-read', (evt) => {
            if ($(window).width() >= 799) {
                var row = evt.currentTarget.parentElement.parentElement['id']
                this.viewReplies(row);
            } else {
                var row = evt.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.previousSibling['id']
                this.viewReplies(row);
            }
        });

        const read_reply = this
        $('#myTable tbody').on('click', '.button-reply', (evt) => {
            if ($(window).width() >= 799) {
                var row = evt.currentTarget.parentElement.parentElement['id']
                var idu = evt.currentTarget.parentElement.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.lastChild.data
                this.viewAddReplies(row, idu);
            } else {
                var row = evt.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.previousSibling['id']
                var idu = evt.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.previousSibling.childNodes[1].lastChild.data
                this.viewAddReplies(row, idu);
            }
        });
    },
    methods: {
        viewReplies(row, idu) {
            this.$emit('eventReply', {
                idForum: row
            })
        },
        viewAddReplies(row, idu) {
            this.$emit('eventAddReply', {
                idForum: row,
                idUser: idu
            })
        }
    }
}
</script>
