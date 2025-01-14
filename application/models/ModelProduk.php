<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelProduk extends CI_Model
{
    // Fungsi untuk memeriksa login berdasarkan username dan password
    public function cek_login($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users'); // Ambil data dari tabel users

        if ($query->num_rows() > 0) {
            $user = $query->row();

            // Verifikasi password
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false; // Login gagal
    }
}
