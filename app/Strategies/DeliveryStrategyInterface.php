<?php

namespace App\Strategies;

interface DeliveryStrategyInterface
{
    public function __construct($data,$sendlerAddress);
    public function deliver();
}
