<?php
declare(strict_types=1);

namespace App\Application\Actions\Api\Dealer;

use App\Application\Actions\Action;
use App\Domain\User\UserRepository;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

abstract class DealerAction extends Action
{

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }

    public function getDealersEndpoint()
    {
        // read csv to mimic api output for now
        // TODO read sciusa dealer url
        // via file_get_contents .. nopes
        // or curl .. meh
        // or a composer package like guzzle .. yeah
        // maybe also nice to model dealer array as a model OM

        $dealers = [];
        if (($h = fopen(__DIR__ . "/../../../../../samples/Distinct Dealerships-Dealerships.csv", "r")) !== false)
        {
            $rowNbr = 0;
            while (($data = fgetcsv($h)) !== false)
            {
                if (empty($data) || $data[0] == null) continue; // empty line
                if ($rowNbr == 0 && $data[0] == "id") continue; // header
                $dealers[] = $data;
                $rowNbr++;
            }
            fclose($h);
        }
        $payload = json_encode($dealers);
        return $payload;
    }

}
