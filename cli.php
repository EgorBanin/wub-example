<?php declare(strict_types=1);

namespace wub;

require __DIR__ . '/vendor/autoload.php';

$routes = require __DIR__ . '/cli/routes.php';
$router = new Router($routes);
$config = require __DIR__ . '/common/config.php';
$conteiner = new ServiceContainer(
	$config,
	[
		'services/' => __DIR__ . '/common/services',
		'commands/' => __DIR__ . '/cli/commands',
	]
);
$app = new App($router, $conteiner);
\array_shift($argv);
$rq = new CliRequest($argv, \stream_get_contents(\STDIN)); // \stream_get_contents(\STDIN)
$rs = new CliResponse(0, '');
$exitCode = $app->run($rq, $rs);
exit($exitCode);