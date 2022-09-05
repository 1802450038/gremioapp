<?php

namespace gremio;

use gremio\Model\User;


$app->get('/admin/users', function () {

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$type = (isset($_GET['type'])) ? $_GET['type'] : "user_name";
	$term = (isset($_GET['term'])) ? $_GET['term'] : "";

	$user = new User();

	$pagination = $user->listUsersPageSearch($type, $term, $page);

	$pages = [];

	for ($i = 1; $i <= $pagination['pages']; $i++) {
		array_push($pages, [
			'link' => '/admin/users?' . http_build_query([
				'page' => $i,
				'type' => $type,
				'term' => $term
			]),
			'text' => $i
		]);
	}

	$page = new PageAdmin();

	// if ((int)User::getUserIsAdmin() == 1) {
	$page->setTpl("users", array(
		"usuarios" => $pagination['users'],
		// "administrador" => User::getUserIsAdmin(),
		"administrador" => 1,
		"pages" => $pages,
		"tipo" => $type,
		"termo" => $term
	));
	// } else {
	// header("Location:/admin");
	// }
});

$app->get('/admin/user/delete:id', function ($id) {

	$user = new User();

	$user->get($id);

	$user->delete();

	header("location: /admin/users");
	exit;
});

$app->get('/admin/user/update:id', function ($id) {

	$page = new PageAdmin();

	$user = new User();

	$user->get($id);

	var_dump(User::getUserIsAdmin());

	$page->setTpl("user-update", array(
		"usuario" => $user->getValues(),
		"administrador" => User::getUserIsAdmin()
	));
});

$app->get('/admin/user/create', function () {

	$page = new PageAdmin();

	$page->setTpl("user-create");
});

$app->get('/admin/user/profile:id', function ($id) {

	$page = new PageAdmin();

	$user = new User();

	$user->get($id);

	$page->setTpl("user-profile", array(
		"usuario" => $user->getValues(),
		"administrador" => User::getUserIsAdmin()
	));
});

$app->post('/admin/user/update:id', function ($id) {

	$user = new User();

	$user->get((int)$id);

	if ($user->verifyField("user_name", "Nome", 3, $_POST["user_name"], 3, "U", $user->getuser_name()));


	$user->setData($_POST);

	$user->update($id);

	$user->updateUserSession($id);

	header("location: /admin/user/profile$id");
	exit;
});

$app->post('/admin/user/create', function () {

	$user = new User();

	$user->setuser_uniquetag($user->getUniqueTag());

	if ($user->verifyField("user_name", "Nome", 3, $_POST["user_name"], 3, "C"));


	if (strlen($_POST['user_password']) < 6) {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "A senhas devem ter pelo menos 6 caracteres";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	} else {
		if ($_POST['user_password'] === $_POST['verify_user_password']) {
			$_POST['user_password'] = $user->getCriptoPassword($_POST['user_password']);
		} else {
			$tipo = "Erro";
			$sucesso = '0';
			$mensagem = "A senhas devem ser iguais";
			header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
			exit;
		}
	}

	$user->setData($_POST);

	$result = $user->create()["user_id"];

	header("location: /admin/user/profile$result");
	exit;
});