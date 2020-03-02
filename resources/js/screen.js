class DSScreen {
    constructor() {
        this.moving = false
        this.touchStartY = null

        // stasis body
        document.body.style.overflow = 'hidden'
        document.body.style.height = '100vh'

        // wrapper
        this.screenWrapper = document.querySelector('.screen-wrapper')
        this.screenWrapper.style.transition = 'margin-top .5s ease-in'

        // find all screen sections
        this.currentScreen = 1
        this.screens = document.querySelectorAll('section.screen')
        console.log(this.screens)

        // scroll controll
        document.addEventListener("wheel", this.wheelHandler.bind(this), {passive: false})
        document.addEventListener("touchstart", this.touchStartHandler.bind(this), {passive: false})
        document.addEventListener("touchmove", this.touchMoveHandler.bind(this), {passive: false})
        document.addEventListener("touchend", this.touchEndHandler.bind(this), {passive: false})
    }
    touchStartHandler(e) {
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
    updateScreen() {
        this.moving = true
        setTimeout((function(){
            this.moving = false
        }).bind(this), 500)
        const marginTop = (this.currentScreen - 1) * -100
        this.screenWrapper.style.marginTop = marginTop + 'vh'
    }
}

document.addEventListener("DOMContentLoaded", function(){
    window.DSSC = new DSScreen();
});
