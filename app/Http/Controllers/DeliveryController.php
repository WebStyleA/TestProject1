<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryRequest;
use App\Services\DeliverService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    private $sendlerAddress = "address";

    public function sendToCourier(DeliveryRequest $request)
    {
        $data = $request->validated();
        //В дані про посилку можна додати спосіб доставки та для нової доставки створити новий сервіс
        $deliveryService = new DeliverService('novaposhta', $this->sendlerAddress);
        $response = $deliveryService->deliver($data);
    }
}
