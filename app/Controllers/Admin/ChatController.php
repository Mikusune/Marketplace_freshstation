<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ChatModel;
use App\Models\UserModel;

class ChatController extends BaseController
{
    protected $chatModel;
    protected $userModel;
    
    public function __construct()
    {
        $this->chatModel = new ChatModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!in_groups('admin')) {
            return redirect()->to('/');
        }

        $data['title'] = 'Live Chat';
        $data['user'] = $this->userModel->find(user_id());
        $data['uri'] = service('uri');
        
        return view('templates_admin/header', $data)
            . view('templates_admin/sidebar', $data)
            . view('admin/chat', $data)
            . view('templates_admin/footer');
    }

    public function get_chat_list()
    {
        if (!$this->request->isAJAX() || !in_groups('admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        try {
            $chatList = $this->chatModel->getLatestChats();
            log_message('debug', 'Chat list query result: ' . json_encode($chatList));
            
            if (empty($chatList)) {
                log_message('debug', 'No chats found');
                return $this->response->setJSON([]);
            }

            // Get unread count for each user
            foreach ($chatList as &$chat) {
                $unreadCount = $this->chatModel->where('user_id', $chat['user_id'])
                    ->where('from_type', 'customer')
                    ->where('is_read', false)
                    ->countAllResults();
                
                $chat['unread_count'] = $unreadCount;
            }

            return $this->response->setJSON($chatList);
            
        } catch (\Exception $e) {
            log_message('error', '[ChatController::get_chat_list] ' . $e->getMessage());
            return $this->response->setJSON([]);
        }
    }

    public function get_messages($userId)
    {
        if (!$this->request->isAJAX() || !in_groups('admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        try {
            log_message('debug', 'Getting messages for user_id: ' . $userId);
            
            // Mark all messages from this user as read
            $this->chatModel->markAsRead($userId);

            // Get the last message ID if provided
            $afterId = $this->request->getGet('after');
            
            $query = $this->chatModel->where('user_id', $userId);
            
            // If afterId is provided, only get messages after that ID
            if ($afterId) {
                $query->where('id >', $afterId);
            }

            $messages = $query->orderBy('created_at', 'ASC')->findAll();

            log_message('debug', 'Found messages: ' . json_encode($messages));

            // Format timestamps and prepare response
            $formattedMessages = array_map(function($message) {
                $message['created_at'] = date('d M H:i', strtotime($message['created_at']));
                return $message;
            }, $messages);

            return $this->response->setJSON([
                'success' => true,
                'messages' => $formattedMessages
            ]);
                
        } catch (\Exception $e) {
            log_message('error', '[ChatController::get_messages] ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error retrieving messages'
            ]);
        }
    }

    public function get_unread_count()
    {
        if (!$this->request->isAJAX() || !in_groups('admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $unreadCount = $this->chatModel->getTotalUnreadCount();

        return $this->response->setJSON([
            'success' => true,
            'unread_count' => $unreadCount
        ]);
    }

    public function send_message()
    {
        if (!$this->request->isAJAX() || !in_groups('admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $json = $this->request->getJSON();
        $userId = $json->user_id ?? '';
        $message = $json->message ?? '';

        if (empty($userId) || empty($message)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User ID and message are required'
            ]);
        }

        $data = [
            'user_id' => $userId,
            'message' => $message,
            'from_type' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'is_read' => false
        ];

        $saved = $this->chatModel->insert($data);

        return $this->response->setJSON([
            'success' => $saved ? true : false,
            'message' => $saved ? 'Message sent successfully' : 'Failed to send message'
        ]);
    }
}