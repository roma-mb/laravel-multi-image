<template>
    <div class="container">
        <div class="p-2 w-full">
            <div class="relative">
                <label for="attachment" class="leading-7 text-sm text-gray-600">
                    Attachments
                </label>
                <br />
                <vue-dropzone
                    ref="myVueDropzone"
                    id="dropzone"
                    :options="dropzoneOptions"
                    @vdropzone-complete="afterUploadComplete"
                />
            </div>
        </div>
    </div>
</template>

<script>

import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    name: "ExampleDropzone",
    data() {
        return {
            dropzoneOptions: {
                url: '/api/images',
                thumbnailWidth: 150,
                maxFilesize: 2,
                headers: { "My-Awesome-Header": "header value" },
                parallelUploads: 3,
                maxFiles: 3,
                uploadMultiple:true
            }
        }
    },
    components: {
        vueDropzone: vue2Dropzone
    },
    methods: {
        afterUploadComplete:async function(response) {
            if (response.status == 'success') {
                location.reload();
            }
        }
    }
}
</script>

<style scoped>

</style>
