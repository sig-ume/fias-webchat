<?php

namespace App\Http\Controllers\Ajax;

use App\Events\MessageCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function index() { // �V�����Ƀ��b�Z�[�W�ꗗ���擾

        return \App\Message::orderBy('id', 'desc')->get();

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
}
