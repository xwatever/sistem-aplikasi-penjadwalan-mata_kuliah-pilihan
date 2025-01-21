<template>
<table id="myTable" class="display" />
</template>

<script>
export default {
    props: ['users'],
    data() {
        return {
            headers: [{
                    title: '',
                    width: '5px'
                },
                {
                    title: 'Identity Number',
                    width: '3.2em'
                },
                {
                    title: 'Full Name'
                },
                {
                    title: 'Birthdate'
                },
                {
                    title: 'Gender'
                },
                {
                    title: 'Phone Number'
                },
                {
                    title: 'Email'
                },
                {
                    title: 'Address'
                },
                {
                    title: 'Role'
                },
                {
                    title: 'Option',
                    width: '4em'
                }
            ],
            rows: [],
            dtHandle: null
        }
    },
    watch: {
        users(val, oldVal) {
            let vm = this
            vm.rows = []

            val.forEach(function(item) {
                let row = []

                row.push('')
                row.push(item.identity_number)
                row.push(item.fullname)
                row.push(item.birthdate)
                row.push(item.gender)
                row.push(item.phone_number)
                row.push(item.email)
                row.push(item.address)

                if (item.role == 1)
                    row.push('Super Admin')
                else if (item.role == 2)
                    row.push('Admin')
                else if (item.role == 3)
                    row.push('Student')

                row.push('<div class="button-edit"><i class="fas fa-edit"></i></div>&nbsp&nbsp<div class="button-delete"><i class="fas fa-trash-alt"></i></div>')

                vm.rows.push(row)
            });

            vm.dtHandle.clear()
            vm.dtHandle.rows.add(vm.rows)
            vm.dtHandle.draw()
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
                    "orderable": false,
                },
                {
                    "targets": [1, 3],
                    "className": "text-center",
                }
            ],
            "order": [],
        });

        const edit = this
        $('#myTable tbody').on('click', '.button-edit', (evt) => {
            if ($(window).width() >= 1261) {
                var row = evt.currentTarget.parentElement.parentElement['id']
                this.viewEdit(row);
            } else {
                var row = evt.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.previousSibling['id']
                this.viewEdit(row);
            }
        });

        const remove = this
        $('#myTable tbody').on('click', '.button-delete', (evt) => {
            if ($(window).width() >= 1261) {
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
                idUser: row,
            })
        },
        viewDelete(row) {
            this.$emit('eventDelete', {
                idUser: row,
                event: false
            })
        }
    }
}
</script>
