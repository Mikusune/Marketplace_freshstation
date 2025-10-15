<?php
use App\Models\ReturnModel;

if (!function_exists('get_return_by_order')) {
    function get_return_by_order($order_id, $user_id = null) {
        $returnModel = new ReturnModel();
        $where = ['order_id' => $order_id];
        if ($user_id !== null) {
            $where['user_id'] = $user_id;
        }
        return $returnModel->where($where)->orderBy('created_at', 'DESC')->first();
    }
}
