<?php

namespace gremio;

use gremio\Model\Partner;
use gremio\Model\Dependent;
use gremio\Model\Logs;

$app->get('/admin/dependent/delete:id', function ($id) {

	$dependent = new Dependent();

	$dependent->listById($id);

	$partner_id = $dependent->getpartner_id();

	$dependent->delete();

	header("location: /admin/partner/profile$partner_id");
	exit;
});

$app->get('/admin/dependent/update:id', function ($id) {

	$page = new PageAdmin();

	$dependent = new Dependent();

	$dependent->listById($id);

	$familiarity = $dependent->getdependent_familiarity();

	$page->setTpl("dependent-update", array(
		"dependente" => $dependent->getValues(),
		"familiaridade" => $familiarity
	));
});


$app->get('/admin/dependent/create:partner_id', function ($partner_id) {

	$page = new PageAdmin();

	$page->setTpl("dependent-create");
});

$app->get('/admin/dependent/profile:id', function ($id) {

	$page = new PageAdmin();

	$dependent = new Dependent();

	$dependent->listById($id);

	$partnerName = Partner::getPartnerName($dependent->getpartner_id());

	$page->setTpl("dependent-profile", array(
		"dependente" => $dependent->getValues(),
		"socio" => $partnerName
	));
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

	header("location: /admin/dependent/profile$id");
	exit;
});

$app->post('/admin/dependent/create:partner_id', function ($conductor_id) {

	$dependent = new Dependent();

	$dependent->setdependent_uniquetag($dependent->getUniqueTag());

	if ($dependent->verifyField("dependent_fullname", "Nome", 3, $_POST["dependent_fullname"], 3, "C"));

	$dependent->setData($_POST);

	$result = $dependent->create($conductor_id)["dependent_id"];

	header("location: /admin/dependent/profile$result");
	exit;
});


?>