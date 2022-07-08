<template>
    <div class="container-fluid">
        <!-- <agile class="main" ref="main" :options="options1">
            <div class="slide">
                <img :src="current_photo">
            </div>
        </agile> -->
        <agile class="thumbnails" ref="thumbnails" :options="options2" :as-nav-for="[$refs.main]">
            <div class="slide slide--thumbniail" v-for="(item, i) in media" :key="i"
                 :class="'photo_' + i" @click="current_photo = item.show_url">
                <img :src="item.show_url" @click="index = i">
            </div>
        </agile>
        <vue-gallery-slideshow :images="media" :index="index" @close="index = null"></vue-gallery-slideshow>
    </div>
</template>

<script>
    import { VueAgile } from 'vue-agile';
    import VueGallerySlideshow from 'vue-gallery-slideshow';

    export default {
        components:{agile: VueAgile, VueGallerySlideshow},
        props:['media', 'open'],
        data(){
            return {
                current_photo:{},
                asNavFor1: [],
                asNavFor2: [],
                options1: {
                    dots: false,
                    fade: true,
                    navButtons: false
                },
                options2: {
                    autoplay: false,
                    centerMode: true,
                    dots: false,
                    navButtons: true,
                    slidesToShow: 3,
                    responsive: [
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 3
                            }
                        },

                        {
                            breakpoint: 1000,
                            settings: {
                                navButtons: true
                            }
                        }
                    ]

                },
                index:null
            }
        },
        /* mounted () {
            this.asNavFor1.push(this.$refs.thumbnails)
            this.asNavFor2.push(this.$refs.main)
        }, */
        created(){
            if(this.media.length > 0) {
                this.current_photo = this.media[0].MediaURL;
            }
        },

        watch:{
            open(){
                if(this.open){
                    this.index=0;
                    this.$parent.open = false;
                }
            }
        }

    }
</script>


<style>

    .main {
        margin-bottom: 4px !important;
    }

    .thumbnails {
        margin: 0 -2px !important;
        width: calc(100% + 4px) !important;
    
    }

    .agile__nav-button {
        background: white;
        border: none;
        border-radius: 50%;
        width: 58px;
        height: 58px;
        color: #00aed9;
        cursor: pointer;
        font-size: 24px;
        transition-duration: 0.3s;
        box-shadow: rgba(25, 41, 61, 0.18) 0px 1px 3px 0px;
    }

    .thumbnails .agile__nav-button--prev {
        left: 1px !important;
    }

    .thumbnails .agile__nav-button--next {
        right: 1px !important;
    }

    .thumbnails .agile__nav-button {
        position: absolute;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .agile__nav-button:hover {
        color: #888;
    }
    .agile__dot {
        margin: 0 10px;
    }
    .agile__dot button {
        background-color: #eee;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: block;
        height: 10px;
        font-size: 0;
        line-height: 0;
        margin: 0;
        padding: 0;
        transition-duration: 0.3s;
        width: 10px;
    }
    .agile__dot--current button, .agile__dot:hover button {
        background-color: #888;
    }

    .slide {
        align-items: center;
        box-sizing: border-box;
        color: #fff;
        display: flex;
        /* height: 450px; */
        justify-content: center;
    }
    .slide--thumbniail {
       
        cursor: pointer;
        /* height: 254px; */
        padding: 0 10px;
        transition: opacity 0.3s;
    }
    .slide--thumbniail:hover {
        opacity: 0.75;
    }
    .slide img {
        /* height: 254px; */
        border-radius: 3px;
        -o-object-fit: cover;
        object-fit: cover;
        -o-object-position: center;
        object-position: center;
        width: 100%;
    }


</style>
