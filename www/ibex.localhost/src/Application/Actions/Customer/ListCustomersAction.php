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
        // $dealerId = $this->resolveArg('dealerId');

        $this->logger->info("Customers list was viewed.");

//        $payload = $this->getCustomersEndpoint();
//        // get just the dealers customers
//        // hopefully endpoint would directly support
//        $customers = json_decode($payload);
//        $dealerCustomers = array_filter($customers, function($k) use ($dealerId) {
//            return ($k[0] == $dealerId);
//        });

        $db = $this->container->get('db');
        $sql = 'SELECT c.id, c.dealer_id, d.name as dealer_name, c.customer_id, c.name as customer_name, c.email 
            FROM customer c
            JOIN dealer d ON d.dealer_id = c.dealer_id 
            ORDER BY c.name';
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
