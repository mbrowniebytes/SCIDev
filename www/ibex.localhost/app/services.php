<?php
declare(strict_types=1);

use DI\Container;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (Container $container) {
    $container->set('db', function () use ($container) {
        $settings = $container->get('settings')["db"];

        $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'],
            $settings['user'], $settings['pass'], [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE =>  PDO::FETCH_ASSOC,
            ]);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    });
};
