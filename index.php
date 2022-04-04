<?php

use prefeitura\Model\Conductor;
use prefeitura\Model\Address;
use prefeitura\Model\Animal;
use prefeitura\Model\Carriage;
use prefeitura\Model\Dependent;
use prefeitura\Model\Logs;
use prefeitura\Model\User;
use prefeitura\Page;
use prefeitura\PageAdmin;

session_start();
require_once("vendor/autoload.php");

use Slim\Slim;



$app = new Slim();


$app->config('debug', true);

require_once("functions.php");




// Get

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


// Get all

$app->get('/admin/conductors', function () {

	User::verifyLogin();

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$type = (isset($_GET['type'])) ? $_GET['type'] : "conductor_name";
	$term = (isset($_GET['term'])) ? $_GET['term'] : "";

	$conductor = new Conductor();

	$pagination = $conductor->listConductorsPageSearch($type, $term, $page);

	$pages = [];

	for ($i = 1; $i <= $pagination['pages']; $i++) {
		array_push($pages, [
			'link' => '/admin/conductors?' . http_build_query([
				'page' => $i,
				'type' => $type,
				'term' => $term
			]),
			'text' => $i
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("conductors", array(
		"condutores" => $pagination["conductors"],
		"pages" => $pages,
		"tipo" => $type,
		"termo" => $term
	));
});

$app->get('/admin/dependents', function () {

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("dependents");
});

$app->get('/admin/carriages', function () {

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("carriages");
});

$app->get('/admin/animals', function () {

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("animals");
});

$app->get('/admin/users', function () {

	User::verifyLogin();

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

	if ((int)User::getUserIsAdmin() == 1) {
		$page->setTpl("users", array(
			"usuarios" => $pagination['users'],
			"administrador" => User::getUserIsAdmin(),
			"pages" => $pages,
			"tipo" => $type,
			"termo" => $term
		));
	} else {
		header("Location:/admin");
	}
});


$app->get('/admin/logs', function () {

	User::verifyLogin();

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$type = (isset($_GET['type'])) ? $_GET['type'] : "log_id";
	$term = (isset($_GET['term'])) ? $_GET['term'] : "";

	$log = new Logs();


	if ($type == "EX") {
		$type = "log_operation";
		$term = "EX";
	} elseif ($type == "AT") {
		$type = "log_operation";
		$term = "AT";
	} elseif ($type == "RG") {
		$type = "log_operation";
		$term = "RG";
	}

	if ($type == "user" || $term == "Usuarios") {
		$type = "log_targetobject";
		$term = "user";
	} elseif ($type == "conductor" || $term == "Condutores") {
		$type = "log_targetobject";
		$term = "conductor";
	} elseif ($type == "dependent" || $term == "Dependentes") {
		$type = "log_targetobject";
		$term = "dependent";
	} elseif ($type == "animal" || $term == "Animais") {
		$type = "log_targetobject";
		$term = "animal";
	} elseif ($type == "carriage" || $term == "Carruagens") {
		$type = "log_targetobject";
		$term = "carriage";
	} elseif ($type == "address" || $term == "Endereços") {
		$type = "log_targetobject";
		$term = "address";
	}


	$pagination = $log->listLogsPageSearch($type, $term, $page);

	$pages = [];

	for ($i = 1; $i <= $pagination['pages']; $i++) {
		array_push($pages, [
			'link' => '/admin/logs?' . http_build_query([
				'page' => $i,
				'type' => $type,
				'term' => $term
			]),
			'text' => $i
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("logs", array(
		"logs" => $pagination["logs"],
		"pages" => $pages,
		"tipo" => $type,
		"termo" => $term
	));
});
// Get all-end              

// Get delete

$app->get('/admin/conductor/delete:id', function ($id) {

	$conductor = new Conductor();

	$conductor->get($id);

	$conductor->delete();

	$log = new Logs();

	$before = implode(",", $conductor->getValues());
	$after = "Excluido";
	$log->save(
		$_SESSION[User::SESSION]["user_id"],
		$_SESSION[User::SESSION]["user_name"],
		$conductor->getconductor_name(),
		$conductor->getconductor_id(),
		"conductor",
		"EX",
		"$before",
		"$after"
	);

	header("location: /admin/conductors");
	exit;
});

$app->get('/admin/address/delete:id', function ($id) {

	$address = new Address();

	$address->listById($id);

	$conductor_id = $address->getconductor_id();

	$address->delete();

	$log = new Logs();

	$before = implode(",", $address->getValues());
	$after = "Excluido";
	$log->save(
		$_SESSION[User::SESSION]["user_id"],
		$_SESSION[User::SESSION]["user_name"],
		$address->getaddress_uniquetag(),
		$address->getaddress_id(),
		"address",
		"EX",
		"$before",
		"$after"
	);

	header("location: /admin/conductor/profile$conductor_id");
	exit;
});

$app->get('/admin/dependent/delete:id', function ($id) {

	$dependent = new Dependent();

	$dependent->listById($id);

	$conductor_id = $dependent->getconductor_id();

	$dependent->delete();

	$log = new Logs();

	$before = implode(",", $dependent->getValues());
	$after = "Excluido";
	$log->save(
		$_SESSION[User::SESSION]["user_id"],
		$_SESSION[User::SESSION]["user_name"],
		$dependent->getdependent_name(),
		$dependent->getdependent_id(),
		"dependent",
		"EX",
		"$before",
		"$after"
	);

	header("location: /admin/conductor/profile$conductor_id");
	exit;
});

$app->get('/admin/carriage/delete:id', function ($id) {

	$carriage = new Carriage();

	$carriage->listById($id);

	$conductor_id = $carriage->getconductor_id();

	$carriage->delete();

	$log = new Logs();

	$before = implode(",", $carriage->getValues());
	$after = "Excluido";
	$log->save(
		$_SESSION[User::SESSION]["user_id"],
		$_SESSION[User::SESSION]["user_name"],
		$carriage->getcarriage_uniquetag(),
		$carriage->getcarriage_id(),
		"carriage",
		"EX",
		"$before",
		"$after"
	);

	header("location: /admin/conductor/profile$conductor_id");
	exit;
});

$app->get('/admin/animal/delete:id', function ($id) {

	$animal = new Animal();

	$animal->listById($id);

	$conductor_id = $animal->getconductor_id();

	$animal->delete();

	$log = new Logs();

	$before = implode(",", $animal->getValues());
	$after = "Excluido";
	$log->save(
		$_SESSION[User::SESSION]["user_id"],
		$_SESSION[User::SESSION]["user_name"],
		$animal->getanimal_uniquetag(),
		$animal->getanimal_id(),
		"animal",
		"EX",
		"$before",
		"$after"
	);

	header("location: /admin/conductor/profile$conductor_id");
	exit;
});

$app->get('/admin/user/delete:id', function ($id) {

	$user = new User();

	$user->get($id);

	$user->delete();

	$log = new Logs();

	$before = implode(",", $user->getValues());
	$after = "Excluido";
	$log->save(
		$_SESSION[User::SESSION]["user_id"],
		$_SESSION[User::SESSION]["user_name"],
		$user->getuser_name(),
		$user->getuser_id(),
		"user",
		"EX",
		"$before",
		"$after"
	);

	header("location: /admin/users");
	exit;
});


// Get delete-end

// Get update

$app->get('/admin/conductor/update:id', function ($id) {

	$page = new PageAdmin();

	$conductor = new Conductor();

	$conductor->get($id);


	$page->setTpl("conductor-update", array(
		"condutor" => $conductor->getValues()
	));
});

$app->get('/admin/address/update:id', function ($id) {

	$page = new PageAdmin();

	$address = new Address();

	$address->listById($id);

	$page->setTpl("address-update", array(
		"endereco" => $address->getValues()
	));
});

$app->get('/admin/dependent/update:id', function ($id) {

	$page = new PageAdmin();

	$dependent = new Dependent();

	$dependent->listById($id);

	$familiarity = $dependent->getdependent_familiarity();

	if ($familiarity == "filho/filha") {
		$familiarity = "f";
	} else if ($familiarity == "cônjuge") {
		$familiarity = "c";
	} else if ($familiarity == "pai/mãe") {
		$familiarity = "p";
	} else {
		$familiarity = "o";
	}

	$page->setTpl("dependent-update", array(
		"dependente" => $dependent->getValues(),
		"familiaridade" => $familiarity
	));
});

$app->get('/admin/carriage/update:id', function ($id) {

	$page = new PageAdmin();

	$carriage = new Carriage();

	$carriage->listById($id);



	$page->setTpl("carriage-update", array(
		"carruagem" => $carriage->getValues()
	));
});

$app->get('/admin/animal/update:id', function ($id) {

	$page = new PageAdmin();

	$animal = new Animal();

	$animal->listById($id);


	$page->setTpl("animal-update", array(
		"animal" => $animal->getValues()
	));
});

$app->get('/admin/user/update:id', function ($id) {

	$page = new PageAdmin();

	$user = new User();

	$user->get($id);

	$page->setTpl("user-update", array(
		"usuario" => $user->getValues(),
		"administrador" => User::getUserIsAdmin()
	));
});

// Get update-end

// Get create

$app->get('/admin/conductor/create', function () {

	$page = new PageAdmin();

	$page->setTpl("conductor-create");
});

$app->get('/admin/user/create', function () {

	$page = new PageAdmin();

	$page->setTpl("user-create");
});

$app->get('/admin/address/create:conductor_id', function ($conductor_id) {

	$page = new PageAdmin();

	$page->setTpl("address-create", array(
		"condutor" => $conductor_id
	));
});

$app->get('/admin/dependent/create:conductor_id', function ($conductor_id) {

	$page = new PageAdmin();

	$page->setTpl("dependent-create");
});

$app->get('/admin/carriage/create:conductor_id', function ($conductor_id) {

	$page = new PageAdmin();

	$page->setTpl("carriage-create");
});

$app->get('/admin/animal/create:conductor_id', function ($conductor_id) {

	$page = new PageAdmin();

	$page->setTpl("animal-create");
});

// Get  create-end

// Get update

// Get update-end

// Get profiles

$app->get('/admin/conductor/profile:id', function ($id) {

	$page = new PageAdmin();

	$conductor = new Conductor();

	$address = Address::listByConductorId($id);

	$animals = Animal::listByConductorId($id);

	$dependents = Dependent::listByConductorId($id);

	$carriages = Carriage::listByConductorId($id);

	$conductor->get($id);



	$page->setTpl("conductor-profile", array(
		"condutor" => $conductor->getValues(),
		"endereco" => $address,
		"dependentes" => $dependents,
		"carruagens" => $carriages,
		"animais" => $animals
	));
});

$app->get('/admin/dependent/profile:id', function ($id) {

	$page = new PageAdmin();

	$dependent = new Dependent();

	$dependent->listById($id);

	$conductorName = Conductor::getConductorName($dependent->getconductor_id())[0]["conductor_name"];


	$page->setTpl("dependent-profile", array(
		"dependente" => $dependent->getValues(),
		"condutor" => $conductorName
	));
});

$app->get('/admin/carriage/profile:id', function ($id) {

	$page = new PageAdmin();

	$carriage = new Carriage();

	$carriage->listById($id);

	$conductorName = Conductor::getConductorName($carriage->getconductor_id())[0]["conductor_name"];


	$page->setTpl("carriage-profile", array(
		"carruagem" => $carriage->getValues(),
		"condutor" => $conductorName
	));
});

$app->get('/admin/animal/profile:id', function ($id) {

	$page = new PageAdmin();

	$animal = new Animal();

	$animal->listById($id);

	$conductorName = Conductor::getConductorName($animal->getconductor_id())[0]["conductor_name"];

	$page->setTpl("animal-profile", array(
		"animal" => $animal->getValues(),
		"condutor" => $conductorName
	));
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

$app->get('/admin/log/profile:id', function ($id) {

	$page = new PageAdmin();

	$log = new Logs();

	$log->get($id);

	$page->setTpl("log-profile", array(
		"registro" => $log->getValues()
	));
});

// Get profiles-end

// Get - end

// Post update
$app->post('/admin/user/update:id', function ($id) {

	$user = new User();

	$log = new Logs();

	$user->get((int)$id);

	$prev_user = $user->getValues();

	if (isset($_POST["yes"])) {
		$_POST["user_isadmin"] = "1";
	} else	if (isset($_POST["no"])) {
		$_POST["user_isadmin"] = "0";
	} else {
		$_POST["user_isadmin"] = "0";
	}

	if ((int)($_FILES["user_profilepicture"]["size"]) == 0) {
		$user->checkphoto();
	} else {
		$user->setPhoto($_FILES["user_profilepicture"]);
	}

	if ($user->verifyField("user_name", "Nome", 3, $_POST["user_name"], 3, "U", $user->getuser_name()));
	if ($user->verifyField("user_phone", "Telefone", 15, $_POST["user_phone"], 11, "U", $user->getuser_phone()));
	if ($user->verifyField("user_login", "Login", 6, $_POST["user_login"], 6, "U", $user->getuser_login()));
	if ($user->verifyField("user_email", "Email", 1, $_POST["user_email"], 1, "U", $user->getuser_email()));


	$user->setData($_POST);

	$user->update($id);

	$before = implode(",", $prev_user);
	$after = implode(",", $user->getValues());
	$log->save(
		$_SESSION[User::SESSION]["user_id"],
		$_SESSION[User::SESSION]["user_name"],
		$user->getuser_name(),
		$user->getuser_id(),
		"dependent",
		"AT",
		"$before",
		"$after"
	);

	$user->updateUserSession($id);

	header("location: /admin/user/profile$id");
	exit;
});

$app->post('/admin/address/update:id', function ($id) {

	$address = new Address();

	$log = new Logs();

	$address->listById((int)$id);

	$prev_address = $address->getValues();

	if ($address->verifyField("address_road", "Rua", 2, $_POST["address_road"], 2, "C"));
	if ($address->verifyField("address_number", "Numero", 1, $_POST["address_number"], 1, "C"));
	if ($address->verifyField("address_district", "Bairro", 3, $_POST["address_district"], 3, "C"));

	if (strlen($_POST["address_city"]) == 0) {
		$_POST["address_city"] = "Uruguaiana";
	}
	if (strlen($_POST["address_state"]) == 0) {
		$_POST["address_state"] = "RS";
	}
	if (strlen($_POST["address_complement"]) == 0) {
		$_POST["address_complement"] = "CASA";
	}
	if (strlen($_POST["address_cep"]) == 0) {
		$_POST["address_cep"] = "Nao informado";
	}

	$address->setData($_POST);

	$address->update($id);

	$before = implode(",", $prev_address);
	$after = implode(",", $address->getValues());
	$log->save(
		$_SESSION[User::SESSION]["user_id"],
		$_SESSION[User::SESSION]["user_name"],
		$address->getaddress_uniquetag(),
		$address->getaddress_id(),
		"dependent",
		"AT",
		"$before",
		"$after"
	);

	$conductor_id = $address->getconductor_id();

	header("location: /admin/conductor/profile$conductor_id");
	exit;
});

$app->post('/admin/dependent/update:id', function ($id) {

	$dependent = new Dependent();

	$log = new Logs();

	$dependent->listById((int)$id);

	$prev_dependent = $dependent->getValues();

	if (isset($_POST["conj"])) {
		$_POST["dependent_familiarity"] = "cônjuge";
	}
	if (isset($_POST["chil"])) {
		$_POST["dependent_familiarity"] = "filho/filha";
	}
	if (isset($_POST["par"])) {
		$_POST["dependent_familiarity"] = "pai/mãe";
	}
	if (isset($_POST["other"])) {
		$_POST["dependent_familiarity"] = $_POST["others"];
	}

	if ($dependent->verifyField("dependent_name", "Nome", 3, $_POST["dependent_name"], 3, "U", $dependent->getdependent_name()));

	if (strlen($_POST["dependent_age"]) == 0) {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Idade não informada";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

	if (strlen($_POST["dependent_familiarity"]) == 0) {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Familiaridade não informada";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

	if (strlen($_POST["dependent_identity"]) == 0) {
		$_POST["dependent_identity"] = "Não informado";
	}
	if (strlen($_POST["dependent_cpf"]) == 0) {
		$_POST["dependent_cpf"] = "Não informado";
	}
	if (strlen($_POST["dependent_phone"]) == 0) {
		$_POST["dependent_phone"] = "Não informado";
	}
	if (strlen($_POST["dependent_note"]) == 0) {
		$_POST["dependent_note"] = "Não informado";
	}
	if (strlen($_POST["dependent_schooling"]) == 0) {
		$_POST["dependent_schooling"] = "Não informado";
	}

	$dependent->setData($_POST);

	$dependent->update($id);

	$before = implode(",", $prev_dependent);
	$after = implode(",", $dependent->getValues());
	$log->save(
		$_SESSION[User::SESSION]["user_id"],
		$_SESSION[User::SESSION]["user_name"],
		$dependent->getdependent_name(),
		$dependent->getdependent_id(),
		"dependent",
		"AT",
		"$before",
		"$after"
	);


	header("location: /admin/dependent/profile$id");
	exit;
});

$app->post('/admin/carriage/update:id', function ($id) {

	$carriage = new Carriage();

	$log = new Logs();

	$carriage->listById((int)$id);

	$prev_carriage = $carriage->getValues();

	if ((int)($_FILES["carriage_frontalpicture"]["size"]) == 0) {
		$carriage->checkphoto("frontal");
	} else {
		$carriage->setPhoto($_FILES["carriage_frontalpicture"], "frontal");
	}

	if ((int)($_FILES["carriage_rightpicture"]["size"]) == 0) {
		$carriage->checkphoto("right");
	} else {
		$carriage->setPhoto($_FILES["carriage_rightpicture"], "right");
	}

	if ((int)($_FILES["carriage_leftpicture"]["size"]) == 0) {
		$carriage->checkphoto("left");
	} else {
		$carriage->setPhoto($_FILES["carriage_leftpicture"], "left");
	}

	if ((int)($_FILES["carriage_backpicture"]["size"]) == 0) {
		$carriage->checkphoto("back");
	} else {
		$carriage->setPhoto($_FILES["carriage_backpicture"], "back");
	}

	if ($carriage->verifyField("carriage_type", "Tipo", 5, $_POST["carriage_type"], 5, "C"));
	if ($carriage->verifyField("carriage_color", "Cor", 3, $_POST["carriage_color"], 3, "C"));
	if ($carriage->verifyField("carriage_numberofaxes", "Numero de eixos", 1, $_POST["carriage_numberofaxes"], 1, "C"));

	if (strlen($_POST["carriage_width"]) == 0) {
		$_POST["carriage_width"] = "Não informado";
	}
	if (strlen($_POST["carriage_length"]) == 0) {
		$_POST["carriage_length"] = "Não informado";
	}
	if (strlen($_POST["carriage_height"]) == 0) {
		$_POST["carriage_height"] = "Não informado";
	}
	if (strlen($_POST["carriage_note"]) == 0) {
		$_POST["carriage_note"] = "Não informado";
	}

	$carriage->setData($_POST);

	$carriage->update($id);

	$before = implode(",", $prev_carriage);
	$after = implode(",", $carriage->getValues());
	$log->save(
		$_SESSION[User::SESSION]["user_id"],
		$_SESSION[User::SESSION]["user_name"],
		$carriage->getcarriage_uniquetag(),
		$carriage->getcarriage_id(),
		"carriage",
		"AT",
		"$before",
		"$after"
	);


	header("location: /admin/carriage/profile$id");
	exit;
});

$app->post('/admin/animal/update:id', function ($id) {

	$animal = new Animal();

	$log = new Logs();

	$animal->listById((int)$id);

	$prev_animal = $animal->getValues();


	if (strlen($_POST["animal_name"]) == 0) {
		$_POST["animal_name"] = "Não informado";
	}
	if (strlen($_POST["animal_markings"]) == 0) {
		$_POST["animal_markings"] = "Não informado";
	}
	if (strlen($_POST["animal_note"]) == 0) {
		$_POST["animal_note"] = "Não informado";
	}

	if ($animal->verifyField("animal_species", "Espécie", 4, $_POST["animal_species"], 4, "C"));
	if ($animal->verifyField("animal_coat", "Pelagem", 4, $_POST["animal_coat"], 4, "C"));
	if ($animal->verifyField("animal_age", "Idade", 1, $_POST["animal_age"], 1, "C"));

	if ((int)($_FILES["animal_frontalpicture"]["size"]) == 0) {
		$animal->checkphoto("frontal");
	} else {
		$animal->setPhoto($_FILES["animal_frontalpicture"], "frontal");
	}

	if ((int)($_FILES["animal_rightpicture"]["size"]) == 0) {
		$animal->checkphoto("right");
	} else {
		$animal->setPhoto($_FILES["animal_rightpicture"], "right");
	}

	if ((int)($_FILES["animal_leftpicture"]["size"]) == 0) {
		$animal->checkphoto("left");
	} else {
		$animal->setPhoto($_FILES["animal_leftpicture"], "left");
	}

	if ((int)($_FILES["animal_backpicture"]["size"]) == 0) {
		$animal->checkphoto("back");
	} else {
		$animal->setPhoto($_FILES["animal_backpicture"], "back");
	}

	$animal->setData($_POST);

	$animal->update($id);

	$before = implode(",", $prev_animal);
	$after = implode(",", $animal->getValues());
	$log->save(
		$_SESSION[User::SESSION]["user_id"],
		$_SESSION[User::SESSION]["user_name"],
		$animal->getanimal_uniquetag(),
		$animal->getanimal_id(),
		"animal",
		"AT",
		"$before",
		"$after"
	);


	header("location: /admin/animal/profile$id");
	exit;
});

$app->post('/admin/conductor/update:id', function ($id) {

	$conductor = new Conductor();
	$log = new Logs();


	$conductor->get((int)$id);
	$prev_conductor = $conductor->getValues();

	if (isset($_POST["yes"])) {
		$_POST["conductor_socialbenefit"] = $_POST["benefit"];
	}
	if (isset($_POST["no"])) {
		$_POST["conductor_socialbenefit"] = "Nenhum";
	}

	if (strlen($_POST["conductor_identity"]) == 0) {
		$_POST["conductor_identity"] = "Não informado";
	}
	if (strlen($_POST["conductor_cpf"]) == 0) {
		$_POST["conductor_cpf"] = "Não informado";
	}
	if (strlen($_POST["conductor_schooling"]) == 0) {
		$_POST["conductor_schooling"] = "Não informado";
	}
	if (strlen($_POST["conductor_note"]) == 0) {
		$_POST["conductor_note"] = "Não informado";
	}
	if (strlen($_POST["conductor_familyincome"]) == 0) {
		$_POST["conductor_familyincome"] = "Não informado";
	}

	if ($conductor->verifyField("conductor_name", "Nome", 3, $_POST["conductor_name"], 3, "U", $conductor->getconductor_name()));
	if ($conductor->verifyField("conductor_age", "Idade", 1, $_POST["conductor_age"], 1, "U", $conductor->getconductor_age()));



	// if ((int)($_FILES["conductor_profilepicture"]["size"]) == 0) {
	// 	$conductor->checkphoto();
	// } else {
	// 	$conductor->setPhoto($_FILES["conductor_profilepicture"]);
	// }

	$conductor->setData($_POST);

	$before = implode(",", $prev_conductor);
	$after = implode(",", $conductor->getValues());
	$log->save(
		$_SESSION[User::SESSION]["user_id"],
		$_SESSION[User::SESSION]["user_name"],
		$conductor->getconductor_name(),
		$conductor->getconductor_id(),
		"conductor",
		"AT",
		"$before",
		"$after"
	);

	$conductor->update($id);

	header("location: /admin/conductor/profile$id");
	exit;
});

// Post update-end

// Post create

$app->post('/admin/user/create', function () {

	$user = new User();

	$user->setuser_uniquetag($user->getUniqueTag());

	if (isset($_POST["yes"])) {
		$_POST["user_isadmin"] = "1";
	} else	if (isset($_POST["no"])) {
		$_POST["user_isadmin"] = "0";
	} else {
		$_POST["user_isadmin"] = "0";
	}




	if ((int)($_FILES["user_profilepicture"]["size"]) == 0) {
		$user->checkphoto();
	} else {
		$user->setPhoto($_FILES["user_profilepicture"]);
	}



	if ($user->verifyField("user_name", "Nome", 3, $_POST["user_name"], 3, "C"));
	if ($user->verifyField("user_phone", "Telefone", 15, $_POST["user_phone"], 11, "C"));
	if ($user->verifyField("user_login", "Login", 6, $_POST["user_login"], 6, "C"));
	if ($user->verifyField("user_email", "Email", 1, $_POST["user_email"], 1, "C"));

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

	$log = new Logs();

	if ((int)$result > 0) {
		$before = "Registro novo";
		$after = implode(",", $user->getValues());
		$log->save(
			$_SESSION[User::SESSION]["user_id"],
			$_SESSION[User::SESSION]["user_name"],
			$user->getuser_name(),
			$result,
			"user",
			"RG",
			"$before",
			"$after"
		);
	} else {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Falha ao adicionar o usuario";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

	header("location: /admin/user/profile$result");
	exit;
});

$app->post('/admin/conductor/create', function () {

	$conductor = new Conductor();

	$conductor->setconductor_uniquetag($conductor->getUniqueTag());

	$_POST["conductor_socialbenefit"] = "Não informado";

	if (isset($_POST["yes"])) {
		$_POST["conductor_socialbenefit"] = $_POST["benefit"];
	}
	if (isset($_POST["no"])) {
		$_POST["conductor_socialbenefit"] = "Nenhum";
	}

	if (strlen($_POST["conductor_identity"]) == 0) {
		$_POST["conductor_identity"] = "Não informado";
	}
	if (strlen($_POST["conductor_cpf"]) == 0) {
		$_POST["conductor_cpf"] = "Não informado";
	}
	if (strlen($_POST["conductor_schooling"]) == 0) {
		$_POST["conductor_schooling"] = "Não informado";
	}
	if (strlen($_POST["conductor_note"]) == 0) {
		$_POST["conductor_note"] = "Não informado";
	}
	if (strlen($_POST["conductor_familyincome"]) == 0) {
		$_POST["conductor_familyincome"] = "Não informado";
	}
	if (strlen($_POST["conductor_phone"]) == 0) {
		$_POST["conductor_phone"] = "Não informado";
	}

	if ($conductor->verifyField("conductor_name", "Nome", 3, $_POST["conductor_name"], 3, "C"));
	if ($conductor->verifyField("conductor_identity", "Identitade", 0, $_POST["conductor_identity"], 0, "C"));
	if ($conductor->verifyField("conductor_phone", "Telefone", 0, $_POST["conductor_phone"], 0, "C"));
	if ($conductor->verifyField("conductor_cpf", "CPF", 0, $_POST["conductor_cpf"], 0, "C"));
	if ($conductor->verifyField("conductor_age", "Idade", 1, $_POST["conductor_age"], 1, "C"));



	if ((int)($_FILES["conductor_profilepicture"]["size"]) == 0) {
		$conductor->checkphoto("profile");
	} else {
		$conductor->setPhoto($_FILES["conductor_profilepicture"], "profile");
	}

	if ((int)($_FILES["conductor_cppicture"]["size"]) == 0) {
		$conductor->checkphoto("cp");
	} else {
		$conductor->setPhoto($_FILES["conductor_cppicture"], "cp");
	}

	if ((int)($_FILES["conductor_frontidentitypicture"]["size"]) == 0) {
		$conductor->checkphoto("frontal");
	} else {
		$conductor->setPhoto($_FILES["conductor_frontidentitypicture"], "frontal");
	}

	if ((int)($_FILES["conductor_backidentitypicture"]["size"]) == 0) {
		$conductor->checkphoto("back");
	} else {
		$conductor->setPhoto($_FILES["conductor_backidentitypicture"], "back");
	}

	$conductor->setData($_POST);

	$result = $conductor->create()["conductor_id"];

	$log = new Logs();

	if ((int)$result > 0) {
		$before = "Registro novo";
		$after = implode(",", $conductor->getValues());
		$log->save(
			$_SESSION[User::SESSION]["user_id"],
			$_SESSION[User::SESSION]["user_name"],
			$conductor->getconductor_name(),
			$result,
			"conductor",
			"RG",
			"$before",
			"$after"
		);
	} else {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Falha ao adicionar";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

	header("location: /admin/conductor/profile$result");
	exit;
});

$app->post('/admin/address/create:conductor_id', function ($conductor_id) {

	$address = new Address();

	$address->setaddress_uniquetag($address->getUniqueTag());

	if ($address->verifyField("address_road", "Rua", 2, $_POST["address_road"], 2, "C"));
	if ($address->verifyField("address_number", "Numero", 1, $_POST["address_number"], 1, "C"));
	if ($address->verifyField("address_district", "Bairro", 3, $_POST["address_district"], 3, "C"));

	if (strlen($_POST["address_city"]) == 0) {
		$_POST["address_city"] = "Uruguaiana";
	}
	if (strlen($_POST["address_state"]) == 0) {
		$_POST["address_state"] = "RS";
	}
	if (strlen($_POST["address_complement"]) == 0) {
		$_POST["address_complement"] = "CASA";
	}
	if (strlen($_POST["address_cep"]) == 0) {
		$_POST["address_cep"] = "Nao informado";
	}

	$address->setData($_POST);

	$result = $address->create($conductor_id)["address_id"];

	$log = new Logs();

	if ((int)$result > 0) {
		$before = "Registro novo";
		$after = implode(",", $address->getValues());
		$log->save(
			$_SESSION[User::SESSION]["user_id"],
			$_SESSION[User::SESSION]["user_name"],
			$address->getaddress_uniquetag(),
			$result,
			"address",
			"RG",
			"$before",
			"$after"
		);
	} else {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Falha ao adicionar";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

	header("location: /admin/conductor/profile$conductor_id");
	exit;
});

$app->post('/admin/dependent/create:conductor_id', function ($conductor_id) {

	$dependent = new Dependent();

	$dependent->setdependent_uniquetag($dependent->getUniqueTag());

	$_POST["dependent_familiarity"] = "";

	if (isset($_POST["conj"])) {
		$_POST["dependent_familiarity"] = "cônjuge";
	}
	if (isset($_POST["chil"])) {
		$_POST["dependent_familiarity"] = "filho/filha";
	}
	if (isset($_POST["par"])) {
		$_POST["dependent_familiarity"] = "pai/mãe";
	}
	if (isset($_POST["other"])) {
		$_POST["dependent_familiarity"] = $_POST["others"];
	}

	if ($dependent->verifyField("dependent_name", "Nome", 3, $_POST["dependent_name"], 3, "C"));


	if (strlen($_POST["dependent_age"]) == 0) {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Idade não informada";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

	if (strlen($_POST["dependent_familiarity"]) == 0) {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Familiaridade não informada";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

	if (strlen($_POST["dependent_identity"]) == 0) {
		$_POST["dependent_identity"] = "Não informado";
	}
	if (strlen($_POST["dependent_cpf"]) == 0) {
		$_POST["dependent_cpf"] = "Não informado";
	}
	if (strlen($_POST["dependent_phone"]) == 0) {
		$_POST["dependent_phone"] = "Não informado";
	}
	if (strlen($_POST["dependent_note"]) == 0) {
		$_POST["dependent_note"] = "Não informado";
	}
	if (strlen($_POST["dependent_schooling"]) == 0) {
		$_POST["dependent_schooling"] = "Não informado";
	}

	$dependent->setData($_POST);

	$result = $dependent->create($conductor_id)["dependent_id"];

	$log = new Logs();

	if ((int)$result > 0) {
		$before = "Registro novo";
		$after = implode(",", $dependent->getValues());
		$log->save(
			$_SESSION[User::SESSION]["user_id"],
			$_SESSION[User::SESSION]["user_name"],
			$dependent->getdependent_name(),
			$result,
			"dependent",
			"RG",
			"$before",
			"$after"
		);
	} else {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Falha ao adicionar";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

	header("location: /admin/dependent/profile$result");
	exit;
});

$app->post('/admin/carriage/create:conductor_id', function ($conductor_id) {

	$carriage = new Carriage();

	$carriage->setcarriage_uniquetag($carriage->getUniqueTag());


	if ($carriage->verifyField("carriage_type", "Tipo", 5, $_POST["carriage_type"], 5, "C"));
	if ($carriage->verifyField("carriage_color", "Cor", 3, $_POST["carriage_color"], 3, "C"));
	if ($carriage->verifyField("carriage_numberofaxes", "Numero de eixos", 1, $_POST["carriage_numberofaxes"], 1, "C"));

	if (strlen($_POST["carriage_width"]) == 0) {
		$_POST["carriage_width"] = "Não informado";
	}
	if (strlen($_POST["carriage_length"]) == 0) {
		$_POST["carriage_length"] = "Não informado";
	}
	if (strlen($_POST["carriage_height"]) == 0) {
		$_POST["carriage_height"] = "Não informado";
	}


	$carriage->setData($_POST);

	if ((int)($_FILES["carriage_frontalpicture"]["size"]) == 0) {
		$carriage->checkphoto("frontal");
	} else {
		$carriage->setPhoto($_FILES["carriage_frontalpicture"], "frontal");
	}

	if ((int)($_FILES["carriage_rightpicture"]["size"]) == 0) {
		$carriage->checkphoto("right");
	} else {
		$carriage->setPhoto($_FILES["carriage_rightpicture"], "right");
	}

	if ((int)($_FILES["carriage_leftpicture"]["size"]) == 0) {
		$carriage->checkphoto("left");
	} else {
		$carriage->setPhoto($_FILES["carriage_leftpicture"], "left");
	}

	if ((int)($_FILES["carriage_backpicture"]["size"]) == 0) {
		$carriage->checkphoto("back");
	} else {
		$carriage->setPhoto($_FILES["carriage_backpicture"], "back");
	}


	$result = $carriage->create($conductor_id)["carriage_id"];

	$log = new Logs();

	if ((int)$result > 0) {
		$before = "Registro novo";
		$after = implode(",", $carriage->getValues());
		$log->save(
			$_SESSION[User::SESSION]["user_id"],
			$_SESSION[User::SESSION]["user_name"],
			$carriage->getcarriage_uniquetag(),
			$result,
			"carriage",
			"RG",
			"$before",
			"$after"
		);
	} else {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Falha ao adicionar";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}


	header("location: /admin/carriage/profile$result");
	exit;
});

$app->post('/admin/animal/create:conductor_id', function ($conductor_id) {

	$animal = new Animal();

	$animal->setanimal_uniquetag($animal->getUniqueTag());

	if ($animal->verifyField("animal_species", "Espécie", 4, $_POST["animal_species"], 4, "C"));
	if ($animal->verifyField("animal_coat", "Pelagem", 4, $_POST["animal_coat"], 4, "C"));
	if ($animal->verifyField("animal_age", "Idade", 1, $_POST["animal_age"], 1, "C"));

	if (strlen($_POST["animal_name"]) == 0) {
		$_POST["animal_name"] = "Não informado";
	}
	if (strlen($_POST["animal_markings"]) == 0) {
		$_POST["animal_markings"] = "Não informado";
	}
	if (strlen($_POST["animal_note"]) == 0) {
		$_POST["animal_note"] = "Não informado";
	}


	if ((int)($_FILES["animal_frontalpicture"]["size"]) == 0) {
		$animal->checkphoto("frontal");
	} else {
		$animal->setPhoto($_FILES["animal_frontalpicture"], "frontal");
	}

	if ((int)($_FILES["animal_rightpicture"]["size"]) == 0) {
		$animal->checkphoto("right");
	} else {
		$animal->setPhoto($_FILES["animal_rightpicture"], "right");
	}

	if ((int)($_FILES["animal_leftpicture"]["size"]) == 0) {
		$animal->checkphoto("left");
	} else {
		$animal->setPhoto($_FILES["animal_leftpicture"], "left");
	}

	if ((int)($_FILES["animal_backpicture"]["size"]) == 0) {
		$animal->checkphoto("back");
	} else {
		$animal->setPhoto($_FILES["animal_backpicture"], "back");
	}

	$animal->setData($_POST);

	$result = $animal->create($conductor_id)["animal_id"];

	$log = new Logs();

	if ((int)$result > 0) {
		$before = "Registro novo";
		$after = implode(",", $animal->getValues());
		$log->save(
			$_SESSION[User::SESSION]["user_id"],
			$_SESSION[User::SESSION]["user_name"],
			$animal->getanimal_uniquetag(),
			$result,
			"animal",
			"RG",
			"$before",
			"$after"
		);
	} else {
		$tipo = "Erro";
		$sucesso = '0';
		$mensagem = "Falha ao adicionar";
		header("location: /admin/message?tipo=$tipo&sucesso=$sucesso&mensagem=$mensagem");
		exit;
	}

	header("location: /admin/animal/profile$result");
	exit;
});


// Post create-end


// Post app

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


