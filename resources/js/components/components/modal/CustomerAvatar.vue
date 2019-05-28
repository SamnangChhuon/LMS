<template>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="form-horizontal">
                <div class="modal-header">
                    <h4 class="modal-title">Customer Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <label for="avatar">
                            <img :src="previewAvatar()"  class="img-circle w-100" />
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="file" @change="updateProfile">
                    </div>
                </div>
                <div class="modal-footer d-block">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
                    <button type="button" class="btn btn-success fa-pull-right" @click.prevent="updateInfo">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formAvatar: new Form({
                photo: ''
            })
        }
    },
    methods: {
        previewAvatar() {
            let photo = (this.formAvatar.photo.length > 200) ? this.formAvatar.photo : "/img/user/avatar.png" ;
            return photo;
        },
        updateProfile(e) {
            // console.log('uploading');
            let file = e.target.files[0];
            // console.log(file);
            let reader = new FileReader();

            if (file['size'] < 2111775 ) {
                reader.onloadend = (file) => {
                    // console.log('RESULT', reader.result);
                    this.formAvatar.photo = reader.result;
                }
                reader.readAsDataURL(file);
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: "You are uploading a large file!",
                })
            }
        },
        updateInfo() {
            this.$Progress.start();
            this.formAvatar.put('/api/customerAvatar')
            .then(() => {
                $('#avatarCustomer').modal('show');
                this.$Progress.finish();
            })
            .catch(() => {
                this.$Progress.fail();
            });
        },
    }
}
</script>