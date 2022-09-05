<?php

namespace gremio;

use gremio\Model\Address;
use gremio\Model\Dependent;
use gremio\Model\Partner;
use gremio\Model\Payment;


$app->get('/admin/partners', function () {
	$partners = Partner::listAll();
	foreach ($partners as $key => $value) {
		if($value["partner_monthlypayment"] != "ISENTO"){
			Payment::checkPayments($value["partner_id"]);
		}
	}

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$type = (isset($_GET['type'])) ? $_GET['type'] : "partner_fullname";
	$term = (isset($_GET['term'])) ? $_GET['term'] : "";

	$partner = new Partner();

	$pagination = $partner->listPertnersPageSearch($type, $term, $page);


	$pages = [];

	for ($i = 1; $i <= $pagination['pages']; $i++) {
		array_push($pages, [
			'link' => '/admin/partners?' . http_build_query([
				'page' => $i,
				'type' => $type,
				'term' => $term
			]),
			'text' => $i
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("partners", array(
		"socios" => $pagination["partners"],
		"pages" => $pages,
		"tipo" => $type,
		"termo" => $term
	));
});

$app->get('/admin/partner/delete:id', function ($id) {

	$partner = new Partner();

	$partner->get($id);

	$partner->delete();

	header("location: /admin/partners");
	exit;
});

$app->get('/admin/partner/update:id', function ($id) {

	$page = new PageAdmin();

	$partner = new Partner();

	$partner->get($id);

	$page->setTpl("partner-update", array(
		"socio" => $partner->getValues()
	));
});

$app->get('/admin/partner/create', function () {

	$page = new PageAdmin();

	$page->setTpl("partner-create");
});

$app->get('/admin/partner/profile:id', function ($id) {

	$page = new PageAdmin();

	$partner = new Partner();

	Partner::updatePaymentStatus($id);
	$partner->get($id);
	$address = Address::listByPartnerId($id);
	$dependents = Dependent::listByPartnerId($id);
	$payments = Payment::listByPartnerIdCount($id);
	Payment::checkPayments($id);
	
	
	$page->setTpl("partner-profile", array(
		"socio" => $partner->getValues(),
		"endereco" => $address,
		"dependentes" => $dependents,
		"pagamentos" => $payments
	));
});

$app->post('/admin/partner/update:id', function ($id) {

	$partner = new Partner();

	$partner->get((int)$id);

	if ($partner->verifyField("partner_fullname", "Nome", 3, $_POST["partner_fullname"], 3, "U", $partner->getpartner_fullname()));

	if (strlen($_POST["partner_mobphone"]) == 0) {
		$_POST["partner_phone"] = "Não informado";
	}
	if (strlen($_POST["partner_resphone"]) == 0) {
		$_POST["partner_phone"] = "Não informado";
	}

	$partner->setData($_POST);

	$partner->update($id);

	header("location: /admin/partner/profile$id");
	exit;
});

$app->post('/admin/partner/create', function () {

	$partner = new Partner();

	$partner->setpartner_uniquetag($partner->getUniqueTag());

	if (strlen($_POST["partner_mobphone"]) == 0) {
		$_POST["partner_phone"] = "Não informado";
	}
	if (strlen($_POST["partner_resphone"]) == 0) {
		$_POST["partner_phone"] = "Não informado";
	}

	$partner->setData($_POST);

	$result = $partner->create();

	header("location: /admin/partner/profile$result");

	exit;
});

?>