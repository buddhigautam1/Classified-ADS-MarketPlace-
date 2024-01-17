<template>
    <div>
        <button v-if="saveBtn" class="btn btn-info" @click.prevent="saveAd()">
            <i class="fas fa-heart"
        ></i>
          Save this ad 
        </button>
        <p v-else class="alert alert-success">
        Advertisement saved !
        </p>
       

    </div>
</template>
<script>
export default {
    props:['adId','userId'],
    data(){
        return{
            saveBtn:true,

        }
    },
    methods:{

        saveAd(){
            axios.post('/ad/save',{
                adId:this.adId,
                userId:this.userId
            }).then((response)=>{
  
                this.saveBtn=false
                this.$toaster.success('This ad is saved in your list.', {timeout: 8000})
            }).catch((err)=>{
                alert('Error!')
            })
        }
    }

 
}
</script>