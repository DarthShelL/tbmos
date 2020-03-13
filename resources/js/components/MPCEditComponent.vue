<template>
    <div class="editor-wrapper">
        <div class="edit-container">
            <div class="slider-preview">
                <div v-if="loading" class="sc-wrapper">
                    <div class="image" ref="imagePreview">
                        <div ref="sliderCaption" class="caption"></div>
                        <div class="button">ZJISTIT VÍCE</div>
                    </div>
                </div>
                <div v-else class="sc-wrapper">
                    <div class="image" ref="imagePreview" v-bind:style="{ backgroundImage: 'url(' + mpc.slider_image + ')' }">
                        <div ref="sliderCaption" class="caption">{{mpc.title}}</div>
                        <div class="button">ZJISTIT VÍCE</div>
                    </div>
                </div>
            </div>
            <div class="slider-params">
                <div class="container">
                    <div class="row card">
                        <h2 class="card-header">Slider component editor</h2>
                        <div class="row card-body">
                            <div class="col-3">
                                <div class="">
                                    <input type="file" name="slider_image" style="display:none;" ref="sliderImageInput" @change="sliderImageChange">
                                    <button class="btn btn-primary form-control" @click="$refs.sliderImageInput.click()">pick slider image</button>
                                </div>
                                <br>
                                <div class="">
                                    <input type="file" name="screen_image" style="display:none;" ref="screenImageInput" @change="screenImageChange">
                                    <button class="btn btn-primary form-control" @click="$refs.screenImageInput.click()">pick screen image</button>
                                </div>
                                <br>
                                <div class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">BG color</div>
                                        </div>
                                        <input type="text" name="slider_caption_color" placeholder="#456789" class="form-control" @change="sliderCaptionChange" ref="captionColorInput">
                                    </div>
                                </div>
                                <br>
                                <div class="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Font color</div>
                                        </div>
                                        <input type="text" name="font_color" placeholder="#ffffff" class="form-control" @change="screenFontColorChange" ref="fontColorInput">
                                    </div>
                                </div>
                                <br>
                                <div class="">
                                    <button class="btn btn-success form-control" @click="saveComponent">Save</button>
                                </div>
                            </div>
                            <div class="col-9">
                                <div v-if="loading">
                                    <label>Title</label>
                                    <input class="form-control" type="text" name="title" ref="titleInput" @change="titleChange">
                                    <label>Description</label>
                                    <textarea class="form-control" ref="descriptionInput" rows="7" @change="descriptionChange"></textarea>
                                </div>
                                <div v-else class="">
                                    <label>Title</label>
                                    <input class="form-control" type="text" name="title" ref="titleInput" @change="titleChange" :value="mpc.title">
                                    <label>Description</label>
                                    <textarea class="form-control" ref="descriptionInput" rows="7" @change="descriptionChange">{{mpc.description}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container screen-wrapper">
            <div class="page-preview">
                <div v-if="loading" class="screen-title" ref="screenTitle"></div>
                <div v-if="loading" class="screen-preview" ref="screenPreview"></div>

                <div v-if="!loading" class="screen-title" ref="screenTitle">
                    {{mpc.title}}
                </div>
                <div v-if="!loading" class="screen-preview" ref="screenPreview" v-bind:style="{ backgroundImage: 'url(' + mpc.screen_image + ')' }">
                    <p>{{mpc.description}}</p>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" ref="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Oooops!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" ref="errorModalBody">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" ref="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lovely success message!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" ref="successModalBody">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mpc: {},
        props: ['id'],
        mounted() {
            if (this.id) {
                this.read()
            }
        },
        methods: {
            saveComponent(e) {
                const self = this;
                const fd = new FormData();

                if (this.id) {
                    fd.set('method', 'updateMPC')
                    fd.set('id', this.id)
                } else {
                    fd.set('method', 'createMPC')
                }
                fd.set('title', this.$refs.sliderCaption.innerText.trim())
                fd.set('description', this.$refs.screenPreview.innerText.trim())
                if (this.$refs.sliderImageInput.files.length > 0) {
                    fd.append('slider_image', this.$refs.sliderImageInput.files[0])
                }
                if (this.$refs.screenImageInput.files.length) {
                    fd.append('screen_image', this.$refs.screenImageInput.files[0])
                }
                fd.set('caption_color', this.$refs.captionColorInput.value.trim() === '' ? '#456789' : this.$refs.captionColorInput.value)
                fd.set('font_color', this.$refs.fontColorInput.value.trim() === '' ? '#ffffff' : this.$refs.fontColorInput.value)

                axios({
                    method: 'post',
                    url: '/api/mpc',
                    data: fd,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                .then(function (response) {
                    //handle success
                    const answer = response.data

                    if (answer.error === true) {
                        let msg = '';
                        for (const err in answer.msg) {
                            for (const e of answer.msg[err]) {
                                msg += `[${err}]: ${e}<br>`;
                            }
                        }

                        self.$refs.errorModalBody.innerHTML = `<p class="alert alert-danger">${msg}</p>`
                        $(self.$refs.errorModal).modal('toggle')
                    } else {
                        self.$refs.successModalBody.innerHTML = `<p class="alert alert-success">Saved!</p>`
                        $(self.$refs.successModal).modal('toggle')
                        this.id = answer.data.id
                        this.read()
                    }
                })
                .catch(function (response) {
                    //handle error
                    console.log(response)
                })
            },
            descriptionChange(e) {
                const input = e.target
                this.$refs.screenPreview.innerText = input.value
            },
            titleChange(e) {
                const input = e.target
                this.$refs.sliderCaption.innerText = input.value
                this.$refs.screenTitle.innerText = input.value
            },
            sliderCaptionChange(e) {
                const input = e.target
                this.$refs.sliderCaption.style.backgroundColor = input.value
            },
            screenFontColorChange(e) {
                const input = e.target
                this.$refs.screenPreview.style.color = input.value
            },
            sliderImageChange(e) {
                const self = this
                let file = e.target.files[0]
                let reader = new FileReader()

                reader.readAsDataURL(file)

                reader.onload = function() {
                    self.$refs.imagePreview.style.backgroundImage = `url("${reader.result}")`
                }
            },
            screenImageChange(e) {
                const self = this
                let file = e.target.files[0]
                let reader = new FileReader()

                reader.readAsDataURL(file)

                reader.onload = function() {
                    self.$refs.screenPreview.style.backgroundImage = `url("${reader.result}")`
                }
            },
            read() {
                axios.post('/api/mpc', {method:'getMPC', id:this.id}).then((response) => {
                    this.mpc = response.data.data
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
    display: block;
}
.edit-container {
    display: flex;
    align-content: space-between;
}
/* .slider-preview {} */
.slider-params {
    flex: 2;
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
.screen-wrapper {
    height: 50vh;
    background-color: gray;
    position: relative;
    margin: 15px 0;
    box-shadow: inset 0px 0px 4px #000;
}
.page-preview {
    height: 100%;
    width: 80%;
    background-color: #fff;
    margin: 0 auto;
    overflow: hidden;
    border-top: 1px solid #adb5bd;
    border-bottom: 1px solid #adb5bd;
    display: flex;
    align-items: center;
    position: relative;
}
.screen-preview {
    position: absolute;
    background-size: cover;
    background-color: rgba(14, 41, 60, 0.521569);
    width: 80%;
    height: 70%;
    left: 10%;
    top: 20%;
    box-shadow: 0px 2px 50px rgba(14, 41, 60, 0.168627);
    font-family: Hind;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 20px;
    color: #ffffff;
    padding: 15px;
    text-shadow: 0px 0px 5px #000;
}
.screen-preview > p {
    background-color: #1122339c;
    display: block;
    width: fit-content;
    padding: 5px 10px;
}
.screen-title {
    position: absolute;
    left: 12%;
    top: 5%;
    font-family: Hind;
    font-style: normal;
    font-weight: bold;
    font-size: 28px;
    line-height: 77px;
    color: #0E293C;
}
</style>
