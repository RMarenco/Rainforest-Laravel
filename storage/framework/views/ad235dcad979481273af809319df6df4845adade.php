<<<<<<< HEAD
<?php $__env->startSection('content'); ?>
	<h1 class="text-center">Chat App</h1>
	<message :messages="messages"></message>
	<sent-message v-on:messagesent="addMessage" :user="<?php echo e(Auth::user()); ?>"></sent-message>
<?php $__env->stopSection(); ?>
=======
<?php $__env->startSection('content'); ?>
	<h1 class="text-center">Chat App</h1>
	<message :messages="messages"></message>
	<sent-message v-on:messagesent="addMessage" :user="<?php echo e(Auth::user()); ?>"></sent-message>
<?php $__env->stopSection(); ?>
>>>>>>> e9b1688eb66a870fc29e49895a1cba4c4c7bd269
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\rainforest\resources\views/chat.blade.php ENDPATH**/ ?>