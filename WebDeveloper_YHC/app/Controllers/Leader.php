<?php

namespace App\Controllers;

use App\Models\LeaderModel;

class Leader extends BaseController
{
    protected $leaderModel;

    public function __construct()
    {
        $this->leaderModel = new LeaderModel();
    }

    public function index()
    {
        $leaderModel = $this->leaderModel->getLeader();

        $data = [
            'leader' => $leaderModel,
            'title' => 'Data Leader Project'
        ];

        return view('leader', $data);
    }

    public function save()
    {
        $namaLeader = $this->request->getVar('Leader-Name');
        $EmailLeader = $this->request->getVar('Leader-Email');


        $dataBerkas = $this->request->getFile('Leader-Foto');
        $fileName = $dataBerkas->getRandomName();
        $this->leaderModel->save([
            'nama_leader' => $namaLeader,
            'email_leader' => $EmailLeader,
            'foto_leader' => $fileName
        ]);
        $dataBerkas->move('img/', $fileName);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('leader'));
    }

    public function edit()
    {
        $Temp = $this->request->getFile('ULeader-Foto');
        $tempName = $Temp->getName();

        if ($tempName == "") {
            $fileName = $this->request->getVar('Edit_namaFile');
        } else {

            $dataBerkas = $this->request->getFile('ULeader-Foto');
            $fileName = $dataBerkas->getRandomName();
            $dataBerkas->move('img/', $fileName);
            unlink('img/' . $this->request->getVar('Edit_namaFile'));
        }

        $this->leaderModel->save(
            [
                'id_leader' => $this->request->getVar('ULeader-ID'),
                'nama_leader' => $this->request->getVar('ULeader-Name'),
                'email_leader' => $this->request->getVar('ULeader-Email'),
                'foto_leader' => $fileName
            ]
        );

        session()->setFlashdata('pesanWarn', 'Data Leader Berhasil Diubah');
        return redirect()->to('/leader');
    }

    public function delete()
    {
        $id = $this->request->getVar('DLeader-ID');
        $this->leaderModel->delete($id);

        unlink('img/' . $this->request->getVar('Delete_namaFile'));
        session()->setFlashdata('pesanDel', 'Data Berhasil Dihapus');
        return redirect()->to('/leader');
    }
}
