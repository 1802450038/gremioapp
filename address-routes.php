<?php

namespace gremio;

use gremio\Model\Address;

$app->get('/admin/address/delete:id', function ($id) {

	$address = new Address();

	$address->listById($id);

	$conductor_id = $address->getconductor_id();

	$address->delete();

	header("location: /admin/conductor/profile$conductor_id");
	exit;
});

$app->get('/admin/address/update:id', function ($id) {

	$page = new PageAdmin();

	$address = new Address();

	$address->listById($id);

	$page->setTpl("address-update", array(
		"endereco" => $address->getValues()
	));
});

$app->get('/admin/address/create:partner_id', function ($partner_id) {

	$page = new PageAdmin();

	$page->setTpl("address-create", array(
		"condutor" => $partner_id
	));
});

$app->post('/admin/address/update:id', function ($id) {

	$address = new Address();

	$address->listById((int)$id);

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

	$partner_id = $address->getpartner_id();

	header("location: /admin/partner/profile$partner_id");
	exit;
});

$app->post('/admin/address/create:partner_id', function ($partner_id) {

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



	$address->create($partner_id);

	header("location: /admin/partner/profile$partner_id");
	exit;
});

?>