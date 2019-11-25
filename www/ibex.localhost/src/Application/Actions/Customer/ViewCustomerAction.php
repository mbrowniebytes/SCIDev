<?php
declare(strict_types=1);

namespace App\Application\Actions\Customer;

use Psr\Http\Message\ResponseInterface as Response;

class ViewCustomerAction extends CustomerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $dealerId = $this->resolveArg('dealerId');
        $customerId = $this->resolveArg('id');

        // TODO call sciusa endpoint to get one customer
        // but for now parse over csv to try to find a match
        $payload = $this->getCustomersEndpoint();
        // get just the dealers customers
        // hopefully endpoint would directly support
        $customers = json_decode($payload);
        $dealerCustomers = array_filter($customers, function($k) use ($dealerId) {
            // 0 dealership_id
            return ($k[0] == $dealerId);
        });
        // now filter by customer id .. maybe dup ids across dealers?
        $customer = array_filter($dealerCustomers, function($k) use ($customerId) {
            // 2 customer_number .. yeah object model would be btr
            // Slim Domain? .. or maybe sciusa has a pattern already
            return ($k[2] == $customerId);
        });
        $payload = json_encode($customer);

        $this->logger->info("Customer of id `${customerId}` was viewed.");

        $this->response->getBody()->write($payload);
        return $this->response
            ->withHeader('Content-Type', 'application/json');
    }
}
