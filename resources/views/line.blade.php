<html>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- cssの呼び出し -->
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<body>
    <div id="app">
        <main class="main-container">
            <div class="chat-timeline">
                <balloon 
                    v-for="chat in chatLogs"
                    :speaker="chat.speaker"
                    :name="chat.name"
                    :message="chat.message">
                </balloon>
            </div>
            <chat-form
                @submit-message="submit"
                apply-event="submit-message">
            </chat-form>
        </main>
    </div>
    
    <script src="/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

    <script>
        
    </script>
</body>
</html>