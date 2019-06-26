<<<<<<< HEAD
@extends('layouts.app')

@section('content')
	<h1 class="text-center">Chat App</h1>
	<message :messages="messages"></message>
	<sent-message v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></sent-message>
=======
@extends('layouts.app')

@section('content')
	<h1 class="text-center">Chat App</h1>
	<message :messages="messages"></message>
	<sent-message v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></sent-message>
>>>>>>> e9b1688eb66a870fc29e49895a1cba4c4c7bd269
@endsection