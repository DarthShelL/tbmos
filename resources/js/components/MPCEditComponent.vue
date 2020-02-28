<template>
    <div class="edit-container">
        <div class="slider-preview">
            <div v-if="loading">loading...</div>
            <div v-else class="sc-wrapper">
                <div class="image" v-bind:style="{ backgroundImage: 'url(' + mpc.screen_image + ')' }">
                    <div class="caption">{{mpc.title}}</div>
                    <div class="button">go</div>
                </div>
            </div>
        </div>
        <div class="slider-params">
            <div class="container">
                <div class="row">
                    <input type="file" name="slider_image" style="display:none;" ref="sliderImageInput" @change="sliderImageChange">
                    <button class="btn btn-primary col-12" @click="$refs.sliderImageInput.click()">pick slider image</button>
                </div>
                <br>
                <div class="row">
                    <input type="text" name="slider_caption_color" placeholder="#456789" class="form-control col-12">
                </div>
                <br>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mpc: {},
        props: ['id'],
        mounted() {
            this.read()
        },
        methods: {
            sliderImageChange() {
                console.log('slider image changed');
            },
            read() {
                console.log(this.id);
                axios.post('/api/mpc', {method:'getMPC', id:this.id}).then((response) => {
                    this.mpc = response.data
                })
                .catch(err => console.error(err))
                .finally(() => (this.loading = false))
            }
        },
        data() {
            return {
                mpc: null,
                loading: true
            }
        }
    }
</script>

<style scoped>
.sc-wrapper {
}
.edit-container {
    display: flex;
}
.slider-preview {
    padding: 5px;
}
.slider-params {
    padding: 5px;
}
.image {
    position: relative;
    width: 194px;
    height: 354px;
    background-size: cover;
    box-shadow: 0px 2px 50px rgba(14, 41, 60, 0.521569);
    margin-right: 2em;
}
.caption {
    position: absolute;
    height: 25%;
    background-color: #456789;
    width: 100%;
    left: 10%;
    bottom: 35%;

    color: white;
    font-family: Hind;
    font-style: normal;
    font-weight: 500;
    font-size: 22px;
    line-height: 32px;
    padding: 12px;
}
.button {

}
</style>
