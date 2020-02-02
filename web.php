<?php declare(strict_types=1);

namespace wub;

require __DIR__ . '/vendor/autoload.php';

$routes = require __DIR__ . '/web/routes.php';
$router = new Router($routes)
$config = require __DIR__ . '/config.php';
$conteiner = new \wub\ServiceContainer(
	$config,
	[
		'services/' => __DIR__ . '/common/services',
		'actions/' => __DIR__ . '/web/actions',
	]
);
$app = new \wub\App($router, $conteiner);
$rq = \wub\HttpRequest::fromGlobals($_SERVER, $_GET, $_POST, $_FILES, $_COOKIE, 'php://input');
$rs = \wub\HttpResponse::ok();
$exitCode = $app->run($rq, $rs);
exit $exitCode;