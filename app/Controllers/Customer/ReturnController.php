<?php
namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\ReturnModel;

class ReturnController extends BaseController
{
    public function submit()
    {
        $validation =  \Config\Services::validation();
        $rules = [
            'order_id' => 'required|integer',
            'reason' => 'required|string',
            'photo' => 'uploaded[photo]|is_image[photo]|max_size[photo,2048]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $photoFile = $this->request->getFile('photo');
        $photoName = null;
        if ($photoFile && $photoFile->isValid() && !$photoFile->hasMoved()) {
            $photoName = $photoFile->getRandomName();
            $photoFile->move('uploads/returns', $photoName);
        }

        $returnModel = new ReturnModel();
        $returnModel->insert([
            'order_id' => $this->request->getPost('order_id'),
            'user_id' => user_id(),
            'reason' => $this->request->getPost('reason'),
            'photo' => $photoName,
            'status' => 'pending',
            'return_type' => $this->request->getPost('return_type'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/customer/orders')->with('pesan', 'Pengajuan pengembalian berhasil dikirim.');
    }
}
