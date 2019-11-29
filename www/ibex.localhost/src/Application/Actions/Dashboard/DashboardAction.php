<?php
declare(strict_types=1);

namespace App\Application\Actions\Dashboard;

use App\Application\Actions\Action;
use App\Domain\User\UserRepository;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

abstract class DashboardAction extends Action
{
    protected $container;

    public function __construct(LoggerInterface $logger, ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct($logger);
    }


}
