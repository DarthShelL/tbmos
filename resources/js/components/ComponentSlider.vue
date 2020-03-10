<template>
    <div v-if="!loading" class="slider-wrapper" ref="sliderWrapper">
        <div v-for="mpc in mpcs" class="sc-wrapper">
            <div class="image" ref="imagePreview" v-bind:style="{ backgroundImage: 'url(' + mpc.slider_image + ')' }">
                <div ref="sliderCaption" class="caption">{{mpc.title}}</div>
                <div class="button">ZJISTIT VÍCE</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.read()
    },
    data() {
        return {
            mpcs: null,
            loading: true
        }
    },
    methods: {
        calculateDimension() {

        },
        read() {
            axios.post('/api/mpc', {method:'getMPCs'}).then((response) => {
                this.mpcs = response.data.data
                this.calculateDimension()
            })
            .catch(err => console.error(err))
            .finally(() => (this.loading = false))
        }
    }
}
</script>

<style scoped>
.slider-wrapper {
    height: 40vh;
    margin: 5vh 0;
}
.sc-wrapper {
    width: fit-content;
}
.image {
    position: relative;
    width: 222px;
    height: 413px;
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
    position: absolute;
    bottom: 19%;
    border: 3px solid #00E1C6;
    height: 10%;
    width: 60%;
    left: 20%;
    font-family: Hind;
    font-style: normal;
    font-weight: 600;
    font-size: 18px;
    line-height: 37px;
    align-items: center;
    text-align: center;
    color: #FFFFFF;
    cursor: pointer;
}
.button:hover {
    background: linear-gradient(165.21deg, #00E1C6 0%, #19BBD5 100%);
}
</style>
