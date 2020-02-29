<html>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- cssの呼び出し -->
    <link href="css/chat.blade.css" rel="stylesheet" type="text/css">
<body>
    <div id="chat">
    
        <div id="messages" v-for="m in messages">

            <!-- ユーザーネーム -->
            <span v-text="m.user"></span>：&nbsp;
            <br>
            <!-- メッセージ内容 -->
            <strong><span style="white-space:pre-wrap; word-wrap:break-word;" v-text="m.body"></span></strong>
            <br>
            <!-- 登録された日時 -->
            <span v-text="m.created_at"></span>


        </div>

        ※クッキーを保存しないとコメント送信できません。
        
        <div id="footer-fixed">
                     <div id="footer-bk">
                            
        <textarea v-model="username"></textarea>

        <textarea v-model="roomid"></textarea>
        <br>
        <button type="button" @click="cookie()">クッキー保存</button>
        <br>
        <textarea v-model="message" @keydown.enter="sendByEnter"></textarea>
        <br>
        <button type="button" @click="send()">送信</button>
        </div>
                     </div>
    </div>
    
    <script src="/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

    <script>
        //TODO:画面にはいった時点でクッキーにユーザー名とルームId付与
        //TODO:クッキーを消した場合はトップ画面に移動？
        new Vue({
            el: '#chat',
            data: {
                message: '',
                messages: [],
                username: 'testname',
                roomid  : 'testroom'
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
        });

    </script>
</body>
</html>