<?php
declare(strict_types=1);

namespace App\Application\Actions\Customer;

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;

class ListCustomersAction extends CustomerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $dealerId = $this->resolveArg('dealerId');

        $this->logger->info("Customers list was viewed.");

        $payload = $this->getCustomersEndpoint();
        // get just the dealers customers
        // hopefully endpoint would directly support
        $customers = json_decode($payload);
        $dealerCustomers = array_filter($customers, function($k) use ($dealerId) {
            return ($k[0] == $dealerId);
        });
        $payload = json_encode($dealerCustomers);

        $this->response->getBody()->write($payload);
        return $this->response
            ->withHeader('Content-Type', 'application/json');
    }
}
