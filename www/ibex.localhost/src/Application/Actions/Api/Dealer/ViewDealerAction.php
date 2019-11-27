<?php
declare(strict_types=1);

namespace App\Application\Actions\Api\Dealer;

use Psr\Http\Message\ResponseInterface as Response;

class ViewDealerAction extends DealerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $dealerId = $this->resolveArg('id');

        // TODO call sciusa endpoint to get one dealer
        // but for now parse over csv to try to find a match
        $payload = $this->getDealersEndpoint();
        $dealers = json_decode($payload);
        $dealer = array_filter($dealers, function($k) use ($dealerId) {
            return ($k[0] == $dealerId);
        });
        $payload = json_encode($dealer);

        $this->logger->info("Dealer of id `${dealerId}` was viewed.");

        $this->response->getBody()->write($payload);
        return $this->response
            ->withHeader('Content-Type', 'application/json');
    }
}
