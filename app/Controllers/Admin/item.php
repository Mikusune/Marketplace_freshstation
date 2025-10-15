<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use Myth\Auth\Models\UserModel;

class item extends BaseController
{
    protected $itemModel;
    protected $userModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {   
        // Ambil data user yang sedang login
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
        }
        
        $perPage = 8; // Number of items per page
        $currentPage = $this->request->getVar('page_default') ? $this->request->getVar('page_default') : 1;
        
        $data = [
            'item' => $this->itemModel->getPaginateditem($perPage),
            'pager' => $this->itemModel->pager,
            'currentPage' => $currentPage
        ];
        
        return view('templates_admin/header', ['user' => $user])
            . view('templates_admin/sidebar')
            . view('admin/Data_item', $data)
            . view('templates_admin/footer');
    }

    public function tambah_item()
    {   
        $user = null;
        if (user_id()) {  // user_id() adalah fungsi global dari Myth\Auth untuk mendapatkan user_id
            $user = $this->userModel->find(user_id()); // Ambil data user berdasarkan user_id
        }
        $itemModel = new ItemModel();
        $selectedType = $this->request->getGet('type');

        $data = [
            'item' => $this->itemModel->findAll()
        ];
        // Ambil daftar tipe item untuk dropdown
        $data['types'] = $itemModel->getAllTypes();
        $data['selectedType'] = $selectedType;
        return view('templates_admin/header',['user' => $user])
        . view('templates_admin/sidebar')
        . view('admin/form_tambah_item',$data)
        . view('templates_admin/footer');;;
    }

    public function simpan_item()
    {   
        
        if (!$this->validate([
           'nama_produk' => 'required',
            'kode_type' => 'required',
            'brand' => 'required',
            'berat' => 'required',
            'status' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric|greater_than_equal_to[0]',
            'gambar' => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]',
            'deskripsi' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // $file = $this->request->getFile('gambar');
        // $fileName = $file->getRandomName();
        // $file->move('uploads/item', $fileName);
        // Ambil semua file gambar
        $files = $this->request->getFileMultiple('gambar');
        $gambarNames = [];

        foreach ($files as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('assets/upload', $newName);
                $gambarNames[] = $newName;
            }
        }
        $gambarString = implode(',', $gambarNames);

       // Simpan data ke database
        if ($this->itemModel->save([
            'nama_produk' => $this->request->getPost('nama_produk'),
            'kode_type' => $this->request->getPost('kode_type'),
            'brand' => $this->request->getPost('brand'),
            'berat' => $this->request->getPost('berat'),
            'status' => $this->request->getPost('status'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'stok' => $this->request->getPost('stok'),
            'gambar' => $gambarString,
            'deskripsi' => $this->request->getPost('deskripsi')
        ])) {
            session()->setFlashdata('pesan', 'Data item berhasil ditambahkan!');
        } else {
            // Jika gagal, log kesalahan
            log_message('error', 'Gagal menyimpan data: ' . print_r($this->itemModel->errors(), true));
            session()->setFlashdata('pesan', 'Gagal menyimpan data item.');
        }
        return redirect()->to('/admin/data_item');
    }


    public function update_item($id)
    {
        $user = null;
        if (user_id()) {
            $user = $this->userModel->find(user_id());
        }

        $item = $this->itemModel->find($id);
        if (!$item) {
            session()->setFlashdata('error', 'Data item tidak ditemukan.');
            return redirect()->to('/admin/data_item');
        }

        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('gambar');

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move('assets/upload', $fileName);
                if ($item['gambar'] && file_exists('assets/upload/' . $item['gambar'])) {
                    unlink('assets/upload/' . $item['gambar']);
                }
            } else {
                $fileName = $item['gambar'];
            }

            $this->itemModel->update($id, [
                'nama_produk' => $this->request->getPost('nama_produk'),
                'kode_type' => $this->request->getPost('kode_type'),
                'brand' => $this->request->getPost('brand'),
                'berat' => $this->request->getPost('berat'),
                'status' => $this->request->getPost('status'),
                'harga_beli' => $this->request->getPost('harga_beli'),
                'harga_jual' => $this->request->getPost('harga_jual'),
                'stok' => $this->request->getPost('stok'),
                'gambar' => $fileName,
                'deskripsi' => $this->request->getPost('deskripsi')
            ]);

            session()->setFlashdata('pesan', 'Data item berhasil diperbarui!');
            return redirect()->to('/admin/data_item');
        }

        // Tampilkan form jika bukan POST request
        $data = [
            'produk' => [$this->itemModel->find($id)],
            'kategori' => $this->itemModel->getAllTypes(),
            'user' => $user
        ];

        return view('templates_admin/header', $data)
            . view('templates_admin/sidebar')
            . view('admin/form_update_item', $data)
            . view('templates_admin/footer');
    }

    public function update_item_aksi($id)
    {
        $item = $this->itemModel->find($id);
        if (!$item) {
            session()->setFlashdata('error', 'Data item tidak ditemukan.');
            return redirect()->to('/admin/data_item');
        }

        // Handle multiple file uploads
        $files = $this->request->getFiles();
        $imageNames = [];
        
        if($files) {
            foreach($files['gambar'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('assets/upload', $newName);
                    $imageNames[] = $newName;
                }
            }
        }

        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'kode_type' => $this->request->getPost('kode_type'),
            'brand' => $this->request->getPost('brand'),
            'berat' => $this->request->getPost('berat'),
            'status' => $this->request->getPost('status'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'stok' => $this->request->getPost('stok'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        // Only update images if new ones were uploaded
        if (!empty($imageNames)) {
            // Delete old images if they exist
            $oldImages = json_decode($item['gambar'], true) ?? [];
            foreach ($oldImages as $oldImage) {
                if ($oldImage && file_exists('assets/upload/' . $oldImage)) {
                    unlink('assets/upload/' . $oldImage);
                }
            }
            // Simpan nama file gambar sebagai string dengan pemisah koma
            $data['gambar'] = implode(',', $imageNames);
        }

        $this->itemModel->update($id, $data);
        session()->setFlashdata('pesan', 'Data item berhasil diperbarui!');
        return redirect()->to('/admin/data_item');
    }

    public function delete_item($id) 
    {
        $item = $this->itemModel->find($id);
        

    if ($item) {
        // Pastikan ada data gambar
        if (!empty($item['gambar'])) {
            // Jika ada lebih dari satu gambar, pisahkan dengan koma
            $gambarList = json_decode($item['gambar'], true); 

            if (is_array($gambarList)) { // Pastikan hasil decode adalah array
                foreach ($gambarList as $gambar) {
                    $gambarPath = FCPATH . 'assets/upload' . trim($gambar);
                    var_dump($gambarPath);

                   if (file_exists($gambarPath)) {
                    if (unlink($gambarPath)) {
                        echo "Berhasil menghapus: " . $gambarPath;
                    } else {
                        echo "Gagal menghapus: " . $gambarPath;
                    }
                } else {
                    echo "File tidak ditemukan: " . $gambarPath;
                }
            }
        } else {
            echo "JSON Decode gagal atau format tidak sesuai.";
        }
    }

        // Hapus data dari database
        $this->itemModel->delete($id);
    }   
    session()->setFlashdata('pesan', 'Data item berhasil dihapus!');
    return redirect()->to('/admin/data_item');
}

public function detail_item($id){
    $user = null;
    if (user_id()) {  // user_id() adalah fungsi global dari Myth\Auth untuk mendapatkan user_id
        $user = $this->userModel->find(user_id()); // Ambil data user berdasarkan user_id
    }
    // Ambil item berdasarkan ID
    $item = $this->itemModel->find($id);
    // var_dump($item); // Menampilkan isi dari $item
    // exit;

   // Ambil semua tipe dari tabel type
   $dataType = $this->itemModel->getAllTypes();
    

    // Kirim data ke view
    return view('templates_admin/header', ['user' => $user])
        . view('templates_admin/sidebar')
        . view('admin/detail_item', ['item' => $item, 'data' => $dataType]) // Kirim item dan dataType
        . view('templates_admin/footer');

}

    public function toggleFeatured($id)
    {
        $item = $this->itemModel->find($id);
        if (!$item) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Item not found'
            ]);
        }

        $newStatus = $item['is_featured'] ? 0 : 1;
        $this->itemModel->toggleFeatured($id, $newStatus);

        return $this->response->setJSON([
            'success' => true,
            'featured' => $newStatus == 1,
            'message' => 'Product ' . ($newStatus == 1 ? 'featured' : 'unfeatured') . ' successfully'
        ]);
    }
}
