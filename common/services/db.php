<?php declare(strict_types=1);

namespace common;

return \wub\ServiceFactory::impl(function(string $fileName): \PDO {
	static $db;

	if ($db === null) {
		$db = new \PDO('sqlite:' . $fileName);
	}

	return $db;
})->args(function(\wub\IServiceContainer $container): array {
	return [$container->config('db.fileName')];
});