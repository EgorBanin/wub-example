<?php declare(strict_types=1);

return \wub\ServiceFactory::impl(function(): callable {
	return function(\wub\CliRequest $rq, \wub\CliResponse $rs) {
		return $rs->setOutput(
			\func_all\ob_include(__DIR__ . '/help.txt', [])
		);
	};
});