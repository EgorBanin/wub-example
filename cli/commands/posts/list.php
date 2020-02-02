<?php declare(strict_types=1);

return \wub\ServiceFactory::impl(function(\common\PostRepo $postRepo): callable {
	return function(\wub\CliRequest $rq, \wub\CliResponse $rs) use($postRepo) {
		$limit = 10;
		$posts = $postRepo->all($limit);
		return $rs->setOutput(\func_all\ob_include(__DIR__ . '/list.txt', [
			'posts' => $posts,
		]));
	};
})->args('services/postRepo.php');