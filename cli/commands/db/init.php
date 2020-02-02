<?php declare(strict_types=1);

return \wub\ServiceFactory::impl(function(\PDO $db): callable {
	return function(\wub\CliRequest $rq, \wub\CliResponse $rs) use($db) {
		$db->query('drop table if exists posts');
		$db->query('
			create table posts (
				id integer primary key,
				title text not null,
				summary text not null,
				md text not null,
				html text not null,
				tc integer not null,
				views integer not null
			)
		');
		return $rs->setOutput('done');
	};
})->args('services/db.php');