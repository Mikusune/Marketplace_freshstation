<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = service('authentication');

        if (!$auth->check()) {
            return redirect()->to('/login');
        }

        // Get logged in user
        $user = $auth->user();
        $groups = $user->groups;

        // Check if user has admin role
        $isAdmin = false;
        foreach ($groups as $group) {
            if ($group['name'] === 'admin') {
                $isAdmin = true;
                break;
            }
        }

        // If not admin, redirect to home
        if (!$isAdmin) {
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No actions needed after
    }
}