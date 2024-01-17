<template>
    <div>
        <p>
            <button class="btn btn-success" v-if="showBtn" @click.prevent="showPhoneBtn()"> <i class="fas fa-phone"></i> Phone Number</button>
        </p>
        <p v-if="showNumber">
            <button class="btn btn-danger">{{phoneNumber}}</button>
        </p>
    </div>
</template>
<script>
export default {
    props:['phoneNumber'],
    data()
    {
        return{
            showBtn:true,
            showNumber:false
        }
    },
    methods:{
        showPhoneBtn(){
            this.showNumber=true;
            this.showBtn=false;
            this.$toaster.info('Seller contact number displayed.', {timeout: 2000})


        }
    }
    
}
</script>