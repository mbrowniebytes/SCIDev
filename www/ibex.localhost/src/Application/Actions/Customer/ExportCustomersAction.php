<?php
declare(strict_types=1);

namespace App\Application\Actions\Customer;

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;
use League\Csv\Writer;

class ExportCustomersAction extends CustomerAction
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
        $sql = 'SELECT c.customer_id, c.name as customer_name, c.email 
            FROM customer c
            GROUP BY c.customer_id
            ORDER BY c.name';
        $query = $db->query($sql);
        $rows = [];
        foreach ($query as $row) {
            $csvRow = [$row['customer_id'], $row['customer_name'], $row['email']];
            $rows[] = $csvRow;
        }



        $filename = 'export_customers_'.date('YmdHi').'.csv';
        $header = ['customer id', 'customer name', 'email'];

        $csv = Writer::createFromString('');

        $csv->insertOne($header);

        $csv->insertAll($rows);

        $payload = $csv->getContent(); //returns the CSV document as a string

        $this->response->getBody()->write($payload);
        $this->response = $this->setHeaders($filename, strlen($payload));
        return $this->response;
    }

    function setHeaders($filename, $filesize=0)
    {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        $this->response = $this->response->withAddedHeader("Expires", "Tue, 01 Jan 2001 00:00:01 GMT");
        $this->response = $this->response->withAddedHeader("Cache-Control","max-age=0, no-cache, must-revalidate, proxy-revalidate");
        $this->response = $this->response->withAddedHeader("Last-Modified","{$now} GMT");

        // force download
        $this->response = $this->response->withAddedHeader("Content-Type","application/force-download");
        $this->response = $this->response->withAddedHeader("Content-Type","application/octet-stream");
        $this->response = $this->response->withAddedHeader("Content-Type","application/download");
        $this->response = $this->response->withAddedHeader("Content-Type","text/x-csv");

        // disposition / encoding on response body
        $this->response = $this->response->withAddedHeader("Content-Disposition","attachment; filename={$filename}");
        if ($filesize > 0)
            $this->response = $this->response->withAddedHeader("Content-Length", $filesize);
        $this->response = $this->response->withAddedHeader("Content-Transfer-Encoding","binary");
        $this->response = $this->response->withAddedHeader("Connection","close");
        return $this->response;
    }
}
