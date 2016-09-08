<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
		'db' => [
				'driver' => 'Pdo',
				'dsn'    => sprintf('mysql:host=localhost;dbname=magnetic', realpath(getcwd())),
				'username' => 'root',
				'password' => ''
		],
];

/**
 * 
 *
	139.59.143.234
	root/123456
 */