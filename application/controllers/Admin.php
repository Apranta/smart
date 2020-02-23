<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->data['username']      = $this->session->userdata('username');
        $this->data['role']  = $this->session->userdata('role');
        if (!isset($this->data['username'], $this->data['role'])) {
            $this->session->sess_destroy();
            redirect('login');
            exit;
        }
        if ($this->data['role'] != 1) {
            $this->session->sess_destroy();
            redirect('login');
            exit;
        }
        $this->load->model('Pegawai_m');
        $this->load->model('Domisili_m');
        $this->load->model('Tes_tertulis_m');
        $this->load->model('Kriteria_m');
        $this->load->model('User_m');
        $this->load->model('Nilai_utiliti_m');
        $this->load->model('Berkas_m');
    }

    public function index()
    {
        $this->data['user']         = $this->Pegawai_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'admin/dashboard';
        $this->template($this->data);
    }

    public function data_pegawai()
    {
        if ($this->POST('delete') && $this->POST('id')) {
            $this->User_m->delete($this->POST('id'));
            exit;
        }
        $this->data['data']         = $this->Pegawai_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'admin/data_pegawai';
        $this->template($this->data);
    }

    public function detail_pegawai()
    {
        $id = $this->uri->segment(3);
        if (!isset($id)) {
            redirect('admin/data-pegawai');
            exit;
        }
        $this->load->model('Tes_tertulis_m');
        $this->load->model('Data_berkas_m');
        $this->data['data']         = $this->Pegawai_m->get_row(['id_pegawai' => $id]);
        $this->data['nilai']         = $this->Tes_tertulis_m->get_row(['id_pegawai' => $id]);
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'admin/detail-pegawai';
        $this->template($this->data);
    }

    public function edit_profile($value = '')
    {
        $this->data['id_pegawai'] = $this->uri->segment(3);
        if (!isset($this->data['id_pegawai'])) {
            redirect('admin/data_pegawai', 'refresh');
            exit;
        }
        if ($this->POST('simpan')) {
            $this->Pegawai_m->update($this->data['id_pegawai'], [
                'nama'          => $this->POST('nama'),
                'tempat_lahir'  => $this->POST('tempat_lahir'),
                'tanggal_lahir' => $this->POST('tanggal_lahir'),
                'alamat'        => $this->POST('alamat'),
                'pendidikan'    => $this->POST('pendidikan'),
                'telepon'       => $this->POST('telepon'),
            ]);
            redirect('admin/data_pegawai');
            exit;
        }
        // if ($this->POST('simpan-foto')) {
        //     # code...
        //     if (!empty($_FILES['foto']['name'])){
        //         // echo $this->data['id_pegawai'];exit;
        //         $this->upload($this->data['id_pegawai'],'user', 'foto');
        //     }
        //     redirect('admin/profile');exit;
        // }

        $this->data['user'] = $this->Pegawai_m->get_row(['id_pegawai' => $this->data['id_pegawai']]);
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'admin/edit_profile';
        $this->template($this->data);
    }

    public function tes_tertulis()
    {
        $this->load->model(['Tes_tertulis_m']);
        if ($this->POST('simpan')) {
            if ($this->Tes_tertulis_m->get_row(['id_pegawai' => $this->POST('id')])) {
                # code...
                $this->flashmsg('Data telah ada silahkan lakukan edit data untuk data tersebut', 'warning');
                redirect('admin/tes_tertulis');
                exit;
            }

            $this->Tes_tertulis_m->insert([
                'id_pegawai'  => $this->POST('id'),
                'nilai'         => $this->POST('nilai')
            ]);
            redirect('admin/tes_tertulis');
            exit;
        }
        $this->data['data']         = $this->Pegawai_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'admin/tes_tertulis';
        $this->template($this->data);
    }

    public function data_berkas($value = '')
    {
        $this->load->model('Data_berkas_m');
        $action = $this->uri->segment(3);
        if ($action == 'delete') {
            $id = $this->uri->segment(4);
            $this->Berkas_m->delete($id);
            redirect('admin/data-berkas', 'refresh');
            exit;
        }
        if ($this->POST('konfirm') && $this->POST('username')) {
            # code...
            $this->Pegawai_m->update($this->POST('username'), ['berkas' => 1]);
            redirect('admin/data-berkas');
            exit;
        }
        if ($this->POST('notkonfirm') && $this->POST('username')) {
            # code...
            $this->Pegawai_m->update($this->POST('username'), ['berkas' => 9]);
            redirect('admin/data-berkas');

            exit;
        }

        if ($this->POST('simpan')) {
            $this->Berkas_m->insert(['nama' => $this->POST('nama')]);
            redirect('admin/data-berkas', 'refresh');
            exit;
        }
        $this->data['berkas']       = $this->Berkas_m->get();
        $this->data['data']         = $this->Pegawai_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'admin/berkas';
        $this->template($this->data);
    }
    public function jabatan()
    {
        $this->load->model('Jabatan_m');
        if ($this->POST('simpan')) {
            # code...
            $this->Jabatan_m->insert([
                'nama' => $this->POST('nama')
            ]);
            redirect('admin/jabatan');
            exit;
        }
        if ($this->POST('delete')) {
            # code...
            $this->Jabatan_m->delete($this->POST('id'));
            redirect('admin/jabatan');
            exit;
        }
        $this->data['data']         = $this->Jabatan_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'admin/jabatan';
        $this->template($this->data);
    }

    public function data_admin()
    {
        $this->load->model('Manager_m');
        $this->load->model('Jabatan_m');
        if ($this->POST('insert')) {
            # code...
            if ($this->POST('pw') != $this->POST('repw')) {
                $this->flashmsg('password tidak sama', 'warning');
                redirect('admin/data-admin');
                exit;
            }
            $this->User_m->insert([
                'username'  => $this->POST('username'),
                'password'  => md5($this->POST('pw')),
                'role'      => 2
            ]);
            $this->Manager_m->insert([
                'username'  => $this->POST('username'),
                'nama'      => $this->POST('nama'),
                'id_jabatan' => $this->POST('jabatan')
            ]);
            $this->flashmsg('Data ' . $this->POST('nama') . ' berhasil di buat dengan password : ' . $this->POST('pw'), 'success');
            redirect('admin/data-admin');
            exit;
        }

        if ($this->POST('delete')) {
            # code...
            $this->User_m->delete($this->POST('id'));
            $this->flashmsg('Data Berhasil di Hapus ', 'success');
            redirect('admin/data-admin');
            exit;
        }
        $this->data['data']         = $this->Manager_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'admin/data_admin';
        $this->template($this->data);
    }

    public function penilaian()
    {
        $this->load->library("Smart/smart");
        $this->load->model('Penilaian_m');
        $this->load->model('Nilai_kriteria_m');

        // echo "<pre>" . json_encode($this->Kriteria_m->get_total() , JSON_PRETTY_PRINT) . "</pre>";exit;
        $this->data['utiliti']  = &get_instance();
        $this->data['data']         = $this->Pegawai_m->get();
        // $pegawai = [];
        // foreach ($this->data['data'] as $value) {
        //     echo $value->nama . '<br>';
        //     $this->smart->fit(
        //       [
        //         'pengalaman_kerja' => 'Penyiar Radio',
        //         'pengalaman_masa_kerja' => '2 tahun',
        //         'genre' => '4 genre',
        //         'domisili' => 15,
        //         'bahasa' => 'Bahasa Daerah , Bahasa Indonesia , dan Bahasa Asing',
        //         'nilai_tes' => 80
        //       ]
        //     );

        //     echo $this->smart->result() . '<br>';
        // }
        // exit;
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'admin/penilaian';
        $this->template($this->data);
    }

    public function input_nilai_pegawai()
    {
        $this->data['data']         = $this->Pegawai_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'admin/input_nilai_pegawai';
        $this->template($this->data);
    }

    public function nilai_utiliti()
    {
        $this->load->model('Nilai_utiliti_m');
        if ($this->POST('insert')) {
            # code...
            $this->Nilai_utiliti_m->insert([
                'nilai_kriteria'    => $this->POST('nilai_kriteria'),
                'nilai_utiliti'     => $this->POST('nilai_utiliti')
            ]);
            redirect('admin/nilai_utiliti');
            exit;
        }
        if ($this->POST('edit')) {
            # code...
            $this->Nilai_utiliti_m->update($this->POST('edit_id'), [
                'nilai_kriteria'    => $this->POST('nilai_kriteria'),
                'nilai_utiliti'     => $this->POST('nilai_utiliti')
            ]);
            redirect('admin/nilai_utiliti');
            exit;
        }
        if ($this->POST('delete') && $this->POST('id')) {
            $this->Nilai_utiliti_m->delete($this->POST('id'));
            exit;
        }
        if ($this->POST('get') && $this->POST('id')) {
            $this->data['parameter'] = $this->Nilai_utiliti_m->get_row(['id' => $this->POST('id')]);
            // echo json_encode($this->data['parameter']);
            // exit;
        }
        $this->data['data']         = $this->Nilai_utiliti_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'admin/input_nilai_utiliti';
        $this->template($this->data);
    }

    public function nilai_pegawai()
    {
        $this->load->model(['Nilai_kriteria_m', 'Penilaian_m']);
        $this->data['data']          = $this->Pegawai_m->get();
        // echo "<pre>" . json_encode($totalp , JSON_PRETTY_PRINT) . "</pre>";exit;
        $this->data['total'] = $this->nilai();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']       = 'admin/nilai_pegawai';
        $this->template($this->data);
    }

    public function nilai()
    {
        $this->data['data']          = $this->Pegawai_m->get();
        $i = 0;
        $total = [];
        foreach ($this->data['data'] as $pegawai) {
            $total[$pegawai->id_pegawai] = 0;
            //domisili
            $d = ($this->Domisili_m->getUtiliti($pegawai->id_pegawai)) ? $this->Domisili_m->getUtiliti($pegawai->id_pegawai) : 0;
            $dom = $d * 0.2;
            $total[$pegawai->id_pegawai] += $dom;
            //tes
            $t = ($this->Tes_tertulis_m->getUtiliti($pegawai->id_pegawai)) ? $this->Tes_tertulis_m->getUtiliti($pegawai->id_pegawai) : 0;
            $tes = $t * 0.3;
            $total[$pegawai->id_pegawai] += $tes;

            //wawancara
            $total_ww[$pegawai->id_pegawai] = 0;
            foreach ($this->Kriteria_m->get() as $kri) :
                $nilai = $this->Penilaian_m->get_row(['id_pegawai' => $pegawai->id_pegawai, 'id_kriteria' => $kri->id]);
                if (!isset($nilai)) {
                    $total_ww[$pegawai->id_pegawai] += 0;
                } else {
                    $n_krit = $this->Nilai_kriteria_m->get_row(['id' => $nilai->nilai]);
                    $val = $n_krit ? $n_krit->nilai : 0;

                    //utiliti
                    $uti = $this->Nilai_kriteria_m->getUtiliti($val, $kri->id);
                    $total_ww[$pegawai->id_pegawai] += $uti;
                }
            endforeach;
            $total[$pegawai->id_pegawai] += (($total_ww[$pegawai->id_pegawai] / 4 ) * 0.5);
            $total[$pegawai->id_pegawai] = $total[$pegawai->id_pegawai] * 100;
        }
        arsort($total);
        return $total;
    }

    public function kriteria()
    {
        if ($this->POST('insert')) {
            $this->data['entry'] = [
                "nama" => $this->POST("nama"),
                "bobot" => $this->POST("bobot")
            ];
            $this->Kriteria_m->insert($this->data['entry']);
            redirect('admin/kriteria');
            exit;
        }

        if ($this->POST('delete') && $this->POST('id')) {
            $this->Kriteria_m->delete($this->POST('id'));
            exit;
        }

        if ($this->POST('edit') && $this->POST('edit_id')) {
            $this->data['entry'] = [
                // "id" => $this->POST("id"),
                "nama" => $this->POST("nama"),
                "bobot" => $this->POST("bobot")
            ];
            $this->Kriteria_m->update($this->POST('edit_id'), $this->data['entry']);
            redirect('admin/kriteria');
            exit;
        }

        if ($this->POST('get') && $this->POST('id')) {
            $this->data['kriteria'] = $this->Kriteria_m->get_row(['id' => $this->POST('id')]);
            echo json_encode($this->data['kriteria']);
            exit;
        }

        $this->data['data']     = $this->Kriteria_m->get();
        $this->data['columns']  = ["id", "nama", "bobot"];
        $this->data['title']    = 'Title';
        $this->data['content']  = 'admin/kriteria_all';
        $this->template($this->data);
    }


    public function parameter()
    {
        $this->load->model('Nilai_kriteria_m');
        $this->data['id']   = $this->uri->segment(3);
        if (!isset($this->data['id'])) {
            # code...
            redirect('admin/kriteria');
            exit;
        }
        if ($this->POST('simpan')) {
            $this->data['entry'] = [
                "kriteria" => $this->data['id'],
                "parameter" => $this->POST("parameter"),
                "nilai_awal"    => $this->POST("nilai_awal"),
                "nilai_akhir"   => $this->POST("nilai_akhir"),
                "bobot" => $this->POST("bobot"),
            ];
            $this->Nilai_kriteria_m->insert($this->data['entry']);
            redirect('admin/parameter/' . $this->data['id']);
            exit;
        }

        if ($this->POST('delete') && $this->POST('id')) {
            $this->Nilai_kriteria_m->delete($this->POST('id'));
            exit;
        }

        if ($this->POST('edit') && $this->POST('edit_id')) {
            $this->data['entry'] = [
                // "id" => $this->POST("id"),
                "parameter" => $this->POST("parameter"),
                "nilai_awal"    => $this->POST("nilai_awal"),
                "nilai_akhir"   => $this->POST("nilai_akhir"),
                "bobot" => $this->POST("bobot"),
            ];
            $this->Nilai_kriteria_m->update($this->POST('edit_id'), $this->data['entry']);
            redirect('admin/parameter/' . $this->data['id']);
            exit;
        }

        if ($this->POST('get') && $this->POST('id')) {
            $this->data['parameter'] = $this->Nilai_kriteria_m->get_row(['id' => $this->POST('id')]);
            echo json_encode($this->data['parameter']);
            exit;
        }

        $this->data['data']     = $this->Nilai_kriteria_m->get(['kriteria' => $this->data['id']]);
        $this->data['title']    = 'Title';
        $this->data['content']  = 'admin/parameter';
        $this->template($this->data);
    }

    public function informasi($value = '')
    {
        $this->load->model('Informasi_m');
        if ($this->POST('simpan')) {
            $this->Informasi_m->insert([
                'judul' => $this->POST('judul'),
                'isi'   => $this->POST('isi')
            ]);
            redirect('admin/informasi');
            exit;
        }
        if ($this->GET('aksi') === 'delete') {
            $this->Informasi_m->delete($this->GET('delete'));
            redirect('admin/informasi', 'refresh');
            exit;
        }
        $this->data['pegawai']      = $this->Pegawai_m->get();
        $this->data['informasi']    = $this->Informasi_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'admin/data_informasi';
        $this->template($this->data);
    }
}
