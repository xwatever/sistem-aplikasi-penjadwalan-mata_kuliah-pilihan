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
                    title: 'Identity Number',
                    width: '5em'
                },
                {
                    title: 'Full Name',
                },
                {
                    title: 'Phone Number',
                },
            ],
            rows: [],
            dtHandle: null,
        }
    },
    watch: {
        groupMembers(val, oldVal) {
            let vm = this;
            vm.rows = [];

            val.forEach(function(item) {
                let row = [];

                row.push('');
                row.push(item.identity_number);
                row.push(item.fullname);
                row.push(item.phone_number);

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

            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,

            "columnDefs": [{
                "targets": 0,
                "orderable": false
            }, ],
            "order": [],
        });

    }
}
</script>
