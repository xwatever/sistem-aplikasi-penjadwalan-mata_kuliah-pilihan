<template>
<table id="myTable" class="display" />
</template>

<script>
export default {
    props: ['schedules'],
    data() {
        return {
            headers: [{
                    title: '',
                    width: '5px'
                },
                {
                    title: 'Schedule ID'
                },
                {
                    title: 'Schedule Number'
                },
                {
                    title: 'Schedule Title',
                },
                {
                    title: 'Group Name'
                },
                {
                    title: 'Start Of Schedule Time',
                },
                {
                    title: 'End Of Schedule Time',
                },
            ],
            rows: [],
            dtHandle: null,
            row_id: ''
        }
    },
    watch: {
        schedules(val, oldVal) {
            let vm = this;
            let inc = 1;
            vm.rows = [];

            val.forEach(function(item) {
                let row = [];

                row.push('');
                row.push(item.class_id);
                row.push(inc);
                row.push(item.title);
                row.push(item.group_name);
                row.push(item.start);
                row.push(item.end);

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
                    "targets": 4,
                    "className": "class-view",
                },
                {
                    "targets": 1,
                    "visible": false
                }
            ],
            "order": [],
        });

        const self = this
        $('#myTable tbody').on('click', '.class-view', (evt) => {
            if ($(window).width() >= 467) {
                var row = evt.currentTarget.parentElement['id']
                this.viewGroupMembers(row);
            } else {
                var row = evt.currentTarget.parentElement.parentElement.parentElement.previousSibling['id']
                this.viewGroupMembers(row);
            }
        });
    },
    methods: {
        viewGroupMembers(row) {
            this.$emit('showGroup', {
                idClassroom: row
            })
        }
    }
}
</script>
