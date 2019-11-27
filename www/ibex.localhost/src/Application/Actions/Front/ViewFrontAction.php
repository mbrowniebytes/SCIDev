<?php
declare(strict_types=1);

namespace App\Application\Actions\Front;

use Psr\Http\Message\ResponseInterface as Response;

class ViewFrontAction extends FrontAction
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
        <title>IBEX @ SCIUSA</title>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/assets/bundle/bundle.css" type="text/css">
    </head>
    <script type="text/javascript">
        let ibexApp = {
            testVar: true
        };
    </script>
    <body>
        <div id="app">Howdy</div>

        <script type="text/javascript" src="/assets/bundle/bundle.js" ></script>
    </body>
</html>
PAGE;

        $this->logger->info("Front was viewed.");

        $this->response->getBody()->write($page);
        return $this->response;
    }
}
