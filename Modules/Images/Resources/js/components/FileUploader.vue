<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Uploader</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                            <div class="col-md-6">
                                <input id="image" type="file" name="image" ref="image" accept="image/x-png" @change="handleImageToUpload()">
                            </div>
                            <div class="col-md-12 error-message">
                                {{ errorMessage }}
                            </div>
                            <div v-if="returnedUrls.length > 0" v-for="url in returnedUrls" class="col-md-12 error-message">
                               <img :src="url">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" @click="submitFile()" class="btn btn-primary">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { UploadManager } from "../managers/UploadManager";

export default {

    data: () => ({
        image: null,
        errorMessage: null,
        acceptableExtensions: ['image/png',],
        returnedUrls: []
    }),

    created: function() {
        this.uploadManager = new UploadManager();

        this.showUploadedImages();
    },

    methods: {
        showUploadedImages() {
            this.uploadManager.getAllUploadedImages()
            .then((response) => {
                if (response.data !== false) {
                    console.log('Uploaded!!');
                    this.returnedUrls = response.data.storedUrls;
                }
            })
        },
        handleImageToUpload() {
            let image = this.$refs.image.files[0];

            if (!this.isAcceptableImage(image)) {
                this.errorMessage = 'Just only png'
                return;
            }

            this.errorMessage = null;
            this.image = image;
        },
        submitFile() {
            if (!this.isAcceptableImage(this.image)) {
                return;
            }

            let form = new FormData();
            form.append('image', this.image);

            this.uploadManager.uploadFile(form)
            .then((response) => {
                if (response.data !== false) {
                    this.returnedUrls.unshift(response.data.returnedUrl);
                }
            })
            .catch(() => {
                console.log('FAILURE!!');
            });
        },

        isAcceptableImage(image) {
            let emptyImage = (image === null || typeof image === 'undefined');
            return !emptyImage && this.acceptableExtensions.includes(image.type);
        }
    },
}
</script>

<style>
    .error-message {
        color: red;
        font-weight: bold;
        font-size: 20px;
    }
</style>
