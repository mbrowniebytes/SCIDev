<?php
declare(strict_types=1);

namespace App\Application\Actions\Dealer;

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

        $payload = $this->getDealersEndpoint();

        $this->response->getBody()->write($payload);
        return $this->response
            ->withHeader('Content-Type', 'application/json');
    }
}
