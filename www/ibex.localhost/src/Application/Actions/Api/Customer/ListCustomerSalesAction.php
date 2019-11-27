<?php
declare(strict_types=1);

namespace App\Application\Actions\Api\Customer;

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;

class ListCustomerSalesAction extends CustomerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $dealerId = $this->resolveArg('dealerId');

        $this->logger->info("Customer Sales list was viewed.");

        $payload = $this->getCustomerSalesEndpoint();
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
