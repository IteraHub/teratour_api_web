<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
/**
 * @var Illuminate\Support\Facades\Route $router
 */

$router->post('/user/register','UserController@register');
$router->get('/user','UserController@index');
$router->get('/posts','PostController@index');
$router->post('/posts','PostController@store');

$router->get('/posts/{post}/comments','CommentController@index');
$router->post('/posts/{post}/comments','CommentController@store');


$router->get('/posts/{post_id}/like','PostController@like');
$router->get('/posts/{post_id}/unlike','PostController@unlike');