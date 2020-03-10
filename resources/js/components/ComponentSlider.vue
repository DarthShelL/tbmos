<template>
    <div v-if="!loading" class="slider-wrapper" ref="sliderWrapper">
        <div class="slider-inner">
            <div v-for="mpc in mpcs" class="sc-wrapper">
                <div class="image" v-bind:style="{ backgroundImage: 'url(' + mpc.slider_image + ')' }">
                    <div class="caption">{{mpc.title}}</div>
                    <div class="button">ZJISTIT VÍCE</div>
                </div>
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
            loading: true,
            ratio: 1.8
        }
    },
    methods: {
        calculateDimension() {
            //get content width and height
            const wrapperWidth = parseInt(getComputedStyle(this.$refs.sliderWrapper, null).width)
            const wrapperHeight = parseInt(getComputedStyle(this.$refs.sliderWrapper, null).height)

            //calculate component width and height
            const componentHeight = wrapperHeight
            const componentWidth = Math.round(componentHeight/this.ratio)

            //set component dimensions
            const componentImages = this.$refs.sliderWrapper.querySelectorAll('div.image')

            for (let i=0; i < componentImages.length; i++) {
                componentImages[i].style.width = componentWidth + 'px'
                componentImages[i].style.height = componentHeight + 'px'
                const btn = componentImages[i].querySelector('.button');
                btn.style.lineHeight = (parseInt(getComputedStyle(btn, null).height) - 6) + 'px'
                btn.addEventListener('click', function(e){
                    window.DSSC.goto(i+2)
                })
            }
        },
        read() {
            const self = this
            axios.post('/api/mpc', {method:'getMPCs'}).then((response) => {
                this.mpcs = response.data.data
            })
            .catch(err => console.error(err))
            .finally(() => {
                self.loading = false
                self.$nextTick(function(){
                    self.calculateDimension()
                })
            })
        }
    }
}
</script>

<style scoped>
.slider-wrapper {
    height: 40vh;
    margin: 5vh 0;
    /* overflow: hidden; */
}
.slider-inner {
    display: flex;
}
/* .slider-inner::after {
    content: "";
    display: block;
    clear: both;
} */
.sc-wrapper {
    /* float: left; */
    flex: auto;
}
.image {
    position: relative;
    width: 222px;
    height: 413px;
    background-size: cover;
    box-shadow: 0px 2px 50px rgba(14, 41, 60, 0.521569);
    /* margin-right: 2em; */
    margin: 0 auto;
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
    font-size: 80%;
    line-height: 180%;
    align-items: center;
    text-align: center;
    color: #FFFFFF;
    cursor: pointer;
}
.button:hover {
    background: linear-gradient(165.21deg, #00E1C6 0%, #19BBD5 100%);
}
</style>
