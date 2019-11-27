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
        /*
        ● Top five dealerships by earn
        ● Top five dealerships by customer base (count)
        ● Top five customers by spend paired with their dealer name
        ● Percentage total of qualifying customers with valid emails
        ● Total count of Ibex customers
         */
        $dashboard = ['topDealersBySales' => [
                ['dealer' => 'dealer 01', 'sales' => 1000],
                ['dealer' => 'dealer 02', 'sales' => 1005],
            ], 'topDealersByNumberCustomers' => [
                ['dealer' => 'dealer 01', 'qty' => 5],
                ['dealer' => 'dealer 02', 'qty' => 2],
            ], 'topCustomersBySales' => [
                ['customer' => 'customer 01', 'sales' => 55],
                ['customer' => 'customer 02', 'sales' => 52],
            ], 'customersWithValidEmails' => [
                ['percentage' => '82'],
            ], 'totalNumberOfCustomers' => [
                ['qty' => 13],
            ]
        ];
        $payload = json_encode($dashboard);

        $this->logger->info("Dashboard was viewed.");

        $this->response->getBody()->write($payload);
        return $this->response
            ->withHeader('Content-Type', 'application/json');
    }
}
