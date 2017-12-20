<?php 

session_start();

require_once("vendor/autoload.php");

use \Ecommerce\Page;
use \Ecommerce\PageAdmin;
use \Slim\Slim;
use \Ecommerce\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$page = new Page();
	$page->setTpl("index");

});

$app->get('/admin', function() {


    User::verifyLogin();
	$page = new PageAdmin();
	$page->setTpl("index");

});

$app->get('/admin/login', function() {
    
	$page = new PageAdmin([
		"header" => false,
		"footer" => false]);
	$page->setTpl("login");

});

$app->post('/admin/login', function() {
    
	User::login($_POST["login"], $_POST["password"]);

	header("Location: /admin");
	exit;

});

$app->get('/admin/logout', function(){

	User::logout();
	header("Location: /admin/login");
	exit;
});

$app->get('/admin/users', function(){

	User::verifyLogin();

	$user = User::listAll();

	$page = new PageAdmin("users", array(
		"users"=>$user));
	
	$page->setTpl("users");
});

$app->get('/admin/users/create', function(){

	$page = new PageAdmin();
	User::verifyLogin();
	$page->setTpl("users-create");
});

$app->get('/admin/users/:iduser', function($iduser){

	$page = new PageAdmin();
	User::verifyLogin();
	$page->setTpl("users-update");
});

$app->post('/admin/user/create', function(){

User::verifyLogin();

});

$app->post('/admin/user/:iduser', function($iduser){

User::verifyLogin();
	
});

$app->delete('/admin/user/:iduser', function($iduser){

User::verifyLogin();
	
});



$app->run();

 ?>
 
 ?>