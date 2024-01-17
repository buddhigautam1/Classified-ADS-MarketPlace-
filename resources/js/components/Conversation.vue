<template>
    <div class="row">
        <div class="col-md-2">
        <p v-for="(user,index) in users" :key="index">
          <span v-if="user.avatar">
            <img :src=" '/storage/'+ (user.avatar.substring(7)) " width="80" style="border-radius:50%;">

          </span>
          <span v-else>
              <img :src=" '/img/man.jpg' " width="80" style="border-radius:50%;">
          </span>

            <a href="#" @click.prevent="showMessage(user.id)">
                <p>{{user.name}}</p>
            </a>
           
        </p>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">
                    <span>Chat </span>
                </div>
                <div  v-if="selectedUserId"
                    class="card-body chat-msg" v-chat-scroll="{always: false, smooth: true, scrollonremoved:true}">
                    <ul class="chat"  v-for="(message,index) in messages" :key="index"> 
                   
                        <li class="sender clearfix" v-if="message.selfOwned" >
                         
                            <span class="chat-img left clearfix mx-2" v-if="message.user.avatar">
                                <img :src=" '/storage/'+ (message.user.avatar.substring(7)) " width="60">

                            </span>
                            <span class="chat-img left clearfix mx-2" v-else>
                                <img :src=" '/img/man.jpg'" width="60">

                            </span>
                            <div class="chat-body2 clearfix">
                                <div class="header clearfix">
                                    <strong class="primary-font">
                                            
                                     {{message.user.name}}
                                    </strong>
                                    <small class="right text-muted">
                                        <span
                                            class="glyphicon glyphicon-time"
                                        ></span
                                        >
                                       {{ moment(message.created_at).format("DD-MM-YYYY") }}

                                        </small
                                    >
                                </div>
                                <p class="text-center" v-if="message.ads">
                                    <a :href=" '/products/'+ message.ads.id+'/'+message.ads.slug " target="_blank">
                                        {{message.ads.name}}
                                        <img :src=" '/storage/'+ (message.ads.feature_image.substring(7)) " width="120">
                                    </a>

                                </p>
                
                                <p
                                >
                                
                   
                                 {{message.body}}

                                </p>
                            </div>
                        </li>
                        <li class="buyer clearfix" v-else>
                            <span class="chat-img right clearfix  mx-2" v-if="message.user.avatar">
                               <img :src=" '/storage/'+ (message.user.avatar.substring(7)) " width="60">

                            </span>
                            <span class="chat-img right clearfix  mx-2" v-else>
                               <img :src=" '/img/man.jpg'" width="50">
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">
                                    <small class="left text-muted"
                                        ><span
                                            class="glyphicon glyphicon-time"
                                            
                                        ></span
                                        >   {{ moment(message.created_at).format("DD-MM-YYYY") }}</small
                                    >
                                    <strong class="right primary-font">
                                       {{message.user.name}}
                                    </strong>
                                </div>
                             <p class="text-center" v-if="message.ads">
                                    <a :href=" '/products/'+ message.ads.id+'/'+message.ads.slug " target="_blank">
                                        {{message.ads.name}}
                                        <img :src=" '/storage/'+ (message.ads.feature_image.substring(7)) " width="120">
                                    </a>

                                </p>
                                <p>
                                           
                                  {{message.body}}
                                </p>
                            </div>
                        </li>
                        <li class="sender clearfix">
                            <span class="chat-img left clearfix mx-2"> </span>
                        </li>
                    </ul>
                </div>
                <div style="min-height:250px;" v-else>
                    <p class="text-center">Please select the user to chat.</p>
                </div>
              
                <div class="card-footer">
                    <div class="input-group">
                        <input
                            v-model="body"
                            id="btn-input"
                            type="text"
                            class="form-control input-sm"
                            placeholder="Type your message here..."
                        />
                        <span class="input-group-btn">
                            <button
                                class="btn btn-primary"
                                @click.prevent="sendMessage()"
                              >
                                Send
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    data(){
        return{
            users:[],
            messages:[],
            selectedUserId:'',
            body:'',
            moment:moment,
        }
    },
    mounted(){

        axios.get('/users').then((response)=>{
            this.users = response.data
        })
        setInterval(()=>{
            this.showMessage(this.selectedUserId)
        },1000)
      
       
    },
    methods:{
        showMessage(userId){
            axios.get('/message/user/'+userId).then((response)=>{
                this.messages = response.data
                this.selectedUserId = userId
            })

        },
        sendMessage()
        {
            if(this.body==''){
                alert('Please write your message')
                return
            }
            if(this.selectedUserId==''){
             alert('Please select the user')
                return   
            }
            
            axios.post('/start-conversation',{
                body:this.body,
                receiverId: this.selectedUserId
            }).then((response)=>{
                this.messages.push(response.data);
                this.body=''
            })
        },
     
    }
};
</script>
<style>
    .chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 40px;
    padding-bottom: 5px;
    margin-top: 10px;
    width: 80%;
    height: 10px;
}


.chat li .chat-body p
{
    margin: 0;
}


.chat-msg
{
    overflow-y: scroll;
    height: 350px;
}
.chat-msg .chat-img
{
    width: 50px;
    height: 50px;
}
.chat-msg .img-circle
{
    border-radius: 50%;
}
.chat-msg .chat-img
{
    display: inline-block;
}
.chat-msg .chat-body
{
    display: inline-block;
    max-width: 80%;
    background-color: #FFC195;
    border-radius: 12.5px;
    padding: 15px;
}
.chat-msg .chat-body2
{
    display: inline-block;
    max-width: 80%;
    background-color:#ccc;
    border-radius: 12.5px;
    padding: 15px;
}
.chat-msg .chat-body strong
{
  color: #0169DA;
}

.chat-msg .buyer
{
    text-align: right ;
    float: right;
}
.chat-msg .buyer p
{
    text-align: left ;
}
.chat-msg .sender
{
    text-align: left ;
    float: left;
}
.chat-msg .left
{
    float: left;
}
.chat-msg .right
{
    float: right;
}

.clearfix {
  clear: both;
}

</style>