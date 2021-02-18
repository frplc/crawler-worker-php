<?php
declare(strict_types=1);
/**
 * Date: 13.02.21
 * Time: 1:12
 */
namespace App\ServiceDiscovery;

class ServiceDiscovery
{

    public function __construct()
    {
        $this->initConfig();
    }

    /**
     * Retrieve service discovery configuration data based on .env data
     */
    protected function initConfig()
    {
        // init
    }

    /**
     * Connect to ServiceDiscovery (load balancer) and receive needed queue url
     *
     * @return string
     */
    public function getCrawlerQueueUrl(): string
    {
        //Stub data
       return "https://crawler_queue_url";
    }



}
