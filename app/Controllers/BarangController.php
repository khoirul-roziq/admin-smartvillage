<?php

namespace App\Controllers;

use App\Models\DataBarangModel;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BarangController extends BaseController
{
    public function index()
    {
        if ($this->session->has('username')) {

            $barangModel = new DataBarangModel();
            $barang = $barangModel->findAll();

            $data = [
                'title' => 'Data Barang',
                'barang' => $barang
            ];

            return view('templates/header', ["title" => "Barang"]) . view('templates/menu') . view('admin/barang/index', $data);
        } else {
            return redirect('/');
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Data Barang',
            'validation' => \Config\Services::validation()
        ];
        return view('templates/header', ["title" => "Barang"]) . view('templates/menu') . view('admin/barang/create', $data);
    }

    public function store()
    {
        $db = new DataBarangModel();

        if (!$this->validate([
            'kodeBarang' => [
                'rules' => 'required|trim|is_unique[data_barang.kode_barang]|max_length[4]|min_length[4]',
                'errors' => [
                    'required' => 'Kolom <b>"Kode Barang"</b> tidak boleh dikosongkan!',
                    'is_unique' => 'Kode Barang sudah digunakan!',
                    'max_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Barang"</b>',
                    'min_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Barang"</b>'
                ]
            ],
            'namaBarang' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Barang"</b> tidak boleh dikosongkan!'
                ]
            ],
            'hargaBarang' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'required' => 'Kolom <b>"Harga"</b> tidak boleh dikosongkan!',
                    'numeric' => 'Karakter yang anda isikan tidak valid!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to('barang/create')->withInput()->with('validation', $validation);
        }

        $data = [
            'kode_barang' => $this->request->getPost("kodeBarang"),
            'nama_barang'  => $this->request->getPost("namaBarang"),
            'harga_barang' => $this->request->getPost("hargaBarang"),
        ];

        $db->table('data_barang')->insert($data);
        session()->setFlashdata('massage', 'Data Barang Berhasil Ditambah!');
        return redirect('barang');
    }

    public function edit($kodeBarang)
    {
        $barangModel = new DataBarangModel();
        $barang = $barangModel->where(['kode_barang' => $kodeBarang])->first();

        $data = [
            'title' => 'Data Barang',
            'barang' => $barang,
            'validation' => \Config\Services::validation()
        ];

        return view('templates/header', ["title" => "Barang"]) . view('templates/menu') . view("admin/barang/edit", $data);
    }

    public function update($kodeBarang)
    {
        $barangModel = new DataBarangModel();

        if (!$this->validate([
            'kodeBarang' => [
                'rules' => "required|trim|is_unique[data_barang.kode_barang,kode_barang,$kodeBarang]|max_length[4]|min_length[4]",
                'errors' => [
                    'required' => 'Kolom <b>"Kode Barang"</b> tidak boleh dikosongkan!',
                    'is_unique' => 'Kode Barang sudah digunakan!',
                    'max_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Barang"</b>',
                    'min_length' => 'Masukan 4 karakter untuk kolom <b>"Kode Barang"</b>'
                ]
            ],
            'namaBarang' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom <b>"Nama Barang"</b> tidak boleh dikosongkan!'
                ]
            ],
            'hargaBarang' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'required' => 'Kolom <b>"Harga"</b> tidak boleh dikosongkan!',
                    'numeric' => 'Karakter yang anda isikan tidak valid!'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('massage', $validation->listErrors());
            return redirect()->to("barang/$kodeBarang/edit")->withInput()->with('validation', $validation);
        }

        $barangModel->save([
            'kode_barang' => $this->request->getPost("kodeBarang"),
            'nama_barang'  => $this->request->getPost("namaBarang"),
            'harga_barang' => $this->request->getPost("hargaBarang"),
        ]);

        session()->setFlashdata('massage', 'Data Barang Berhasil Diubah!');
        return redirect('barang');
    }

    public function delete($kodeBarang)
    {
        $barangModel = new DataBarangModel();
        $barangModel->delete($kodeBarang);
        session()->setFlashdata('massage', 'Data barang Berhasil Dihapus!');
        return redirect('barang');
    }

    //fungsi export data barang ke excel
    public function export()
    {
        $barangModel = new DataBarangModel();
        $barang = $barangModel->findAll();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Kode Barang')
            ->setCellValue('B1', 'Nama Barang')
            ->setCellValue('C1', 'Harga Barang');

        $kolom = 2;
        $nomor = 1;
        foreach ($barang as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $data['kode_barang'])
                ->setCellValue('B' . $kolom, $data['nama_barang'])
                ->setCellValue('C' . $kolom, $data['harga_barang']);
            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Data Barang';

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
            'title' => 'Data Barang',
            'validation' => \Config\Services::validation()
        ];
        return view('templates/header', ["title" => "Pelanggan"]) . view('templates/menu') . view('admin/barang/import', $data);
    }

    //fungsi import data barang dari excel
    public function import()
    {
        $db = \Config\Database::connect();
        $barangModel = new DataBarangModel();

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
                $kode_barang = $data[$i]['0'];
                $nama_barang = $data[$i]['1'];
                $harga_barang = $data[$i]['2'];
                // print($kode_barang)
                array_push($data2, 
                    [
                        'kode_barang' => $kode_barang,
                        'nama_barang' => $nama_barang,
                        'harga_barang' => $harga_barang
                    ]
                );
            }
            $barangModel->insertBatch($data2);
            session()->setFlashdata('massage', 'Data Barang Berhasil Diimport!');
            return redirect('barang');
        } else {
            session()->setFlashdata('massage', 'Data Barang Gagal Diimport!');
            return redirect('barang');
        }
    }
}
