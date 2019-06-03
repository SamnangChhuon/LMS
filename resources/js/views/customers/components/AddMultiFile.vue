<template>
    <div class="modal fade" id="addFile" tabindex="-1" role="dialog" aria-labelledby="addImage" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Files</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul style="list-style-type:none;padding:0;">
                        <li>
                            <label for="" class="text-danger">Note: <br>- Existing attachments (images/files) will not allow.<br>- File can not larger than 2MB.<br>*** File name will be change to unique name in database.</label>
                        </li>
                        <li>
                            <div class="text-center p-5">
                                <h4>Drop files anywhere to upload<br/>or</h4>
                                <file-upload
                                class="btn btn-primary"
                                extensions="gif,jpg,jpeg,png,webp"
                                accept="image/png,image/gif,image/jpeg,image/webp"
                                :multiple="true"
                                :drop="true"
                                :drop-directory="true"
                                :size="1024 * 1024 * 10"
                                v-model="formFile.file"
                                @input-filter="inputFilter"
                                @input-file="inputFile"
                                ref="file">
                                    <i class="fa fa-plus"></i> Select files
                                </file-upload>
                            </div>
                        </li>
                        <!-- <li>
                            <input type="file" name="file" ref="file" multiple v-on:change="handleFileUpload">
                        </li> -->
                    </ul>
                    <table v-if="formFile.file.length" class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th style="width:10px;text-align:center">#</th>
                                <th>File Name</th>
                                <th>File Size</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(file, index) in formFile.file" :key="file.id">
                                <td><button @click="removeInputFile(index)" class="btn btn-tool"><i class="fas fa-times"></i></button></td>
                                <td><span>{{file.name}}</span></td>
                                <td><span>{{file.size | formatSize}}</span></td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-show="$refs.files && $refs.files.dropActive" class="drop-active">
                        <h3>Drop files to upload</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal" aria-label="Close">Close</button>
                    <div class="float-right">
                        <button class="btn btn-success" @click.prevent="handleFileUpload" type="submit">Upload File</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            files: [],
            formFile: new Form({
                cid: this.$route.params.id,
                file: [],
            })
        }
    },
    methods:{
        // Add File
        addFile(){
            $('#addFile').modal('show');
            this.formFile.file = [];
        },
        fieldChange(e){
            let selectedFiles=e.target.files;
            console.log("1")
            if(!selectedFiles.length){
                return false;
            }
            console.log("2")

            for(let i=0; i < selectedFiles.length; i++){
                this.files.push(selectedFiles[i]);
            }
            console.log("3")

            console.log(this.files);
        },
        inputFileByCustomer(){
            let formData = new FormData();

            for(let i=0; i < this.files.length ; i++){
                formData.append('files['+ i +']', this.files[i]);
            }

            this.$Progress.start();

            const config = { };
            $('#upload-file').value=[];
            axios.post('/api/file',
                formData,
                {
                    data: {
                        cid: this.formFile.cid
                    }
                })
            .then((response) => {
                toast.fire({
                    type: 'success',
                    title: 'File added in successfully'
                })
                this.$Progress.finish();
                $('#addFile').modal('show');
                this.formFile.clear();
                this.formFile.reset();
            })
            .catch(() => {
                Swal.fire({
                    title: 'Insert Error!!!',
                    text: 'File can not insert.',
                    type: 'error',
                    confirmButtonText: 'Close',
                })
                this.$Progress.fail();
            });
        },

        handleFileUpload(){
            let files = this.$refs.file.files;
            let formData = new FormData();
            let headers = {'Content-Type': 'multipart/form-data'};

            for (let index = 0; index < files.length; index++) {
                formData.append('files[' + index + ']', files[index]);                    
            }

            this.formFile.post('/api/inputFile/' + this.$route.params.id)
                .then((response) => {
                    console.log('response', response);
                })
                .catch((error) => {
                    console.error(error.response);
                })
        },
        // Remove Input File
        removeInputFile(index) {
            this.formFile.file.splice(index, 1);
        },
        inputFilter(newFile, oldFile, prevent) {
            if (newFile && !oldFile) {
                // Before adding a file
                // Filter system files or hide files
                if (/(\/|^)(Thumbs\.db|desktop\.ini|\..+)$/.test(newFile.name)) {
                    return prevent()
                }
                // Filter php html js file
                if (/\.(php5?|html?|jsx?)$/i.test(newFile.name)) {
                    return prevent()
                }
                // Filter large file
                let e = newFile.file;
                let reader = new FileReader();
                if(e['size'] > 2111775){
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file!\n' + '"' + newFile.name + '"',
                        confirmButtonText: 'Close'
                    })
                    return prevent();
                }

                // Filter Duplicate File
                this.formFile.file.forEach(element => {
                    if (newFile.file.name === element.name) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'You are uploading a duplicate file!\n' + '"' + newFile.name + '"',
                            confirmButtonText: 'Close'
                        })
                        return prevent();
                    }
                });

                if ( /\s/.test(newFile.name) ) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'The file name must not have space! ' + '"' + newFile.name + '"',
                        confirmButtonText: 'Close'
                    })
                    return prevent();
                }
            }
        },
        inputFile(newFile, oldFile) {
            if (newFile && !oldFile) {
                // Filter the file size
                console.log('add', newFile)
            }
            if (newFile && oldFile) {
                // update
                console.log('update', newFile)
            }
            if (!newFile && oldFile) {
                // remove
                console.log('remove', oldFile)
            }
        },
    }
}
</script>