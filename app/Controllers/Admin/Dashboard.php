<?php
namespace App\Controllers\Admin;

use App\Models\Rental_model;
use App\Models\Mobil_model;
use App\Models\ItemModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Controllers\BaseController;
use Myth\Auth\Models\UserModel;

class Dashboard extends BaseController
{   
    protected $rentalModel;
    protected $db;
    protected $userModel;
    protected $itemModel;
    protected $orderModel;
    protected $orderItemModel;

    public function __construct()
    {
        $this->rentalModel = new Rental_model();
        $this->db = \Config\Database::connect();
        $this->userModel = new UserModel();
        $this->itemModel = new ItemModel();
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
    }

    public function index()
    {   
        // Ambil data user yang sedang login
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
        }

        // Menghitung statistik dasar
        $total_products = $this->itemModel->countAll();
        $total_customers = $this->userModel->where('role !=', 'admin')->countAll();
        $total_orders = $this->orderModel->countAll();
        $completed_orders = $this->orderModel->where('transaction_status', 'settlement')->countAll();

        // Mengambil 5 pesanan terbaru
        $recent_orders = $this->orderModel
            ->select('orders.*, users.username, users.email')
            ->join('users', 'users.id = orders.user_id')
            ->orderBy('orders.created_at', 'DESC')
            ->limit(5)
            ->find();

        // Menghitung pendapatan hari ini
        $today = date('Y-m-d');
        $today_revenue = $this->orderModel
            ->where('DATE(created_at)', $today)
            ->where('transaction_status', 'settlement')
            ->selectSum('gross_amount')
            ->first();

        // Mengambil 5 produk terlaris
        $best_selling = $this->orderItemModel
            ->select('item.*, COUNT(order_items.item_id) as total_sold')
            ->join('item', 'item.id_item = order_items.item_id')
            ->groupBy('order_items.item_id')
            ->orderBy('total_sold', 'DESC')
            ->limit(5)
            ->find();

        $data = [
            'user' => $user,
            'total_products' => $total_products,
            'total_customers' => $total_customers,
            'total_orders' => $total_orders,
            'completed_orders' => $completed_orders,
            'recent_orders' => $recent_orders,
            'today_revenue' => $today_revenue->gross_amount ?? 0,
            'best_selling' => $best_selling
        ];

        return view('templates_admin/header', ['user' => $user])
            . view('templates_admin/sidebar')
            . view('admin/Dashboard', $data)
            . view('templates_admin/footer');
    }

    public function logout()
    {
        $auth = service('authentication');

        if ($auth->check()) {
            $auth->logout();
        }

        return redirect()->to(site_url('/'))->with('message', 'Anda telah logout.');
    }
}
