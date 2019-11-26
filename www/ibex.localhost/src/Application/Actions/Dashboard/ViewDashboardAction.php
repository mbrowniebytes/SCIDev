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
        $page = <<< PAGE
<!doctype html>
<html lang="en">
    <head>
        <title>IBEX Dashboard</title>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/assets/css/app.css" type="text/css">
    </head>
    <script type="text/javascript">
        let ibexApp = {
            logged: true
        };
    </script>
    <body>
        Howdy

        <div id="app"></div>

        <script type="text/javascript" src="/assets/bundle/main.bundle.js" ></script>

    </body>
</html>
PAGE;

        $this->logger->info("Dashboard was viewed.");

        $this->response->getBody()->write($page);
        return $this->response;
    }
}
