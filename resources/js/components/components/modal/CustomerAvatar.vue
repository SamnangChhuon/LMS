<template>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Customer Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center" v-show="!edit">
                    <label for="avatar">
                        <img :src="files.length ? files[0].url : '/img/user/avatar.png'"  class="rounded-circle" />
                        <h4 class="pt-2">or<br/>Drop files anywhere to upload</h4>
                        <file-upload
                        extensions="gif,jpg,jpeg,png,webp"
                        accept="image/png,image/gif,image/jpeg,image/webp"
                        name="avatar"
                        class="btn btn-primary"
                        :drop="!edit"
                        v-model="files"
                        @input-filter="inputFilter"
                        @input-file="inputFile"
                        ref="upload">
                        Upload avatar
                        </file-upload>
                    </label>
                </div>
                <div class="avatar-edit" v-show="files.length && edit">
                    <div class="avatar-edit-image" v-if="files.length">
                        <img ref="editImage" :src="files[0].url" />
                    </div>
                    <div class="text-center p-4">
                        <button type="button" class="btn btn-secondary" @click.prevent="$refs.upload.clear">Cancel</button>
                        <button type="submit" class="btn btn-primary" @click.prevent="editSave">Save</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal" aria-label="Close" @click="clear">Close</button>
                <button type="button" class="btn btn-success" @click="updateAvatar">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            files: [],
            edit: false,
            cropper: false,
            customerForm: new Form({
                photo:''
            })
        }
    },
    watch: {
        edit(value) {
            if (value) {
                this.$nextTick(function () {
                if (!this.$refs.editImage) {
                    return
                }
                let cropper = new Cropper(this.$refs.editImage, {
                    aspectRatio: 1 / 1,
                    viewMode: 1,
                })
                this.cropper = cropper
                })
            } else {
                if (this.cropper) {
                this.cropper.destroy()
                this.cropper = false
                }
            }
        }
    },
    methods: {
        editSave() {
            this.edit = false
            let oldFile = this.files[0]
            let binStr = atob(this.cropper.getCroppedCanvas().toDataURL(oldFile.type).split(',')[1])
            let arr = new Uint8Array(binStr.length)
            for (let i = 0; i < binStr.length; i++) {
                arr[i] = binStr.charCodeAt(i)
            }
            let file = new File([arr], oldFile.name, { type: oldFile.type })
            this.$refs.upload.update(oldFile.id, {
                file,
                type: file.type,
                size: file.size,
                active: true,
            })
        },
        alert(message) {
            alert(message)
        },
        inputFile(newFile, oldFile, prevent) {
            if (newFile && !oldFile) {
                this.$nextTick(function () {
                    this.edit = true
                })
            }
            if (!newFile && oldFile) {
                this.edit = false
            }
        },
        inputFilter(newFile, oldFile, prevent) {
            if (newFile && !oldFile) {
                if (!/\.(gif|jpg|jpeg|png|webp)$/i.test(newFile.name)) {
                this.alert('Your choice is not a picture')
                return prevent()
                }
            }
            if (newFile && (!oldFile || newFile.file !== oldFile.file)) {
                newFile.url = ''
                let URL = window.URL || window.webkitURL
                if (URL && URL.createObjectURL) {
                newFile.url = URL.createObjectURL(newFile.file)
                }
            }
        },
        clear(){
            this.files=[];
            this.edit = false;
            this.cropper= false;
            this.$refs.upload.clear;
        },
        updateAvatar(e){
            let file = e.files[0];
            // console.log(file);
            let reader = new FileReader();

            if (file['size'] < 2111775 ) {
                reader.onloadend = (file) => {
                    // console.log('RESULT', reader.result);
                    this.customerForm.photo = reader.result;
                    this.customerForm.put('/api/customer/avatar')
                    .then(() => {
                        Fire.$emit('AfterCreate');
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
                }
                reader.readAsDataURL(file);
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: "You are uploading a large file!",
                })
            }
        }
        
    }
}
</script>