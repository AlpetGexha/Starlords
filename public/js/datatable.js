function datatables() {
    return {
        selectedRows: [],

        open: false,

        toggleColumn(key) {
            // Note: All td must have the same class name as the headings key!
            let columns = document.querySelectorAll('.' + key);

            if (this.$refs[key].classList.contains('hidden') && this.$refs[key].classList.contains(key)) {
                columns.forEach(column => {
                    column.classList.remove('hidden');
                });
            } else {
                columns.forEach(column => {
                    column.classList.add('hidden');
                });
            }
        },

        getRowDetail($event, id) {
            let rows = this.selectedRows;

            if (rows.includes(id)) {
                let index = rows.indexOf(id);
                rows.splice(index, 1);
            } else {
                rows.push(id);
            }
        },

        selectAllCheckbox($event) {
            let columns = document.querySelectorAll('.rowCheckbox');

            this.selectedRows = [];

            if ($event.target.checked == true) {
                columns.forEach(column => {
                    column.checked = true
                    this.selectedRows.push(parseInt(column.value))
                });
            } else {
                columns.forEach(column => {
                    column.checked = false
                });
                this.selectedRows = [];
            }
        },

        selectAllHere() {
            let columns = document.querySelectorAll('.rowCheckbox');
            columns.forEach(column => {
                column.checked = true
                this.selectedRows.push(parseInt(column.value))
            });
        },


        unSelectAll() {
            let columns = document.querySelectorAll('.rowCheckbox');
            columns.forEach(column => {
                column.checked = false
            });
            this.selectedRows = [];
        }
    }
}
