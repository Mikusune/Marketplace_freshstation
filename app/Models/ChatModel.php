<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = 'chat_messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'message', 'from_type', 'created_at', 'is_read'];
    protected $useTimestamps = false;
    
    public function getLatestChats()
    {
        $subquery = $this->db->table($this->table)
            ->select('MAX(id) as latest_id')
            ->groupBy('user_id');

        return $this->db->table($this->table . ' cm1')
            ->select('cm1.*, users.username, users.id as user_id, cm1.created_at as last_message_time')
            ->join('users', 'users.id = cm1.user_id')
            ->join('(' . $subquery->getCompiledSelect() . ') cm2', 'cm1.id = cm2.latest_id')
            ->orderBy('cm1.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getUnreadCount($userId = null)
    {
        $query = $this->where('from_type', 'customer')
                     ->where('is_read', false);
                     
        if ($userId) {
            $query->where('user_id', $userId);
        }
        
        return $query->countAllResults();
    }

    public function getTotalUnreadCount()
    {
        return $this->where('from_type', 'customer')
                    ->where('is_read', false)
                    ->countAllResults();
    }

    public function markAsRead($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('from_type', 'customer')
                    ->where('is_read', false)
                    ->set(['is_read' => true])
                    ->update();
    }
    
    public function getUserMessages($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }
}