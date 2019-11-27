<?php
declare(strict_types=1);

use App\Application\Actions\Api\Customer\ListCustomersAction;
use App\Application\Actions\Api\Customer\ListCustomerSalesAction;
use App\Application\Actions\Api\Customer\ViewCustomerAction;
use App\Application\Actions\Api\Customer\ViewCustomerSaleAction;
use App\Application\Actions\Front\ViewFrontAction;
use App\Application\Actions\Api\Dealer\ListDealersAction;
use App\Application\Actions\Api\Dealer\ViewDealerAction;
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

    $app->group('/api/dealers', function (Group $group) {
        $group->get('', ListDealersAction::class);
        $group->get('/{id}', ViewDealerAction::class);
    });

    $app->group('/api/customers/{dealerId}', function (Group $group) {
        $group->get('', ListCustomersAction::class);
        $group->get('/sales', ListCustomerSalesAction::class);
        $group->get('/{id}', ViewCustomerAction::class);
        $group->get('/sales/{id}', ViewCustomerSaleAction::class);
    });
};
