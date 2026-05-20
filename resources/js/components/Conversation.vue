<template>
    <div class="row chat-layout animate-in">
        <aside class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-header">Conversations</div>
                <div class="list-group list-group-flush chat-user-list">
                    <button
                        v-for="(user, index) in users"
                        :key="index"
                        type="button"
                        class="list-group-item list-group-item-action chat-user"
                        :class="{ active: selectedUserId === user.id }"
                        @click.prevent="showMessage(user.id)"
                    >
                        <img :src="avatarUrl(user.avatar)" :alt="user.name">
                        <span>{{ user.name }}</span>
                    </button>

                    <div v-if="!users.length" class="list-group-item text-muted">
                        No conversations yet.
                    </div>
                </div>
            </div>
        </aside>

        <section class="col-lg-9">
            <div class="card chat-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span>Chat</span>
                    <span v-if="selectedUserId" class="badge badge-primary">Live</span>
                </div>

                <div
                    v-if="selectedUserId"
                    class="card-body chat-msg"
                    v-chat-scroll="{ always: false, smooth: true, scrollonremoved: true }"
                >
                    <ul class="chat">
                        <li
                            v-for="(message, index) in messages"
                            :key="index"
                            class="chat-message"
                            :class="{ 'is-self': message.selfOwned }"
                        >
                            <img class="chat-avatar" :src="avatarUrl(message.user.avatar)" :alt="message.user.name">
                            <div class="chat-bubble">
                                <div class="chat-meta">
                                    <strong>{{ message.user.name }}</strong>
                                    <small>{{ moment(message.created_at).format("DD-MM-YYYY") }}</small>
                                </div>

                                <p class="chat-ad" v-if="message.ads">
                                    <a :href="'/products/' + message.ads.id + '/' + message.ads.slug" target="_blank" rel="noopener">
                                        {{ message.ads.name }}
                                        <img :src="assetUrl(message.ads.feature_image)" :alt="message.ads.name">
                                    </a>
                                </p>

                                <p class="mb-0">{{ message.body }}</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="chat-empty" v-else>
                    <i class="far fa-comments"></i>
                    <p>Select a conversation to start chatting.</p>
                </div>

                <div class="card-footer">
                    <div class="input-group">
                        <input
                            v-model="body"
                            id="btn-input"
                            type="text"
                            class="form-control"
                            placeholder="Type your message here..."
                            @keyup.enter="sendMessage"
                        >
                        <div class="input-group-append">
                            <button class="btn btn-primary" @click.prevent="sendMessage">
                                Send
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
            poller:null,
        }
    },
    mounted(){
        axios.get('/users').then((response)=>{
            this.users = response.data
        })

        this.poller = setInterval(()=>{
            if (this.selectedUserId) {
                this.showMessage(this.selectedUserId)
            }
        },1000)
    },
    beforeDestroy(){
        if (this.poller) {
            clearInterval(this.poller)
        }
    },
    methods:{
        showMessage(userId){
            if (!userId) {
                return
            }

            axios.get('/message/user/'+userId).then((response)=>{
                this.messages = response.data
                this.selectedUserId = userId
            })

        },
        sendMessage()
        {
            if(this.body==''){
                this.$toaster.warning('Please write your message.', {timeout: 3000})
                return
            }
            if(this.selectedUserId==''){
                this.$toaster.warning('Please select a conversation first.', {timeout: 3000})
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
        assetUrl(path) {
            if (!path) {
                return '/img/man.jpg'
            }

            if (/^https?:\/\//.test(path)) {
                return path
            }

            return '/storage/' + path.replace(/^public\//, '')
        },
        avatarUrl(avatar) {
            return this.assetUrl(avatar)
        },
     
    }
};
</script>
<style>
.chat-user {
    align-items: center;
    display: flex;
    gap: .75rem;
    font-weight: 800;
}

.chat-user img,
.chat-avatar {
    border-radius: 50%;
    height: 48px;
    object-fit: cover;
    width: 48px;
}

.chat-card {
    min-height: 560px;
}

.chat {
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat-msg {
    background: #f8fafc;
    height: 430px;
    overflow-y: auto;
}

.chat-message {
    align-items: flex-end;
    display: flex;
    gap: .75rem;
    margin-bottom: 1rem;
    max-width: 86%;
}

.chat-message.is-self {
    flex-direction: row-reverse;
    margin-left: auto;
}

.chat-bubble {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 1rem 1rem 1rem .25rem;
    box-shadow: 0 12px 24px rgba(15, 23, 42, .06);
    padding: .9rem 1rem;
}

.chat-message.is-self .chat-bubble {
    background: #2563eb;
    border-color: #2563eb;
    border-radius: 1rem 1rem .25rem 1rem;
    color: #fff;
}

.chat-meta {
    align-items: center;
    display: flex;
    gap: .75rem;
    justify-content: space-between;
    margin-bottom: .45rem;
}

.chat-meta small {
    color: #64748b;
}

.chat-message.is-self .chat-meta small,
.chat-message.is-self a {
    color: rgba(255, 255, 255, .82);
}

.chat-ad img {
    border-radius: .75rem;
    display: block;
    margin-top: .5rem;
    max-width: 120px;
}

.chat-empty {
    align-items: center;
    color: #64748b;
    display: flex;
    flex-direction: column;
    gap: .75rem;
    justify-content: center;
    min-height: 430px;
}

.chat-empty i {
    font-size: 3rem;
}

@media (max-width: 767.98px) {
    .chat-user-list {
        max-height: 280px;
        overflow-y: auto;
    }

    .chat-message {
        max-width: 100%;
    }

    .chat-card {
        min-height: auto;
    }
}
</style>