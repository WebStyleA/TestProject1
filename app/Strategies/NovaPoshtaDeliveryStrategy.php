<?php

namespace App\Strategies;

use App\Log;
use App\NovaPoshtaLog;

class NovaPoshtaDeliveryStrategy implements DeliveryStrategyInterface
{

    private $data = [];

    public function __construct($data, $sendlerAddress)
    {
        $this->data = [
            'customer_name' => $data['customer_name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'sender_address' => $sendlerAddress,
            'delivery_address' => $data['delivery_address'],
        ];

    }


    public function deliver()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post('http://novaposhta.test/api/delivery', ['json' => $this->data]);

            if ($response->getStatusCode() != 200) {
                throw new \Exception('Invalid status code');
            }

            $body = $response->getBody();
            $result = json_decode($body, true);

            if (!isset($result['status']) || $result['status'] != 'success') {
                throw new \Exception('Unsuccessful delivery attempt');
            }


            $novaposhtaLog = new NovaPoshtaLog($this->data);

            if (!$novaposhtaLog->save()) {
                throw new \Exception('Failed to save NovaPoshta log');
            }


            $log = new Log([
                'message' => 'Delivery created',
                'context' => json_encode($this->data),
            ]);

            $log->loggable()->associate($novaposhtaLog);

            if (!$log->save()) {
                throw new \Exception('Failed to save log');
            }

            return true;

        } catch (\Exception $e) {
            return false;
        }
    }


}
