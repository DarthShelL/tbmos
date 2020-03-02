class DSScreen {
    constructor() {
        // find all screen sections
        this.screens = document.querySelectorAll('section.screen')
        console.log(this.screens)
    }
}

document.addEventListener("DOMContentLoaded", function(){
    const screen = new DSScreen();
});
