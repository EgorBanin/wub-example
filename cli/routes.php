<?php declare(strict_types=1);

return [
	'~^$~' => 'commands/help.php',
	'~^(?<path>\S+)$~' => 'commands/{path}/default.php',
	'~^(?<path>\S+)\s+(?<method>\S+)(\s+(?<opts>.*))?$~' => 'commands/{path}/{method}.php',
];