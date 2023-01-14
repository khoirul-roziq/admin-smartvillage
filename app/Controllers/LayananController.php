<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataLayananModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LayananController extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {

            $layananModel = new DataLayananModel();
            $layanan = $layananModel->findAll();

            $data = [
                'title' => 'Data Layanan',
                'layanan' => $layanan
            ];

            return view('templates/header', ["title" => "Layanan"]) . view('templates/menu') . view('admin/layanan/index', $data);
        } else {
            return redirect('/');
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Data Layanan',
            'validation' => \Config\Services::validation()
        ];
        return view('templates/header', ["title" => "Layanan"]) . view('templates/menu') . view('admin/layanan/create', $data);
    }

    public function store()
    {
        $db = new DataLayananModel();

        if (!$this->validate([
            'kodeLayanan' => [
                'rules' => 'required|trim|is_unique[data_layanan.kode_layanan]|max_length[4]|min_length[4]',
                'errors' => [
                    'required' => 'Kolom <b>"Kode Layanan"</b> tidak boleh dikosongkan!',
                    'is_unique' => 'Kode Barang sudah digunakan!',
                    'max_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Layanan"</b>',
                    'min_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Layanan"</b>'
                ]
            ],
            'namaLayanan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Layanan"</b> tidak boleh dikosongkan!'
                ]
            ],
            'hargaLayanan' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'required' => 'Kolom <b>"Harga"</b> tidak boleh dikosongkan!',
                    'numeric' => 'Karakter yang anda isikan tidak valid!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to('layanan/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'kode_layanan' => $this->request->getPost("kodeLayanan"),
            'nama_layanan'  => $this->request->getPost("namaLayanan"),
            'harga_layanan' => $this->request->getPost("hargaLayanan"),
        ];

        $db->table('data_layanan')->insert($data);
        session()->setFlashdata('massage', 'Data Layanan Berhasil Ditambah!');
        return redirect('layanan');
    }

    public function edit($kodeLayanan)
    {
        $layananModel = new DataLayananModel();
        $layanan = $layananModel->where(['kode_layanan' => $kodeLayanan])->first();

        $data = [
            'title' => 'Data Layanan',
            'layanan' => $layanan,
            'validation' => \Config\Services::validation()
        ];

        return view('templates/header', ["title" => "Layanan"]) . view('templates/menu') . view("admin/layanan/edit", $data);
    }

    public function update($kodeLayanan)
    {
        $layananModel = new DataLayananModel();

        if (!$this->validate([
            'kodeLayanan' => [
                'rules' => "required|trim|is_unique[data_layanan.kode_layanan,kode_layanan,$kodeLayanan]|max_length[4]|min_length[4]",
                'errors' => [
                    'required' => 'Kolom <b>"Kode Layanan"</b> tidak boleh dikosongkan!',
                    'is_unique' => 'Kode Barang sudah digunakan!',
                    'max_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Layanan"</b>',
                    'min_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Layanan"</b>'
                ]
            ],
            'namaLayanan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Layanan"</b> tidak boleh dikosongkan!'
                ]
            ],
            'hargaLayanan' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'required' => 'Kolom <b>"Harga"</b> tidak boleh dikosongkan!',
                    'numeric' => 'Karakter yang anda isikan tidak valid!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to("barang/$kodeLayanan/edit")->withInput()->with('validation', $validation);
        }

        $layananModel->save([
            'kode_layanan' => $this->request->getPost("kodeLayanan"),
            'nama_layanan'  => $this->request->getPost("namaLayanan"),
            'harga_layanan' => $this->request->getPost("hargaLayanan"),
        ]);

        session()->setFlashdata('massage', 'Data Layanan Berhasil Diubah!');
        return redirect('layanan');
    }

    public function delete($kodeLayanan)
    {
        $layananModel = new DataLayananModel();
        $layananModel->delete($kodeLayanan);
        session()->setFlashdata('massage', 'Data Layanan Berhasil Dihapus!');
        return redirect('layanan');
    }

    //fungsi export data barang ke excel
    public function export()
    {
        $layananModel = new DataLayananModel();
        $layanan = $layananModel->findAll();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Kode Layanan')
            ->setCellValue('B1', 'Nama Layanan')
            ->setCellValue('C1', 'Harga Layanan');

        $kolom = 2;
        $nomor = 1;
        foreach ($layanan as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $data['kode_layanan'])
                ->setCellValue('B' . $kolom, $data['nama_layanan'])
                ->setCellValue('C' . $kolom, $data['harga_layanan']);
            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Data Layanan';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $writer->save('php://output');
        die();
    }

    public function importFile()
    {
        $data = [
            'title' => 'Data Layanan',
            'validation' => \Config\Services::validation()
        ];
        return view('templates/header', ["title" => "Pelanggan"]) . view('templates/menu') . view('admin/layanan/import', $data);
    }

    //fungsi import data barang dari excel
    public function import()
    {
        $db = \Config\Database::connect();
        $layananModel = new DataLayananModel();

        $file = $this->request->getFile('file');
        $ext = $file->getClientExtension();

        if ($ext == 'xlsx') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }

        $spreadsheet = $reader->load($file);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $data2= [];
        $jumlah = count($data);
        if ($jumlah > 1) {
            for ($i = 1; $i < $jumlah; $i++) {
                $kode_layanan = $data[$i]['0'];
                $nama_layanan = $data[$i]['1'];
                $harga_layanan = $data[$i]['2'];
                // print($kode_layanan)
                array_push($data2, 
                    [
                        'kode_layanan' => $kode_layanan,
                        'nama_layanan' => $nama_layanan,
                        'harga_layanan' => $harga_layanan
                    ]
                );
            }
            $layananModel->insertBatch($data2);
            session()->setFlashdata('massage', 'Data Layanan Berhasil Diimport!');
            return redirect('layanan');
        } else {
            session()->setFlashdata('massage', 'Data Layanan Gagal Diimport!');
            return redirect('layanan');
        }
    }
}
