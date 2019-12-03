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

        $message = \App\Message::create([
            'body' => $request->message
        ]);
        event(new MessageCreated($message));

    }
}
