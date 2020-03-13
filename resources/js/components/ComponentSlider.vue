<template>
    <div v-if="!loading" class="slider-wrapper" ref="sliderWrapper">
        <div v-if="slider" class="slider-arrow-left" ref="leftArrow"></div>
        <div v-if="slider" class="slider-arrow-right" ref="rightArrow"></div>
        <div class="slider-inner" ref="sliderInner">
            <div v-for="mpc in mpcs" class="sc-wrapper">
                <div class="image" v-bind:style="{ backgroundImage: 'url(' + mpc.slider_image + ')' }">
                    <div class="caption" v-bind:style="{ backgroundColor: mpc.caption_color }">{{mpc.title}}</div>
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
        window.addEventListener('resize', (function() {
            if (this.loading)
                return
            this.calculateDimension()
        }).bind(this))
    },
    data() {
        return {
            mpcs: null,
            loading: true,
            slider: false,
            ratio: 1.8,
            maxSteps: null,
            currentStep: 0,
            stepSize: null
        }
    },
    methods: {
        calculateDimension() {
            //get content width and height
            const wrapperWidth = parseInt(getComputedStyle(this.$refs.sliderWrapper, null).width)
            const wrapperHeight = parseInt(getComputedStyle(this.$refs.sliderWrapper, null).height)
            const innerHeight = parseInt(getComputedStyle(this.$refs.sliderInner, null).height)

            //calculate component width and height
            const componentHeight = innerHeight
            const imageWidth = Math.floor(componentHeight/this.ratio)
            const margin = 50

            //set component dimensions
            const components = this.$refs.sliderWrapper.querySelectorAll('div.sc-wrapper')

            //calc number of displaying components
            let displayingNumber = Math.floor(wrapperWidth/(imageWidth + margin))
            if (displayingNumber >= components.length) {
                displayingNumber = components.length
                this.disableSlider()
            } else {
                this.maxSteps = components.length - displayingNumber
                this.currentStep = 0
                this.stepSize = Math.round(wrapperWidth/displayingNumber)
                this.enableSlider()
            }

            //calc dimensions from components number
            const componentWidth = Math.round(wrapperWidth/displayingNumber)

            //set slider inner width
            const innerCalculatedWidth = componentWidth * components.length
            this.$refs.sliderInner.style.width = innerCalculatedWidth + 'px'

            for (let i=0; i < components.length; i++) {
                components[i].style.width = componentWidth + 'px'
                const image = components[i].querySelector('.image')
                image.style.width = imageWidth + 'px'
                image.style.height = componentHeight + 'px'
                const btn = image.querySelector('.button');
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
        },
        enableSlider() {
            this.slider = true
            this.setSliderActions()
        },
        disableSlider() {
            this.unsetSliderActions()
        },
        setSliderActions() {
            this.$nextTick(function() {
                const la = this.$refs.leftArrow
                const ra = this.$refs.rightArrow

                la.addEventListener('click', (this.prevSlide).bind(this))
                ra.addEventListener('click', (this.nextSlide).bind(this))
            })
        },
        unsetSliderActions() {
            if (this.slider == false)
                return

            this.currentStep = 0
            this.updateSlide()

            const la = this.$refs.leftArrow
            const ra = this.$refs.rightArrow

            la.removeEventListener('click', (this.prevSlide).bind(this))
            ra.removeEventListener('click', (this.nextSlide).bind(this))
            this.slider = false
        },
        nextSlide() {
            console.log('right')
            if (this.currentStep < this.maxSteps) {
                this.currentStep++
                this.updateSlide()
            }
        },
        prevSlide() {
            console.log('left')
            if (this.currentStep > 0) {
                this.currentStep--
                this.updateSlide()
            }
        },
        updateSlide() {
            console.table(this.currentStep, this.stepSize, this.maxSteps)
            this.$refs.sliderInner.style.marginLeft = (-(this.currentStep * this.stepSize)) + 'px'
        }
    }
}
</script>

<style scoped>
.slider-wrapper {
    height: 50vh;
    overflow: hidden;
    position: relative;
}
.slider-inner {
    margin: 5vh 0;
    height: 40vh;
    transition: margin-left .5s ease-in-out;
}
.slider-inner::after {
    content: "";
    display: block;
    clear: both;
}
.sc-wrapper {
    float: left;
}
.image {
    position: relative;
    width: 222px;
    height: 413px;
    background-size: cover;
    box-shadow: 0px 2px 25px rgba(14, 41, 60, 0.521569);
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
    font-size: 100%;
    line-height: 1.5em;
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
.slider-arrow-left {
    position: absolute;
    width: 50px;
    height: 100%;
    background-image: url("/slider-arrow-left.svg");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    cursor: pointer;
    z-index: 9999;
}
.slider-arrow-right {
    position: absolute;
    width: 50px;
    height: 100%;
    right: 0;
    background-image: url("/slider-arrow-right.svg");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    cursor: pointer;
    z-index: 9999;
}
.svg-bg {
    width: inherit;
    height: inherit;
}
</style>
