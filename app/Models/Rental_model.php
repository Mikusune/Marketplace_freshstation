<?php

namespace App\Models;

use CodeIgniter\Model;

class Rental_model extends Model
{
    protected $table      = 'rental'; // Ganti dengan tabel utama jika ada
    protected $primaryKey = 'id'; // Sesuaikan primary key tabel utama
    protected $allowedFields = ['nama', 'alamat', 'status']; // Sesuaikan dengan field yang diizinkan

	public function countPs()
    {
        return $this->countAll();
    }

    public function getPsData($limit, $offset)
    {
        return $this->findAll($limit, $offset);
    }

    public function getAllData($table)
    {
        return $this->db->table($table)->get()->getResultArray();
    }

    public function getData($table)
    {
        return $this->db->table($table)->get()->getResult();
    }


    public function getWhere($where, $table)
    {
        return $this->db->table($table)->where($where)->get()->getResult();
    }

    public function insertData($data, $table)
    {
        return $this->db->table($table)->insert($data);
    }

    public function updateData($table, $data, $where)
    {
        return $this->db->table($table)->where($where)->update($data);
    }

    public function deleteData($where, $table)
    {
        return $this->db->table($table)->where($where)->delete();
    }

    public function ambilIdMobil($id)
    {
        return $this->db->table('mobil')->where('id_mobil', $id)->get()->getResult();
    }

    public function cekLogin($username, $password)
    {
        return $this->db->table('customer')
            ->where('username', $username)
            ->where('password', md5($password))
            ->get()
            ->getRow();
    }

    public function updatePassword($where, $data, $table)
    {
        return $this->db->table($table)->where($where)->update($data);
    }

    public function downloadPembayaran($id)
    {
        return $this->db->table('transaksi')->where('id_rental', $id)->get()->getRowArray();
    }

    public function totalDataRental()
    {
        $nama_rental = session()->get('nama_rental');

        $menunggu_konfirmasi = $this->db->table('transaksi')
            ->where('bukti_pembayaran !=', '')
            ->where('status_pembayaran', '0')
            ->where('nama_rental', $nama_rental)
            ->countAllResults();

        $transaksi = $this->db->table('transaksi')->where('nama_rental', $nama_rental)->countAllResults();
        $transaksi_selesai = $this->db->table('transaksi')->where('status_rental', 'Selesai')->where('nama_rental', $nama_rental)->countAllResults();
        $ps = $this->db->table('ps')->where('nama_rental', $nama_rental)->countAllResults();

        return [
            'total_menunggu_konfirmasi' => $menunggu_konfirmasi,
            'total_transaksi'           => $transaksi,
            'total_transaksi_selesai'   => $transaksi_selesai,
            'total_ps'                  => $ps
        ];
    }

    public function totalDataAdmin()
    {
        $customer = $this->db->table('customer')->where('role_id', '2')->countAllResults();
        $transaksi = $this->db->table('transaksi')->countAllResults();
        $transaksi_selesai = $this->db->table('transaksi')->where('status_rental', 'Selesai')->countAllResults();
        $ps = $this->db->table('ps')->countAllResults();

        return [
            'total_customer'            => $customer,
            'total_transaksi'           => $transaksi,
            'total_transaksi_selesai'   => $transaksi_selesai,
            'total_ps'                  => $ps
        ];
    }

    public function checkUserLogin()
    {
        $role_id = session()->get('role_id');

        if ($role_id == '3') {
            return;
        } elseif ($role_id == '2') {
            return redirect()->to('customer/dashboard');
        } else {
            return redirect()->to('admin/dashboard');
        }
    }

    public function checkAdminLogin()
    {
        $role_id = session()->get('role_id');

        if ($role_id == '1') {
            return;
        } elseif ($role_id == '2') {
            return redirect()->to('customer/dashboard');
        } else {
            return redirect()->to('rental/dashboard');
        }
    }

    public function checkCustomerLogin()
    {
        $role_id = session()->get('role_id');

        if ($role_id == '2') {
            return;
        } elseif ($role_id == '1') {
            return redirect()->to('admin/dashboard');
        } else {
            return redirect()->to('rental/dashboard');
        }
    }

    public function simpanBerita($jdl, $berita, $gambar, $tgl)
    {
        return $this->db->table('artikel')->insert([
            'Title'      => $jdl,
            'Deskripsi'  => $berita,
            'foto'       => $gambar,
            'tgl'        => $tgl
        ]);
    }

    public function getAllBerita()
    {
        return $this->db->table('artikel')->orderBy('id_artikel', 'DESC')->get()->getResult();
    }

    public function getById($table, $col, $id)
    {
        return $this->db->table($table)->where($col, $id)->get()->getResult();
    }

    public function updateDataById($table, $col, $id, $data)
    {
        return $this->db->table($table)->where($col, $id)->update($data);
    }


}
