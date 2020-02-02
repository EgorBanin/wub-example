<?php declare(strict_types=1);

return [
	'~^get /$~' => 'actions/index.php',
	'~^(?<method>(get|post)) /(?<dir>.+)$~' => 'actions/{dir}/{method}.php',
];