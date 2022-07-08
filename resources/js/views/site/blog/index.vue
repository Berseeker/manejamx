<template>
    <section class="gray-bg">
        <div v-if="!loading" class="container">
            <div class="row equal">
                <div v-for="post in posts" :key="post.id" class="col-md-4 col-sm-6  ">
                    <div class="blog-box blog-grid-box" >
                        <div class="blog-grid-box-img">
                            <a :href="'/blog/'+post.id+'/'+post.slug">
                                <img :src="post.file ? post.file.show_url:'#'" class="img-responsive" alt="">
                            </a>
                        </div>
                        <div class="blog-grid-box-content">
                            <h4 class="title"><a :href="'/blog/'+post.id+'/'+post.slug">{{ post.title }}</a></h4>
                            <div v-html="post.short_content"></div>
                            <a :href="'/blog/'+post.id+'/'+post.slug" class="read-more" title="Read More..">Leer más...</a>
                        </div>
                    </div>
                </div>
            </div>
            <paginator :pagination="pagination" @changePage="index"></paginator>
        </div>
    </section>
</template>

<script>

import Post from '../../../models/site/blog/Post';
import Paginator from "../../../components/PaginatorSite";

export default {
    components:{Paginator},
    props:['category_id'],
    data(){
        return {
            loading: true,
            posts:[],
            pagination: {},
        }
    },

    created(){
        this.index();
    },

    methods:{
        index(page = 1){

            let parameters = {
                page:page,
                category_id : this.category_id
            };

            Post.get(parameters, data => {
                this.posts      = data.data;
                this.pagination = data.meta;
                this.loading    = false;
            });
        },


    },

}
</script>
<style>
@media (min-width: 768px) {
  .row.equal {
    display: flex;
    flex-wrap: wrap;
  }
}
</style>
