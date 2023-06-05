<?php

namespace App\Services;

use App\Strategies\NovaPoshtaDeliveryStrategy;
use App\Strategies\UkrPoshtaDeliveryStrategy;

class DeliverService
{

    private $courier ;
    private $sendlerAddress;
    public function __construct($courier,$sendlerAddress)
    {
        $this->courier = $courier;
        $this->sendlerAddress = $sendlerAddress;
    }

    public function deliver($data)
    {
      //вибір способу доставки, можна робити це через БД

        switch ($this->courier){
            case 'novaposhta':
                $deliveryStrategy = new NovaPoshtaDeliveryStrategy($data,$this->sendlerAddress);
                break;
            case 'ukrposhta':
                $deliveryStrategy = new UkrPoshtaDeliveryStrategy($data,$this->sendlerAddress);
                break;
            default:
                throw new \Exception('Invalid courier');
        }

        return $deliveryStrategy->deliver();

    }


}
