<?php declare(strict_types=1);

return \wub\ServiceFactory::impl(function(Posts $postRepo): callable {
	return function(\wub\HttpRequest $rq, \wub\HttpResponse $rs) use($postRepo) {
		$posts = $postRepo->selectTop(10);

		return $rs->setBody(
			\funct_all\ob_include(__DIR__ . '/index.phtml', [
				'posts' => $posts,
			])
		);
	}
})->args('services/postRepo.php');