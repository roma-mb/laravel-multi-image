<template>
    <div class="container">
        <div class="row justify-content-center mb-3" ref="imageUpload">
            <div class="col-12  bg-dark text-white rounded py-3 text-center">DROP IMAGE(S) HERE</div>
        </div>
    </div>
</template>

<script>
    import Dropzone from 'dropzone';

    export default {
        data: function() {
          return {
              dropzone: null
          }
        },
        mounted() {
            this.dropzone = new Dropzone(this.$refs.imageUpload, {
                url: '/api/images',
                uploadMultiple: true,
                parallelUploads: 10,
                init: function() {
                    this.on("queuecomplete", function (file) {
                        location.reload();
                    });
                }
            });
        }
    }
</script>
