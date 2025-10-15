<?php
namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Libraries\Biteship;

class ShippingController extends BaseController
{
    public function getOngkir()
    {
        $data = $this->request->getJSON();
        if (empty($data->origin_lat) || empty($data->origin_lon) || empty($data->dest_lat) || empty($data->dest_lon) || !isset($data->weight)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak lengkap']);
        }
        $biteship = new Biteship();
        log_message('info', '[Ongkir] Request: ' . json_encode($data));
        $result = $biteship->getShippingCost(
            ['lat' => $data->origin_lat, 'lon' => $data->origin_lon],
            ['lat' => $data->dest_lat, 'lon' => $data->dest_lon],
            $data->weight
        );
        log_message('info', '[Ongkir] Biteship response: ' . json_encode($result));
        if ($result && isset($result['couriers'])) {
            return $this->response->setJSON(['success' => true, 'data' => $result['couriers']]);
        }
        log_message('error', '[Ongkir] Gagal mengambil ongkir Biteship. Data: ' . json_encode($result));
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengambil ongkir Biteship', 'debug' => $result]);
    }
}
