<?php
declare(strict_types=1);

namespace App\Application\Actions\Dashboard;

use Psr\Http\Message\ResponseInterface as Response;

class ViewDashboardAction extends DashboardAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        // TODO read from db .. join dealer, customer, customer_sale
        $dashboard = ['topDealersBySales' => [
                ['dealer' => 'dealer 01', 'sales' => '$'.number_format(3100.1, 2)],
                ['dealer' => 'dealer 02', 'sales' => '$'.number_format(17110.05, 2)],
            ], 'topDealersByNumberCustomers' => [
                ['dealer' => 'dealer 01', 'qty' => 5],
                ['dealer' => 'dealer 02', 'qty' => 2],
            ], 'topCustomersBySales' => [
                ['customer' => 'customer 01', 'sales' => '$'.number_format(1255, 2)],
                ['customer' => 'customer 02', 'sales' => '$'.number_format(152, 2)],
            ], 'customersWithValidEmails' =>
                ['percentage' => '82']
            , 'totalNumberOfCustomers' =>
                ['qty' => 13]
        ];
        $payload = json_encode($dashboard);

        $this->logger->info("Dashboard was viewed.");

        $this->response->getBody()->write($payload);
        return $this->response
            ->withHeader('Content-Type', 'application/json');
    }
}
