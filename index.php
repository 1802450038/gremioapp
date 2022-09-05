<?php

use gremio\Model\Logs;
use gremio\Model\User;
use gremio\Page;
use gremio\PageAdmin;

session_start();
require_once("vendor/autoload.php");
use Slim\Slim;
$app = new Slim();
$app->config('debug', true);

require_once("user-routes.php");
require_once("payment-routes.php");
require_once("partner-routes.php");
require_once("log-routes.php");
require_once("dependent-routes.php");
require_once("address-routes.php");
require_once("functions.php");

$app->get('/', function () {

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index", array(
		"administrador" => User::getUserIsAdmin(),
		"id" => $_SESSION[User::SESSION]["user_id"]
	));
});

$app->get('/login', function () {

	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	$page->setTpl("login");
});

$app->get('/admin', function () {

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index", array(
		"administrador" => User::getUserIsAdmin(),
		"id" => $_SESSION[User::SESSION]["user_id"]
	));
});

$app->get('/logout', function () {

	User::verifyLogin();

	User::logout();

	header("Location:/");
	exit;
});

$app->get('/forgot', function () {

	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	$page->setTpl("forgot");
});

$app->get("/forgot/sent", function () {

	$page = new Page([
		"header" => false,
		"footer" => false
	]);

	$page->setTpl("forgot-sent");
	exit;
});

$app->get("/forgot/reset", function () {

	User::validForgotDecrypt($_GET["code"]);

	$page = new Page([
		"header" => false,
		"footer" => false
	]);

	$page->setTpl("forgot-reset", array(
		"code" => $_GET["code"]
	));
	exit;
});

$app->get("/admin/message", function () {


	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	$tipo = $_GET['tipo'];
	$sucesso = $_GET['sucesso'];
	$mensagem = $_GET['mensagem'];


	$page->setTpl("message", array(
		"tipo" => $tipo,
		"resposta" => $mensagem,
		"sucesso" => $sucesso
	));
});

$app->post('/admin/login', function () {

	User::login($_POST["user_login"], $_POST["user_password"]);

	header("Location:/admin");
	exit;
});

$app->post("/forgot", function () {

	User::getForgot($_POST["user_email"]);

	header("Location: /forgot/sent");
	exit;
});

$app->post("/forgot/reset", function () {

	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);


	if ($_POST['user_password'] === $_POST["user_verify_password"]) {

		$forgot = User::validForgotDecrypt($_POST["verify_code"]);
		$user = new User();
		$user->setData($user->getByEmail($forgot["recovery_email"]));
		$user->setuser_password($_POST['user_password'] = $user->getCriptoPassword($_POST['user_password']));
		$user->setPassword();
		$user->setFogotUsed($forgot["recovery_id"]);
		$tipo = "Sucesso";
		$sucesso = '1';
		$mensagem = "Senha alterada com sucesso";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	} else {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Falha ao trocar a senha";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}
});

$app->run();
