<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event\MessageSentEvent;
use Auth;

class MessageController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function fetch(){
    	return \App\Message::with('user')->get();
    }

    public function sentMessage(){
    	$user = Auth::user();

    	$message = $user->message()->create([
    		'message' => request()->message
    	]);

        broadcast(new MessageSentEvent($user, $message));
    }
}
