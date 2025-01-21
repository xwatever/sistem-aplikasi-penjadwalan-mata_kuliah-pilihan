<template>
<table id="myTable" class="display" />
</template>

<script>
export default {
    props: ['rooms'],
    data() {
        return {
            headers: [{
                    title: '',
                    width: '5px'
                },
                {
                    title: 'Room ID'
                },
                {
                    title: 'Room Number',
                },
                {
                    title: 'Room Name',
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
        rooms(val, oldVal) {
            let vm = this;
            let inc = 1;
            vm.rows = [];

            val.forEach(function(item) {
                let row = [];

                row.push('');
                row.push(item.id);
                row.push(inc);
                row.push(item.room_name);
                row.push('<div class="button-edit"><i class="fas fa-edit"></i></div>&nbsp&nbsp<div class="button-delete"><i class="fas fa-trash-alt"></i></div>');

                vm.rows.push(row);
                inc += 1;
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

            "bPaginate": false,
            "bInfo": false,

            "columnDefs": [{
                    "targets": 0,
                    "orderable": false
                },
                {
                    "targets": 1,
                    "visible": false
                },
                {
                    "targets": [2, 4],
                    "className": "text-center",
                }
            ],
            "order": [],
        });

        const edit = this
        $('#myTable tbody').on('click', '.button-edit', (evt) => {
            if ($(window).width() >= 456) {
                var row = evt.currentTarget.parentElement.parentElement['id']
                this.viewEdit(row);
            } else {
                var row = evt.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.previousSibling['id']
                this.viewEdit(row);
            }
        });

        const remove = this
        $('#myTable tbody').on('click', '.button-delete', (evt) => {
            if ($(window).width() >= 456) {
                var row = evt.currentTarget.parentElement.parentElement['id']
                this.viewDelete(row);
            } else {
                var row = evt.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.previousSibling['id']
                this.viewDelete(row);
            }
        });
    },
    methods: {
        viewEdit(row) {
            this.$emit('eventEdit', {
                idRoom: row,
            })
        },
        viewDelete(row) {
            this.$emit('eventDelete', {
                idRoom: row,
                event: false
            })
        }
    }
}
</script>
