<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use SensioLabs\Consul\ServiceFactory;
use SensioLabs\Consul\Services\AgentInterface;

class RegistServices extends Controller
{
    public function test()
    {
        echo 'OK';
    }

    public function registConsul()
    {
        $arr = array(
            "ID" => "test-webservices1",
          "Name" => "test-webservices",
          "Address" => "hb.oriana.id",
          "Port" => 8500,
          "EnableTagOverride" => false,
          "Check" => array(
              "DeregisterCriticalServiceAfter" => "90m",
              "HTTP" => "http://localhost:8080/health",
              "Interval" => "10s"
          ),
          "Weights" => array(
              "Passing" => 10,
              "Warning" => 1
          )
        );

        $param = json_encode($arr);
        echo $param;

        $sf = new ServiceFactory();
        $regist = $sf->get(AgentInterface::class);
        $regist->registerService($param);
    }
}