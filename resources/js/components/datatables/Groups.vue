<template>
<table id="myTable" class="display" />
</template>

<script>
export default {
    props: ['classrooms'],
    data() {
        return {
            headers: [{
                    title: '',
                    width: '5px'
                },
                {
                    title: 'Group ID'
                },
                {
                    title: 'Group Number',
                },
                {
                    title: 'Group Name'
                },
                {
                    title: 'Subject',
                },
                {
                    title: 'Option',
                    width: '3.9em'
                },
            ],
            rows: [],
            dtHandle: null,
            row_id: ''
        }
    },
    watch: {
        classrooms(val, oldVal) {
            let vm = this;
            let inc = 1;
            vm.rows = [];

            val.forEach(function(item) {
                let row = [];

                row.push('');
                row.push(item.id);
                row.push(inc);
                row.push(item.group_name);
                row.push(item.subject_name);
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

            "columnDefs": [{
                    "targets": 0,
                    "orderable": false
                },
                {
                    "targets": 2,
                    "className": "text-center",
                },
                {
                    "targets": 1,
                    "visible": false
                }
            ],
            "order": [],
        });

        const self = this
        $('#myTable tbody').on('click', '.button-edit', (evt) => {
            if ($(window).width() >= 524) {
                var row = evt.currentTarget.parentElement.parentElement['id']
                this.viewGroupMembers(row);
            } else {
                var row = evt.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.previousSibling['id']
                this.viewGroupMembers(row);
            }
        });

        const remove = this
        $('#myTable tbody').on('click', '.button-delete', (evt) => {
            if ($(window).width() >= 524) {
                var row = evt.currentTarget.parentElement.parentElement['id']
                this.viewDelete(row);
            } else {
                var row = evt.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.previousSibling['id']
                this.viewDelete(row);
            }
        });
    },
    methods: {
        viewGroupMembers(row) {
            this.$emit('eventEdit', {
                idClassroom: row
            })
        },
        viewDelete(row) {
          this.$emit('eventDelete', {
              idClassroom: row,
              event: false
          })
        }
    }
}
</script>
