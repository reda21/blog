<template>
    <div class="pagination-footer">
        <div class="pagination-item">
            <small>Showing {{pagination.current_page}} - {{totalPages}} of {{total}}</small>
        </div>
        <div class="pagination-item">
            <small>Current page:</small>
            <input :disabled="totalPages == 1" v-model.number.lazy="pageInput" min="1" :max="totalPages"
                   type="number" class="pagination-input">
            <small> of {{totalPages}}</small>
        </div>
        <div class="pagination-item pagination-right">
            <button @click="previous()" class="btn btn-outline-secondary btn-sm">Précédent</button>
            <button @click="next()" class="btn btn-outline-secondary btn-sm">Suivant</button>
        </div>
    </div>
</template>

<style scoped>
    .pagination-footer {
        display: -webkit-box;
        display: flex;
        -webkit-box-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        align-items: center;
    }

</style>

<script type="text/ecmascript">
    import floor from "lodash/floor"
    import divide from "lodash/divide"

    export default {
        props: {
            pagination: {
                type: Object,
                required: true
            },
            list: {
                type: Array,
                required: true
            },
            callback: {
                type: Function,
                required: true
            },

        },
        computed: {
            total() {
                return this.list.length;
            },
            totalPages() {
                if (this.total > this.pagination.per_page) {
                    let page = floor(divide(this.total, this.pagination.per_page));
                    console.log({page});
                    return this.total == page * this.pagination.per_page ? page : page + 1;
                }
                this.pagination.current_page = 1;
                return 1;
            },
            config() {
                return Object.assign({
                    offset: 3,
                    ariaPrevious: 'Previous',
                    ariaNext: 'Next',
                    previousText: '«',
                    nextText: '»',
                    alwaysShowPrevNext: false
                }, this.options);
            },
            pageInput: {
                get: function () {
                    return this.pagination.current_page
                },
                // setter
                set: function (newValue) {
                    if (typeof newValue == "number" && newValue >= 1 && newValue <= this.totalPages) {
                        this.pagination.current_page = newValue;
                    }
                }
            },
        },

        methods: {
            previous() {
                if (this.pagination.current_page > 1) {
                    this.pagination.current_page = this.pagination.current_page - 1;
                } else {
                    this.pagination.current_page = 1;
                }
            },

            next() {
                if (this.pagination.current_page < this.totalPages) {
                    this.pagination.current_page = this.pagination.current_page + 1;
                } else {
                    this.pagination.current_page = this.totalPages
                }
            },
        }
    }
</script>
