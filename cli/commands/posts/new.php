<?php declare(strict_types=1);

return \wub\ServiceFactory::impl(function(\common\PostRepo $postRepo): callable {
	return function(\wub\CliRequest $rq, \wub\CliResponse $rs) use($postRepo) {
		$input = trim($rq->getInput());
		if (empty($input)) {
			return new \wub\CliResponse(403, 'Некорректный ввод');
		}

		$titleMd = \strtok($input, "\n");
		\strtok("\n");
		$summaryMd = \strtok("\n");

		$post = new \common\Post();
		$post->title = $titleMd;
		$post->summary = $summaryMd;
		$post->md = $input;
		$post->html = $input;
		$post->tc = time();
		$post->views = 0;
		$id = $postRepo->save($post);

		return $rs->setOutput($id);
	};
})->args('services/postRepo.php');