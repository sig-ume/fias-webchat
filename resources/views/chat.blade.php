<html>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<body>
    ※クッキーを保存しないとコメント送信できません。
    <div id="chat">

        <textarea v-model="username"></textarea>

        <textarea v-model="roomid"></textarea>
        <br>
        <button type="button" @click="cookie()">クッキー保存</button>
        <br>
        <textarea v-model="message"></textarea>
        <br>
        <button type="button" @click="send()">送信</button>

        <br>
        <hr>

        <hr>

        <div v-for="m in messages">

            <!-- 登録された日時 -->
            <span v-text="m.user"></span>：&nbsp;

            <!-- メッセージ内容 -->
            <span v-text="m.body"></span>&nbsp;&nbsp;&nbsp;

            <!-- 登録された日時 -->
            <span v-text="m.created_at"></span>


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