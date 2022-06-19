<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PerjanjianKerjasamaModel;

class PksController extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {

            $pksModel = new PerjanjianKerjasamaModel();
            $id_pks = $pksModel->select("id_pks")->orderBy("nama_desa")->first();
            $nama_kades = $pksModel->select("nama_kades")->orderBy("nama_desa")->first();
            $nama_desa = $pksModel->select("nama_desa")->orderBy("nama_desa")->first();
            $tanggal = $pksModel->select("tanggal")->orderBy("nama_desa")->first();
            $id_transaksi = $pksModel->select("id_transaksi")->orderBy("nama_desa")->first();
            $temp_tanggal = $pksModel->select("tanggal")->orderBy("nama_desa")->first();
            $temp_nama_desa = $pksModel->select("nama_desa")->orderBy("nama_desa")->first();

            if ($id_pks != NULL) {


                $data = [
                    [
                        "id_pks" => $id_pks["id_pks"],
                        "nama_kades" => $nama_kades["nama_kades"],
                        "nama_desa" => $nama_desa["nama_desa"],
                        "id_transaksi" => $id_transaksi["id_transaksi"],
                        "tanggal" => $tanggal["tanggal"]
                    ]
                ];

                foreach ($pksModel->orderBy("nama_desa")->findAll() as $order) {
                    if ($order["nama_desa"] == $temp_nama_desa["nama_desa"] and $order["tanggal"] == $temp_tanggal["tanggal"]) {
                        continue;
                    } else {
                        $temp_nama_desa["nama_desa"] = $order["nama_desa"];
                        $temp_tanggal["tanggal"] = $order["tanggal"];

                        $data2 = [
                            "id_pks" => $order["id_pks"],
                            "nama_kades" => $order["nama_kades"],
                            "nama_desa" => $order["nama_desa"],
                            "id_transaksi" => $order["id_transaksi"],
                            "tanggal" => $order["tanggal"]
                        ];
                        array_push($data, $data2);
                    }
                }
            } else {
                $data = $pksModel->findAll();
            }

            $data = [
                'title' => 'Perjanjian Kerjasama',
                'pks' => $data
            ];

            return view('templates/header', ["title" => "PKS"]) . view('templates/menu') . view('admin/pks/index', $data);
        } else {
            return redirect('/');
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Perjanjian Kerjasama',
            'validation' => \Config\Services::validation()
        ];
        return view('templates/header', ["title" => "PKS"]) . view('templates/menu') . view('admin/pks/create', $data);
    }

    public function store()
    {
        $db = new PerjanjianKerjasamaModel();

        if (!$this->validate([
            'namaDesa' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Desa"</b> tidak boleh dikosongkan!'
                ]
            ],
            'namaKades' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Kades"</b> tidak boleh dikosongkan!'
                ]
            ],
            'tanggalPks' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Tanggal PKS"</b> tidak boleh dikosongkan!'
                ]
            ],

        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to('pks/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'id_pks' => uniqid(),
            'nama_desa' => $this->request->getPost("namaDesa"),
            'nama_kades'  => $this->request->getPost("namaKades"),
            'tanggal' => $this->request->getPost("tanggalPks"),
        ];

        $db->table('perjanjian_kerjasama')->insert($data);
        session()->setFlashdata('massage', 'Perjanjian Kerjasama Berhasil Ditambah!');
        return redirect('pks');
    }

    public function edit($id)
    {
        $pksModel = new PerjanjianKerjasamaModel();
        $pks = $pksModel->where(['id_pks' => $id])->first();

        $data = [
            'title' => 'Perjanjian Kerjasama',
            'pks' => $pks,
            'validation' => \Config\Services::validation()
        ];

        return view('templates/header', ["title" => "PKS"]) . view('templates/menu') . view("admin/pks/edit", $data);
    }

    public function update($id, $nama_desa, $tanggal)
    {
        $pksModel = new PerjanjianKerjasamaModel();

        if (!$this->validate([
            'namaDesa' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Desa"</b> tidak boleh dikosongkan!'
                ]
            ],
            'namaKades' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Kades"</b> tidak boleh dikosongkan!'
                ]
            ],
            'tanggalPks' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Tanggal PKS"</b> tidak boleh dikosongkan!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to("barang/$id/edit")->withInput()->with('validation', $validation);
        }

        $pksModel->where(["nama_desa" => $nama_desa, "tanggal" => $tanggal])->save([
            'nama_desa' => $this->request->getPost("namaDesa"),
            'nama_kades'  => $this->request->getPost("namaKades"),
            'tanggal' => $this->request->getPost("tanggalPks"),
        ]);

        session()->setFlashdata('massage', 'Perjanjian Kerjasama Berhasil Diubah!');
        return redirect('pks');
    }

    public function delete($nama_desa, $tanggal)
    {
        $pksModel = new PerjanjianKerjasamaModel();
        $pksModel->where(["nama_desa" => $nama_desa, "tanggal" => $tanggal])->delete();
        session()->setFlashdata('massage', 'Perjanjian Kerjasama Berhasil Dihapus!');
        return redirect('pks');
    }
}
