<template>
    <div>
        <input type="file" name="first_image" @change="onFileChange" class="custom-file-upload"
         accept="image/*">
        <div id="preview" class="mt-1">
            <img v-if="url" :src="url" width="100" height="60" style="border:1px solid #ccc;">
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            url:''
        }
    },
    methods:{
        onFileChange(e){
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file)
        }
    }
}
</script>