<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\LeaderModel;

class Home extends BaseController
{
    protected $projectModel;
    protected $leaderModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->leaderModel = new LeaderModel();
    }

    public function index()
    {
        $leaderModel = $this->leaderModel->getLeader();
        $projectModel = $this->projectModel->getProject();
        // dd($projectModel);
        $data = [
            'leader' => $leaderModel,
            'project' => $projectModel,
            'title' => 'Data Project'
        ];

        return view('home', $data);
    }

    public function save()
    {
        $projectName = $this->request->getVar('Project-name');
        $clientName = $this->request->getVar('Client-name');
        $ID_leader = $this->request->getVar('id_Leader');
        $start_date = $this->request->getVar('Start_date');
        $end_date = $this->request->getVar('End_date');
        $progress = $this->request->getVar('progress');

        $this->projectModel->save([
            'nama_project' => $projectName,
            'client_project' => $clientName,
            'id_leader' => $ID_leader,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'progress' => $progress,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('home'));
    }
    public function edit()
    {
        $idProject = $this->request->getVar('UId-Project');
        $projectName = $this->request->getVar('UProject-name');
        $clientName = $this->request->getVar('UClient-name');
        $ID_leader = $this->request->getVar('Uid_Leader');
        $start_date = $this->request->getVar('UStart_date');
        $end_date = $this->request->getVar('UEnd_date');
        $progress = $this->request->getVar('Uprogress');

        $this->projectModel->save(
            [
                'id_project' => $idProject,
                'nama_project' => $projectName,
                'client_project' => $clientName,
                'id_leader' => $ID_leader,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'progress' => $progress,
            ]
        );

        session()->setFlashdata('pesanWarn', 'Data Project Berhasil Diubah');
        return redirect()->to('/home');
    }

    public function delete()
    {
        $id = $this->request->getVar('DId-Project');
        $this->projectModel->delete($id);

        session()->setFlashdata('pesanDel', 'Data Berhasil Dihapus');
        return redirect()->to('/home');
    }
}
