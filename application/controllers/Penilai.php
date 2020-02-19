<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilai extends MY_Controller
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
        if ($this->data['role'] != 4) {
            $this->session->sess_destroy();
            redirect('login');
            exit;
        }
        $this->load->model('Pegawai_m');
        $this->load->model('Kriteria_m');
        $this->load->model('Manager_m');
        $this->load->model('Penilaian_m');
        $this->load->model('Berkas_m');
        $this->load->model('Domisili_m');
        $this->load->model('Tes_tertulis_m');
        $this->load->model('Nilai_kriteria_m');

        $this->load->model('Nilai_tes_m');
        $this->data['user'] = $this->Manager_m->get_row(['username' => $this->data['username']]);
        $this->data['kriteria']     =   $this->Kriteria_m->get();
    }

    public function index()
    {
        // print_r($this->data['user']);exit;
        if ($this->POST('input') && $this->POST('username')) {
            // echo $this->POST('username');exit;
            foreach ($this->data['kriteria'] as $kriteria) {
                $this->data['entry']    = [
                    'pegawai' => $this->POST('username'),
                    'kriteria'  => $kriteria->id,
                    'nilai'     => $this->POST($kriteria->nama)
                ];
                // $this->Penilaian_saw_m->insert($this->data['entry']);

            }
            redirect('penilai', 'refresh');
            exit;
        }

        $this->data['data']         = $this->Pegawai_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'penilai/dashboard';
        $this->template($this->data);
    }

    public function data_pegawai()
    {
        $this->data['data']         = $this->Pegawai_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'penilai/data_pegawai';
        $this->template($this->data);
    }

    public function pnilai_pegawai()
    {
        $id = $this->uri->segment(3);
        if (!isset($id)) {
            redirect('penilai/data-pegawai');
            exit;
        }
        if ($this->POST('simpan')) {
            foreach ($this->Kriteria_m->get() as $kri) {
                # code...
                $this->Penilaian_m->insert([
                    'id_pegawai'    => $id,
                    'id_kriteria'   => $kri->id,
                    'nilai'         => $this->POST($kri->id)
                ]);
            }
            redirect('penilai/penilaian');
            exit;
        }
        if ($this->POST('domisili')) {
            $this->Domisili_m->insert([
                'id_pegawai'    => $id,
                'nilai'         => $this->POST('nilai')
            ]);
            redirect('penilai/penilaian');
            exit;
        }

        $this->load->model('Tes_tertulis_m');
        $this->load->model('Data_berkas_m');
        $this->data['data']         = $this->Pegawai_m->get_row(['id_pegawai' => $id]);
        $this->data['berkas']         = $this->Data_berkas_m->get(['id_pegawai' => $id]);
        $this->data['nilai']         = $this->Tes_tertulis_m->get_row(['id_pegawai' => $id]);
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'penilai/nilai_pegawai';
        $this->template($this->data);
    }

    public function detail_pegawai()
    {
        $id = $this->uri->segment(3);
        if (!isset($id)) {
            redirect('penilai/data-pegawai');
            exit;
        }
        $this->load->model('Tes_tertulis_m');
        $this->load->model('Data_berkas_m');
        $this->data['data']         = $this->Pegawai_m->get_row(['id_pegawai' => $id]);
        $this->data['berkas']         = $this->Data_berkas_m->get(['id_pegawai' => $id]);
        $this->data['nilai']         = $this->Tes_tertulis_m->get_row(['id_pendaftar' => $id]);
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'penilai/detail-pegawai';
        $this->template($this->data);
    }

    public function penilaian()
    {
        if ($this->POST('simpan')) {
            foreach ($this->Kriteria_m->get() as $kri) {
                # code...
                $this->Penilaian_m->insert([
                    'id_pegawai'    => $this->POST('id_pegawai'),
                    'id_kriteria'   => $kri->id,
                    'nilai'         => $this->POST($kri->id)
                ]);
            }
            redirect('penilai/penilaian');
            exit;
        }
        if ($this->POST('submit')) {
            $nilai = $this->nilai();
            foreach ($nilai as $key => $value) {
                if ($value >= 60) {
                    $this->Pegawai_m->update($key, ['wawancara' => 1]);
                } else
                    $this->Pegawai_m->update($key, ['wawancara' => 9]);
            }
            echo "berhasil";
            exit;
        }
        $this->data['data']         = $this->Pegawai_m->get();
        $this->data['title']        = 'Dashboard Admin';
        $this->data['content']      = 'penilai/hasil_penilaian';
        $this->template($this->data);
    }

    public function nilai_pegawai()
    {
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
            $dom = $this->Domisili_m->getUtiliti($pegawai->id_pegawai) * 0.2;
            $total[$pegawai->id_pegawai] += $dom;
            //tes
            $tes = $this->Tes_tertulis_m->getUtiliti($pegawai->id_pegawai) * 0.3;
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
}
