
<?php

use Illuminate\Support\Facades\Route;

Route::resource('threads', 'API\V1\Thread\ThreadController');

// Route::prefix('/threads')->group(function (){
//     Route::resource('answers', 'API\V1\Thread\AnswerController');
// });