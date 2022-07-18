<?php

namespace App\Models;


use CodeIgniter\Model;


class LeaderModel extends Model
{

    protected $table      = 'leader';
    protected $primaryKey = 'id_leader';

    protected $allowedFields = ['nama_leader', 'email_leader', 'foto_leader'];

    public function getLeader($id = false)
    {
        if ($id == false) {
            return $this->db->table('leader')
                ->get()->getResultArray();
        } else {
            return $this->db->table('leader')
                ->where('id_leader', $id)
                ->get()->getResultArray();
        }
    }
}
