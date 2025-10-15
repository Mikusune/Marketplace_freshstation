<?php
namespace App\Libraries;

class Biteship
{
    private $apiKey = 'biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiZnJlc2hzdGF0aW9uIiwidXNlcklkIjoiNjhhNWEyMThlY2VhZDkwMDEyOTk2YWQyIiwiaWF0IjoxNzU1NjkwMzkxfQ.KM8jp9Or4rUQWgutDZXdTx7V3XXCnHzOc9b5WfF6enw';
    private $endpoint = 'https://api.biteship.com/v1/couriers/cost';

    public function getShippingCost($origin, $destination, $weight = 1, $couriers = null)
    {
        // Default: semua kurir
        $allCouriers = ['jne','pos','tiki','gojek','grab','lalamove'];
        if ($couriers === null) {
            if ($weight > 5) {
                // Berat di atas 5kg, hanya kurir kargo
                $couriers = ['lalamove','jne','pos','tiki'];
            } else {
                // Berat <= 5kg, semua kurir
                $couriers = $allCouriers;
            }
        }
        $payload = [
            'origin_latitude' => $origin['lat'],
            'origin_longitude' => $origin['lon'],
            'destination_latitude' => $destination['lat'],
            'destination_longitude' => $destination['lon'],
            'couriers' => $couriers,
            'items' => [
                [
                    'name' => 'Order',
                    'quantity' => 1,
                    'weight' => $weight * 1000 // Biteship expects gram
                ]
            ]
        ];
        $ch = curl_init($this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json'
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($response === false) {
            $error = curl_error($ch);
            log_message('error', '[Biteship CURL] Error: ' . $error);
        }
        curl_close($ch);
        if ($httpCode == 200) {
            return json_decode($response, true);
        }
        return null;
    }
}
