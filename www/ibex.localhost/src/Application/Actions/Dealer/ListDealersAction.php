<?php
declare(strict_types=1);

namespace App\Application\Actions\Dealer;

use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;

class ListDealersAction extends DealerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $this->logger->info("Dealers list was viewed.");

        //$payload = $this->getDealersEndpoint();

        $db = $this->container->get('db');
        $sql = 'SELECT id, dealer_id, name, address, city, state, zip FROM dealer ORDER BY name';
        $query = $db->query($sql);
        $rows = [];
        foreach ($query as $row) {
            $rows[] = $row;
        }
        $payload = json_encode($rows);

        $this->response->getBody()->write($payload);
        return $this->response
            ->withHeader('Content-Type', 'application/json');
    }
}
