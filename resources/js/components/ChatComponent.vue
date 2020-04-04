<template>
    <div id="chat">
        <div id="footer-fixed">
            <div id="footer-bk">
                <textarea v-model="message" @keydown.enter="sendByEnter"></textarea>
                <br>
                <button type="button" @click="send()">送信</button>
                            <hr>            <hr>
            </div>
        </div>
    
        <div id="messages" v-for="m in messages">

            <!-- ユーザーネーム -->
            <span v-text="m.user"></span>：&nbsp;
            <br>
            <!-- メッセージ内容 -->
            <strong><span style="white-space:pre-wrap; word-wrap:break-word;" v-text="m.body"></span></strong>
            <br>
            <!-- 登録された日時 -->
            <span v-text="m.created_at"></span>
            <hr>
        </div>

    </div>
</template>

<script>
    //TODO:画面にはいった時点でクッキーにユーザー名とルームId付与
    //TODO:クッキーを消した場合はトップ画面に移動？
    export default{
        el: '#chatspa',
        data() {
            return {
                message: '',
                messages: [],
                username: 'testname',
                roomid  : 'testroom'
            }
        },
        methods: {
            getMessages() {

                const url = '/ajax/chat';
                axios.get(url)
                    .then((response) => {

                    this.messages = response.data;

                });

            },
            send() {

                const url = '/ajax/chat';
                const params = { message: this.message,
                                    username: Cookies.get('name'),
                                    roomid: Cookies.get('room')
                                };
                axios.post(url, params)
                    .then((response) => {

                        // 成功したらメッセージをクリア
                        this.message = '';

                });

            },
            sendByEnter: function(e) {
                if(e.shiftKey) {
                    return;
                }

                // これで「Enter を叩くと改行が入る」というデフォルトの挙動をキャンセルする
                e.preventDefault();
                this.send();
            },
            cookie() {
                Cookies.set('name', this.username);
                Cookies.set('room', this.roomid);

                this.username = '';
                this.roomid   = '';
            }

        },
        mounted() {

            this.getMessages();

            Echo.channel('chat')
                .listen('MessageCreated', (e) => {

                this.getMessages(); // 全メッセージを再読込

            });
        }
    }

</script>
