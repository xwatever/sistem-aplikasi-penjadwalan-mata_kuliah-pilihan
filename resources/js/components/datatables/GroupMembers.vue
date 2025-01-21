<template>
<table id="mySecondTable" class="display" />
</template>

<script>
export default {
    props: ['groupMembers'],
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
                    title: 'Identity Number',
                    width: '5em'
                },
                {
                    title: 'Full Name',
                },
                {
                    title: 'Phone Number',
                },
                {
                    title: 'Option',
                    width: '1.3em'
                },
            ],
            rows: [],
            dtHandle: null,
            row_id: ''
        }
    },
    watch: {
        groupMembers(val, oldVal) {
            let vm = this;
            vm.rows = [];

            val.forEach(function(item) {
                let row = [];

                row.push('');
                row.push(item.id);
                row.push(item.identity_number);
                row.push(item.fullname);
                row.push(item.phone_number);
                row.push('<div class="button-delete"><i class="fas fa-trash-alt"></i></div>');

                vm.rows.push(row);
            });

            vm.dtHandle.clear();
            vm.dtHandle.rows.add(vm.rows);
            vm.dtHandle.draw();
        }
    },
    mounted() {
        this.dtHandle = $('#mySecondTable').DataTable({
            responsive: true,
            "autoWidth": false,
            columns: this.headers,
            data: this.rows,
            "rowId": 2,

            "bPaginate": false,
            "bInfo": false,

            "columnDefs": [{
                    "targets": 0,
                    "orderable": false
                },
                {
                    "targets": 1,
                    "visible": false
                }
            ],
            "order": [],
        });

        const remove = this
        $('#mySecondTable tbody').on('click', '.button-delete', (evt) => {
            if ($(window).width() >= 470) {
                var row = evt.currentTarget.parentElement.parentElement['id']
                this.viewDelete(row);
            } else {
                var row = evt.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.previousSibling['id']
                this.viewDelete(row);
            }
        });
    },
    methods: {
        viewDelete(row) {
            this.$emit('eventDelete', {
                idAttendance: row
            })
        }
    }
}
</script>
