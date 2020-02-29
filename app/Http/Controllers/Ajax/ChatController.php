<?php

namespace App\Http\Controllers\Ajax;

use App\Events\MessageCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function index() { // �V�����Ƀ��b�Z�[�W�ꗗ���擾

        //TODO;画面表示テスト
        $message = \App\Message::orderBy('id', 'asc')->get();
        return $message;

    }

    public function create(Request $request) { // ���b�Z�[�W��o�^

        $user    = ($request->username == 'undefined') ? '名無し'   : $request->username;
        $room    = ($request->roomid   == 'undefined') ? '00000000' : $request->roomid;
        $message = \App\Message::create([
            'body'    => $request->message,
            'user'    => $user,
            'room_id' => $room
        ]);
        event(new MessageCreated($message));

    }

    private function getLocale() {

        $languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        $languages = array_reverse($languages);
 
        $result = '';
 
        foreach ($languages as $language) {
            if (preg_match('/^en/i', $language)) {
                $result = 'English';
                //header("Location: /english");
            } elseif (preg_match('/^ja/i', $language)) {
                $result = 'Japanese';
                //header("Location: /");
            } 
        }
        if ($result == '') {
            $result = 'Japanese';
            //header("Location: /");
        }

        return $result;
    }
}