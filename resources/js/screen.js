class DSScreen {
    constructor() {
        this.moving = false
        this.touchStartY = null
        this.appDiv = document.getElementById('app')

        // stasis body
        document.body.style.overflow = 'hidden'
        document.body.style.height = '100vh'

        // wrapper
        this.screenWrapper = document.querySelector('.screen-wrapper')
        this.screenWrapper.style.transition = 'margin-top .5s ease-in-out'

        // find all screen sections
        this.currentScreen = 1
        this.screens = document.querySelectorAll('section.screen')

        // scroll controll
        document.addEventListener("wheel", this.wheelHandler.bind(this), {passive: false})
        document.addEventListener("touchstart", this.touchStartHandler.bind(this), {passive: false})
        document.addEventListener("touchmove", this.touchMoveHandler.bind(this), {passive: false})
        document.addEventListener("touchend", this.touchEndHandler.bind(this), {passive: false})

        this.updateScreen()
    }
    touchStartHandler(e) {
        if (e.target.classList.contains('navbar-toggler-icon'))
            return
        if (e.target.classList.contains('button'))
            return
        if (e.target.classList.contains('slider-arrow-left'))
            return
        if (e.target.classList.contains('slider-arrow-right'))
            return
        if (e.target.classList.contains('totop-btn'))
            return

        e.preventDefault()
        this.touchStartY = e.changedTouches[0].screenY
    }
    touchMoveHandler(e) {
        e.preventDefault()
        if (!this.touchStartY)
            return
        const currentTouchY = e.changedTouches[0].screenY
        if (currentTouchY > this.touchStartY) {
            this.swipeDirection = -1
        } else {
            this.swipeDirection = 1
        }
    }
    touchEndHandler(e) {
        if (e.target.classList.contains('navbar-toggler-icon'))
            return
        if (e.target.classList.contains('button'))
            return
        if (e.target.classList.contains('slider-arrow-left'))
            return
        if (e.target.classList.contains('slider-arrow-right'))
            return
        if (e.target.classList.contains('totop-btn'))
            return
        e.preventDefault()
        if (!this.swipeDirection)
            return

        if (this.swipeDirection > 0) {
            this.nextScreen()
        } else {
            this.prevScreen()
        }

        this.touchStartY = null
        this.swipeDirection = null
    }
    wheelHandler(e) {
        e.preventDefault()
        if (this.moving)
            return
        if (e.deltaY > 0) {
            this.nextScreen()
        } else {
            this.prevScreen()
        }
    }
    nextScreen() {
        const maxScreens = this.screens.length
        if (this.currentScreen < maxScreens) {
            this.currentScreen++
            this.updateScreen()
        }
    }
    prevScreen() {
        const maxScreens = this.screens.length
        if (this.currentScreen > 1) {
            this.currentScreen--
            this.updateScreen()
        }
    }
    goto(screen) {
        this.currentScreen = screen
        this.updateScreen()
    }
    updateScreen() {
        if (this.moving)
            return
        this.moving = true
        setTimeout((function(){
            this.moving = false
        }).bind(this), 500)
        const marginTop = (this.currentScreen - 1) * -100
        this.screenWrapper.style.marginTop = marginTop + 'vh'
        this.appDiv.style.backgroundPositionY = (marginTop/4) + 'vh'
    }
}

document.addEventListener("click", function(e) {
    if (e.target.classList.contains('totop-btn')) {
        DSSC.goto(1);
    }
})
document.addEventListener("DOMContentLoaded", function(){
    window.DSSC = new DSScreen()
    console.log('DOMContentLoaded')
    setTimeout(function() {
        if (window.DSSC.currentScreen == 1) {
            document.querySelector('html').scrollTo(0, 0)
        }
    },500)
});
