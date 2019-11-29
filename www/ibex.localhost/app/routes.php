<?php
declare(strict_types=1);

use App\Application\Actions\Api\Customer\ApiListCustomersAction;
use App\Application\Actions\Api\Customer\ApiListCustomerSalesAction;
use App\Application\Actions\Api\Customer\ApiViewCustomerAction;
use App\Application\Actions\Api\Customer\ApiViewCustomerSaleAction;
use App\Application\Actions\Customer\ExportCustomersAction;
use App\Application\Actions\Customer\ListCustomersAction;
use App\Application\Actions\Dashboard\ViewDashboardAction;
use App\Application\Actions\Dealer\ListDealersAction;
use App\Application\Actions\Dealer\ViewDealerAction;
use App\Application\Actions\Front\ViewFrontAction;
use App\Application\Actions\Api\Dealer\ApiListDealersAction;
use App\Application\Actions\Api\Dealer\ApiViewDealerAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', ViewFrontAction::class);
    // TODO these should load appropriate component instead of just /
    $app->get('/dashboard', ViewFrontAction::class);
    $app->get('/dealers', ViewFrontAction::class);
    $app->get('/customers', ViewFrontAction::class);
    $app->get('/settings', ViewFrontAction::class);
    $app->get('/contact', ViewFrontAction::class);

    $app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    // data feeds for front end
    $app->group('/data/dashboard', function (Group $group) {
        $group->get('', ViewDashboardAction::class);
    });

    $app->group('/data/dealers', function (Group $group) {
        $group->get('', ListDealersAction::class);
        //$group->get('/{id}', ViewDealerAction::class);
    });

    $app->group('/data/customers', function (Group $group) {
        $group->get('', ListCustomersAction::class);
        //$group->get('/{id}', ViewCustomerAction::class);
        $group->post('/export', ExportCustomersAction::class);
    });

    // api to fetch and process csvs
    $app->group('/api/dealers', function (Group $group) {
        $group->get('', ApiListDealersAction::class);
        $group->get('/{id}', ApiViewDealerAction::class);
    });

    $app->group('/api/customers/{dealerId}', function (Group $group) {
        $group->get('', ApiListCustomersAction::class);
        $group->get('/sales', ApiListCustomerSalesAction::class);
        $group->get('/{id}', ApiViewCustomerAction::class);
        $group->get('/sales/{id}', ApiViewCustomerSaleAction::class);
    });
};
