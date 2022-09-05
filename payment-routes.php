<?php


namespace gremio;

use gremio\Model\Partner;
use gremio\Model\Payment;

$app->get('/admin/payments:partner_id', function ($partner_id) {

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$type = (isset($_GET['type'])) ? $_GET['type'] : "payment_id";
	$term = (isset($_GET['term'])) ? $_GET['term'] : "";
	$quantity = (isset($_GET['quantity'])) ? $_GET['quantity'] : 10;
	$mode = (isset($_GET['mode'])) ? $_GET['mode'] : "DESC";

	$payment = new Payment();

	$pagination = $payment->listPaymentsPageSearch($partner_id, $type, $term, $page, $quantity, $mode);

	$pages = [];

	for ($i = 1; $i <= $pagination['pages']; $i++) {
		array_push($pages, [
			'link' => '/admin/payments' . $partner_id . '?' . http_build_query([
				'page' => $i,
				'type' => $type,
				'term' => $term,
				'quantity' => $quantity,
				'mode' => $mode
			]),
			'text' => $i
		]);
	}

	$partnerName = Partner::getPartnerName($partner_id);

	$page = new PageAdmin();

	$page->setTpl("payments", array(
		"payments" => $pagination["payments"],
		"pages" => $pages,
		"tipo" => $type,
		"termo" => $term,
		"partner" => $partnerName
	));
});

$app->get('/admin/payment/pay:payment_id', function ($payment_id) {

	$page = new PageAdmin();

	$payment = new Payment();

	$payment->get($payment_id);

	$page->setTpl("payment-pay", array(
		"payment"=>$payment->getValues()
		
	));
});


$app->get('/admin/payment/profile:id', function ($id) {

	$page = new PageAdmin();

	$payment = new Payment();

	$payment->get($id);

	$page->setTpl("payment-profile", array(
		"pagamento" => $payment->getValues()
	));
});

$app->post('/admin/payment/pay:payment_id', function ($payment_id) {

	$payment = new Payment();

	$payment->get($payment_id);

	if (strlen($_POST["payment_payer"]) <= 0) {
		$_POST["payment_payer"] = "Titular";
	}

	if (strlen($_POST["payment_note"]) <= 0) {
		$_POST["payment_note"] = "Nenhuma observação";
	}

	if (strlen($_POST["payment_method"]) <= 0) {
		$_POST["payment_method"] = "Dinheiro";
	}


	$payment->setData($_POST);

	$partner_id = $payment->getpartner_id();

	$payment->pay($payment_id);

	header("location: /admin/partner/profile$partner_id");
	exit;
});
?>