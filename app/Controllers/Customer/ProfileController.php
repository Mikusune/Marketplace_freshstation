<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\Request;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!logged_in()) {
            return redirect()->to('/login');
        }

        $data = [
            'user' => $this->userModel->find(user_id()),
            'validation' => \Config\Services::validation(),
            'is_admin' => in_groups('admin')
        ];

        return view('templates_customer/header', $data)
            . view('customer/profile', $data)
            . view('templates_customer/footer');
    }

    public function update()
    {
        if (!logged_in()) {
            return redirect()->to('/login');
        }

        $rules = [
            'fullname' => 'required|alpha_space|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email,id,'.user_id().']'
        ];

        $messages = [
            'email' => [
                'is_unique' => 'This email is already registered to another account.'
            ],
            'fullname' => [
                'required' => 'Full name is required.',
                'alpha_space' => 'Full name can only contain letters and spaces.',
                'min_length' => 'Full name must be at least 3 characters long.',
                'max_length' => 'Full name cannot exceed 255 characters.'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = user_id();
        $data = [
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email')
        ];

        try {
            $this->userModel->update($userId, $data);
            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Failed to update profile. Please try again.');
        }
    }
}
