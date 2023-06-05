<?php

namespace App\Strategies;

class UkrPoshtaDeliveryStrategy implements DeliveryStrategyInterface
{

    private $data = [];

    public function deliver()
    {

    }

    public function __construct($data,$sendlerAddress)
    {
        // Відповідно до контракту, заповнюємо $this->data
    }
}
