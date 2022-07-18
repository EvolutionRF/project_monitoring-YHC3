<?php

namespace App\Models;


use CodeIgniter\Model;


class ProjectModel extends Model
{

    protected $table      = 'project';
    protected $primaryKey = 'id_project';

    protected $allowedFields = ['nama_project', 'client_project', 'id_leader', 'start_date', 'end_date', 'progress'];

    public function getProject($id = false)
    {
        if ($id == false) {
            return $this->db->table('project')
                ->join('leader', 'leader.id_leader = project.id_leader')
                ->get()->getResultArray();
        } else {
            return $this->db->table('project')
                ->join('leader', 'leader.id_leader = project.id_leader')
                ->where('id_project', $id)
                ->get()->getResultArray();
        }
    }
}
