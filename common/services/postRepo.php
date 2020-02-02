<?php declare(strict_types=1);

namespace common;

return \wub\ServiceFactory::impl(function(\PDO $db): PostRepo {
	static $postRepo;

	if ($postRepo === null) {
		$postRepo = new PostRepo($db);
	}

	return $postRepo;
})->args('services/db.php');