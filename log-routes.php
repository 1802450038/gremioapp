<?php

namespace gremio;

use gremio\Model\Logs;

$app->get('/admin/logs', function () {

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
	} elseif ($type == "partner" || $term == "Socios") {
		$type = "log_targetobject";
		$term = "partner";
	} elseif ($type == "dependent" || $term == "Dependentes") {
		$type = "log_targetobject";
		$term = "dependent";
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

$app->get('/admin/log/profile:id', function ($id) {

	$page = new PageAdmin();

	$log = new Logs();

	$log->get($id);

	$page->setTpl("log-profile", array(
		"registro" => $log->getValues()
	));
});

?>