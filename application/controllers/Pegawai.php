<?php

class Pegawai extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['username']      = $this->session->userdata('username');
        $this->data['id_pegawai']      = $this->session->userdata('id');
        $this->data['role']  = $this->session->userdata('role');
        if (!isset($this->data['username'], $this->data['role'])) {
            $this->session->sess_destroy();
            redirect('login');
            exit;
        }

        if ($this->data['role'] != 3) {
            $this->session->sess_destroy();
            redirect('login');
            exit;
        }
        $this->load->model(['Pegawai_m', 'Penilaian_m', 'Nilai_tes_m', 'Nilai_kriteria_m', 'Kriteria_m', 'Data_berkas_m', 'Tes_tertulis_m', 'Berkas_m']);
        $this->data['user'] = $this->Pegawai_m->get_row(['email' => $this->data['username']]);
    }

    public function index($value = '')
    {

        $this->data['title']                  = 'Dashboard Admin';
        $this->data['content']        = 'pegawai/dashboard';
        $this->template($this->data);
    }

    public function profile($value = '')
    {
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'pegawai/profile';
        $this->template($this->data);
    }

    public function edit_profile($value = '')
    {
        if ($this->POST('simpan')) {
            $this->Pegawai_m->update($this->data['id_pegawai'], [
                'no_ktp'          => $this->POST('no_ktp'),
                'nama'          => $this->POST('nama'),
                'email'          => $this->POST('email'),
                'tempat_lahir'  => $this->POST('tempat_lahir'),
                'tanggal_lahir' => $this->POST('tanggal_lahir'),
                'alamat'        => $this->POST('alamat'),
                'telepon'       => $this->POST('telepon'),
                'bahasa'       => $this->POST('bahasa'),
                'genre_musik'       => $this->POST('genre'),
            ]);
            redirect('pegawai/profile');
            exit;
        }
        if ($this->POST('add_pendidikan')) {
            $pendidikan = [];
            for ($i = 0; $i < count($this->POST('pendidikan')); $i++) {
                $pendidikan[] = [
                    "pendidikan" => $this->input->post('pendidikan')[$i],
                    "lulus" => $this->input->post('lulus')[$i],
                    "nama" => $this->input->post('nama')[$i],
                ];
            }
            $this->Pegawai_m->update($this->data['user']->id_pegawai, [
                'pendidikan'       => json_encode($pendidikan)
            ]);
            redirect('pegawai/profile');
            exit;
        }
        if ($this->POST('add_pengalaman')) {
            $pengalaman = [];

            for ($i = 0; $i < count($this->POST('nama')); $i++) {
                $pengalaman[] = [
                    "nama" => $this->input->post('nama')[$i],
                    "posisi" => $this->input->post('posisi')[$i],
                    "masa_kerja" => $this->input->post('masa_kerja')[$i],
                ];
            }
            $this->Pegawai_m->update($this->data['user']->id_pegawai, [
                'pengalaman_kerja'       => json_encode($pengalaman)
            ]);
            redirect('pegawai/profile');
            exit;
        }
        if ($this->POST('simpan-foto')) {
            # code...
            if (!empty($_FILES['foto']['name'])) {
                // echo $this->data['id_pegawai'];exit;
                $this->upload($this->data['id_pegawai'], 'user', 'foto');
            }
            redirect('pegawai/profile');
            exit;
        }
        if ($this->POST('berkas')) {
            # code...
            if (!empty($_FILES['file']['name'])) {
                // echo $this->data['id_pegawai'];exit;
                $filename = $this->POST('nama') . '_' . $this->data['user']->id_pegawai;
                $this->uploadPDF($filename, 'berkas', 'file');
                $this->Data_berkas_m->insert( [
                    'id_pegawai'       => $this->data['user']->id_pegawai,
                    'nama'              => $this->POST('nama')
                ]);
            }
            redirect('pegawai/profile');
            exit;
        }
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'pegawai/edit_profile';
        $this->template($this->data);
    }

    public function detail_hasil($value = '')
    {
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'pegawai/detail_hasil';
        $this->template($this->data);
    }

    public function berkas()
    {
        # code...
        if ($this->POST('upload')) {
            # code...
            $this->Data_berkas_m->insert(['id_pegawai' => $this->data['id_pegawai'], 'id_data_berkas' => $this->POST('id')]);
            if (!empty($_FILES['file']['name']))
                $this->uploadPDF($this->db->insert_id(), 'berkas', 'file');

            redirect('pegawai/berkas');
            exit;
        }
        $this->data['data']       = $this->Data_berkas_m->get(['id_pegawai' => $this->data['id_pegawai']]);
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'pegawai/berkas';
        $this->template($this->data);
    }

    public function informasi($value = '')
    {
        $this->load->model('Informasi_m');
        $this->data['informasi']    = $this->Informasi_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'pegawai/informasi';
        $this->template($this->data);
    }
}
