<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\ChatModel;

class ChatController extends BaseController
{
    protected $chatModel;
    
    public function __construct()
    {
        $this->chatModel = new ChatModel();
    }

    public function get_messages()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('/');
        }

        if (!logged_in()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first']);
        }

        try {
            $userId = user_id();
            $messages = $this->chatModel->where('user_id', $userId)
                ->orderBy('created_at', 'ASC')
                ->findAll();

            // Format messages
            $formattedMessages = array_map(function($message) {
                $message['created_at'] = date('Y-m-d H:i:s', strtotime($message['created_at']));
                return $message;
            }, $messages);

            return $this->response->setJSON([
                'success' => true,
                'messages' => $formattedMessages
            ]);
        } catch (\Exception $e) {
            log_message('error', '[CustomerChat::get_messages] ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error retrieving messages'
            ]);
        }
    }

    public function send_message()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        if (!logged_in()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first']);
        }

        try {
            $json = $this->request->getJSON();
            $message = $json->message ?? '';

            if (empty($message)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Message is required'
                ]);
            }

            $data = [
                'user_id' => user_id(),
                'message' => $message,
                'from_type' => 'customer',
                'created_at' => date('Y-m-d H:i:s'),
                'is_read' => false
            ];

            $messageId = $this->chatModel->insert($data);

            if ($messageId) {
                // Get the complete message data including ID
                $messageData = $this->chatModel->find($messageId);
                $messageData['created_at'] = date('Y-m-d H:i:s', strtotime($messageData['created_at']));

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Message sent successfully',
                    'data' => $messageData
                ]);
            }

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to send message'
            ]);

        } catch (\Exception $e) {
            log_message('error', '[CustomerChat::send_message] ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error sending message'
            ]);
        }
    }

    public function get_unread_count()
    {
        if (!$this->request->isAJAX() || !logged_in()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $unreadCount = $this->chatModel
            ->where('user_id', user_id())
            ->where('from_type', 'admin')
            ->where('is_read', false)
            ->countAllResults();

        return $this->response->setJSON([
            'success' => true,
            'unread_count' => $unreadCount
        ]);
    }
}