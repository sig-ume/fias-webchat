<template>
  <div class="lobby">
    
        ※クッキーを保存しないとコメント送信できません。
        
        <div id="footer-fixed">
            <div id="footer-bk">
                            
                <textarea v-model="username"></textarea>

                <textarea v-model="roomid"></textarea>
                <br>
                <button type="button" @click="cookie()">クッキー保存</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "lobby",
        data() {
            return {
                username: 'testname',
                roomid  : 'testroom'
            }
        },
        methods: {
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

                this.$router.push({ path: 'chatspa' });
            }

        },
	    mounted() {
	        console.log('Component mounted.')
	    }
    }

</script>