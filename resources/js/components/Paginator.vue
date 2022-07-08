<template>
    <div class="row mt-5">
        <div class="col-md-12 d-flex justify-content-center">

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"
                        v-if="pagination.current_page > 1"
                        @click.prevent="changePage(pagination.current_page - 1)"
                    >
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Anterior</span>
                        </a>
                    </li>

                    <li class="page-item"
                        v-if="pagination.last_page > 1 && isVisible(index + 1)"
                        :class="isActive(index + 1) ? 'active' : ''"
                        @click.prevent="changePage(index + 1)"
                        v-for="(n, index) in pagination.last_page">
                        <a class="page-link" href="#">{{ index + 1 }}</a>
                    </li>

                    <li class="page-item"
                        v-if="pagination.current_page < pagination.last_page"
                        @click.prevent="changePage(pagination.current_page + 1)"
                    >
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </li>
                </ul>
            </nav>


        </div>
    </div>
</template>

<script>
    export default{
        props: ['pagination'],

        methods: {
            changePage(page) {
                this.$emit('changePage', page);
            },

            isActive(page) {
                return this.pagination.current_page == page;
            },

            isVisible(page) {
                if(this.isActive(page) || page == 1 || page == this.pagination.last_page) {
                    return true;
                }

                if(this.isPrevious(page, 1) || this.isPrevious(page, 2) || this.isPrevious(page, 3)) {
                    return true;
                }

                if(this.isNext(page, 1) || this.isNext(page, 2) || this.isNext(page, 3)) {
                    return true;
                }

                return false;
            },

            isPrevious(page, diff) {
                return page == parseInt(this.pagination.current_page) - parseInt(diff);
            },

            isNext(page, diff) {
                return page == parseInt(this.pagination.current_page) + parseInt(diff);
            }
        }
    }
</script>
