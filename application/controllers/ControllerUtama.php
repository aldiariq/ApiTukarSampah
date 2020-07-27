<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerUtama extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUtama');
    }

    public function fungsiDaftar()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $nohp = $this->input->post('nohp');
	$alamat = $this->input->post('alamat');
        $tipeakun = $this->input->post('tipeakun');

        $cekakun = $this->ModelUtama->fungsiCekakun($username, $tipeakun);

        if ($cekakun == 0) {
            if ($username == '' || $password == '' || $nohp == '' || $tipeakun == '') {
                $status = array(
                    'STATUS' => 'GAGAL',
                    'KETERANGAN' => 'PASTIKAN SEMUA DATA TERISI'
                );
                echo json_encode($status);
            } else {
                if ($tipeakun == 'KURIR') {
                    $data = array(
                        'username_kurir' => $username,
                        'password_kurir' => $password,
                        'nohp_kurir' => $nohp,
			'alamat_kurir' => $alamat,
                        'tipe_akun' => $tipeakun
                    );

                    $daftar = $this->ModelUtama->fungsiDaftarKurir($data);

                    echo json_encode($daftar);
                } else if ($tipeakun == 'PENGGUNA') {
                    $data = array(
                        'username_pengguna' => $username,
                        'password_pengguna' => $password,
                        'nohp_pengguna' => $nohp,
			            'alamat_pengguna' => $alamat,
                        'tipe_akun' => $tipeakun,
                        'status_langganan' => 'TIDAK'
                    );

                    $daftar = $this->ModelUtama->fungsiDaftarPengguna($data);

                    echo json_encode($daftar);
                }
            }
        } else {
            $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'USERNAME SUDAH TERDAFTAR'
            );

            echo json_encode($status);
        }
    }

    public function fungsiMasuk()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $tipeakun = $this->input->post('tipeakun');

        if ($tipeakun == 'KURIR') {
            $data = array(
                'username_kurir' => $username,
                'password_kurir' => $password,
            );

            $masuk = $this->ModelUtama->fungsiMasukKurir($data)->num_rows();

            if ($masuk == 0) {
                $status = array(
                    'STATUS' => 'GAGAL',
                    'KETERANGAN' => 'MOHON PERIKSA USERNAME ATAU PASSWORD'
                );

                echo json_encode($status);
            } else {
                foreach ($this->ModelUtama->fungsiMasukKurir($data)->result() as $key) {
                    $status = array(
                        'STATUS' => 'BERHASIL',
                        'KETERANGAN' => 'BERHASIL MASUK',
                        'ID_AKUN' => $key->id_kurir,
                        'USERNAME' => $username,
                        'TIPEAKUN' => $tipeakun
                    );
                }
                echo json_encode($status);
            }
        } else if ($tipeakun == 'PENGGUNA') {
            $data = array(
                'username_pengguna' => $username,
                'password_pengguna' => $password
            );

            $masuk = $this->ModelUtama->fungsiMasukPengguna($data)->num_rows();

            if ($masuk == 0) {
                $status = array(
                    'STATUS' => 'GAGAL',
                    'KETERANGAN' => 'MOHON PERIKSA USERNAME ATAU PASSWORD'
                );

                echo json_encode($status);
            } else {
                foreach ($this->ModelUtama->fungsiMasukPengguna($data)->result() as $key) {
                    $status = array(
                        'STATUS' => 'BERHASIL',
                        'KETERANGAN' => 'BERHASIL MASUK',
                        'ID_AKUN' => $key->id_pengguna,
                        'USERNAME' => $username,
                        'TIPEAKUN' => $tipeakun
                    );   
                }

                echo json_encode($status);
            }
        } else if ($tipeakun == 'ADMIN') {
            $data = array(
                'username_admin' => $username,
                'password_admin' => $password
            );

            $masuk = $this->ModelUtama->fungsiMasukAdmin($data)->num_rows();

            if ($masuk == 0) {
                $status = array(
                    'STATUS' => 'GAGAL',
                    'KETERANGAN' => 'MOHON PERIKSA USERNAME ATAU PASSWORD'
                );

                echo json_encode($status);
            } else {
                foreach ($this->ModelUtama->fungsiMasukAdmin($data)->result() as $key) {
                    $status = array(
                        'STATUS' => 'BERHASIL',
                        'KETERANGAN' => 'BERHASIL MASUK',
                        'ID_AKUN' => $key->id_admin,
                        'USERNAME' => $username,
                        'TIPEAKUN' => $tipeakun
                    );
                }
                echo json_encode($status);
            }
        }
    }

    public function getKurir()
    {
        $datakurir = $this->ModelUtama->getKurir();
        echo json_encode(array('datakurir' => $datakurir));
    }

    public function getPengguna()
    {
        $datapengguna = $this->ModelUtama->getPengguna();
	echo json_encode(array('datapengguna' => $datapengguna));
    }

    public function fungsiUbahpassword()
    {
        $username = $this->input->post('username');
        $passwordlama = md5($this->input->post('passwordlama'));
        $passwordbaru = md5($this->input->post('passwordbaru'));
        $tipeakun = $this->input->post('tipeakun');

        $cekpassword = $this->ModelUtama->fungsiCekpassword($username, $passwordlama, $tipeakun);

        if ($cekpassword == 0) {
            $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'PASTIKAN PASSWORD LAMA BENAR'
            );

            echo json_encode($status);
        } else {
            $this->ModelUtama->fungsiUbahpassword($username, $passwordbaru, $tipeakun);
        }
    }

    public function refreshReward(){
        $this->ModelUtama->getReward();
    }

    public function getReward()
    {
        $datareward = $this->ModelUtama->getReward();
        echo json_encode(array('datareward' => $datareward));
    }

    public function setReward()
    {
        $hadiah_reward = $this->input->post('hadiah_reward');
        $point_reward = $this->input->post('point_reward');

        $datareward = array(
            'hadiah_reward' => $hadiah_reward,
            'point_reward' => $point_reward
        );

        $this->ModelUtama->setReward($datareward);
        $this->refreshReward();
    }

    public function updateReward()
    {
        $id_reward = $this->input->post('id_reward');

        $where = array('id_reward' => $id_reward);

        $cekreward = $this->ModelUtama->cekreward($where);

        if ($cekreward != 0) {
            $hadiah_reward = $this->input->post('hadiah_reward');
            $point_reward = $this->input->post('point_reward');

            $data = array(
                'hadiah_reward' => $hadiah_reward,
                'point_reward' => $point_reward
            );

            $this->ModelUtama->updateReward($where, $data);
        } else {
            $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'GAGAL MENGUBAH REWARD'
            );

            echo json_encode($status);
        }
    }

    public function deleteReward()
    {
        $id_reward = $this->input->post('id_reward');

        $where = array('id_reward' => $id_reward);

        $cekreward = $this->ModelUtama->cekreward($where);

        if ($cekreward != 0) {
            $this->ModelUtama->deleteReward($where);
        } else {
            $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'GAGAL MENGHAPUS REWARD'
            );

            echo json_encode($status);
        }
        $this->refreshReward();
    }

    public function deleteAkun()
    {
        $username = $this->input->post('username');
        $tipeakun = $this->input->post('tipeakun');

        $cekakun = $this->ModelUtama->fungsiCekakun($username, $tipeakun);

        if ($cekakun != 0) {
            $this->ModelUtama->deleteAkun($username, $tipeakun);
        } else {
            $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'GAGAL MENGHAPUS AKUN'
            );

            echo json_encode($status);
        }
    }

    public function resetpassAkun()
    {
        $username = $this->input->post('username');
        $tipeakun = $this->input->post('tipeakun');

        $cekakun = $this->ModelUtama->fungsiCekakun($username, $tipeakun);

        if ($cekakun != 0) {
            $this->ModelUtama->resetpassAkun($username, $tipeakun);
        } else {
            $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'GAGAL MERESET PASSWORD AKUN'
            );

            echo json_encode($status);
        }
    }
    
    public function getBerlanggananpengguna()
    {
        $id_pengguna = $this->input->post('id_pengguna');

        $cekstatus = $this->ModelUtama->fungsigetStatusberlangganan($id_pengguna);

        if ($cekstatus != 0) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'YA'
            );

            echo json_encode($status);
        } else {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'TIDAK'
            );

            echo json_encode($status);
        }
    }
    
    public function setBerlanggananpengguna()
    {
        $id_pengguna = $this->input->post('id_pengguna');

        $setstatus = $this->ModelUtama->fungsisetStatusberlangganan($id_pengguna);
    }

    public function getTransaksi()
    {
        $datatransaksi = $this->ModelUtama->getTransaksi();
        echo json_encode(array('datatransaksi' => $datatransaksi));
    }

    public function getTransaksipengguna()
    {
        $id_pengguna = $this->input->post('id_pengguna');
        $where = array(
            'id_pengguna' => $id_pengguna,
            'status_transaksi' => 'PROSES'
        );
        $datatransaksipengguna = $this->ModelUtama->getTransaksipengguna($where);
        echo json_encode(array('transaksipengguna' => $datatransaksipengguna));
    }

    public function getTransaksikurir()
    {
        $id_kurir = $this->input->post('id_kurir');
        $where = array(
            'id_kurir' => $id_kurir,
            'status_transaksi' => 'PROSES'
        );
        $datatransaksikurir = $this->ModelUtama->getTransaksikurir($where);
        echo json_encode(array('transaksikurir' => $datatransaksikurir));
    }

    public function fungsiTransaksi()
    {
        $id_pengguna = $this->input->post('id_pengguna');
        $tipe_sampah = $this->input->post('tipe_sampah');
        $id_kurir = $this->input->post('id_kurir');
        $jumlah_transaksi = $this->input->post('jumlah_transaksi');
        $tgl_transaksi = date('Y/m/d');

        $datatransaksi = array(
            'id_pengguna' => $id_pengguna,
            'id_kurir' => $id_kurir,
            'tipe_sampah' => $tipe_sampah,
            'jumlah_transaksi' => $jumlah_transaksi,
            'tgl_transaksi' => $tgl_transaksi,
            'status_transaksi' => 'PROSES'
        );

        if ($id_pengguna == '' || $id_kurir == '' || $jumlah_transaksi == '') {
            $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'TRANSAKSI GAGAL'
            );

            echo json_encode($status);
        } else {
            $transaksi = $this->ModelUtama->fungsiTransaksi($datatransaksi);
        }
    }

    public function getNohppengguna()
    {
        $id_pengguna = $this->input->post('id_pengguna');
        $where = array('id_pengguna' => $id_pengguna);
        $nohppengguna = $this->ModelUtama->getNohppengguna($where);
        echo json_encode($nohppengguna);
    }

    public function getNohpkurir()
    {
        $id_kurir = $this->input->post('id_kurir');
        $where = array('id_kurir' => $id_kurir);
        $nohpkurir = $this->ModelUtama->getNohpkurir($where);
        echo json_encode($nohpkurir);
    }

    public function fungsiBataltransaksi()
    {
        $id_transaksi = $this->input->post('id_transaksi');
        $where = array('id_transaksi' => $id_transaksi);
        if ($id_transaksi == '') {
            $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'GAGAL MEMBATALKAN TRANSAKSI'
            );
            echo json_encode($status);
        } else {
            $this->ModelUtama->fungsiBataltransaksi($where);
        }
    }

    public function fungsiSuksestransaksi()
    {
        $id_transaksi = $this->input->post('id_transaksi');
        $where = array('id_transaksi' => $id_transaksi);

        $id_pengguna = $this->input->post('id_pengguna');
        $jumlah_transaksi = $this->input->post('jumlah_transaksi');
        $data = array(
            'id_pengguna' => $id_pengguna,
            'jumlah_transaksi' => $jumlah_transaksi
        );

        if ($id_transaksi == '') {
            $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'PROSES TRANSAKSI GAGAL'
            );
            echo json_encode($status);
        } else {
            $this->ModelUtama->fungsiSuksestransaksi($where, $data);
        }
    }

    public function fungsiAmbilpoint()
    {
        $id_pengguna = $this->input->post('id_pengguna');
        $where = array('id_pengguna' => $id_pengguna);
	$datapoint = $this->ModelUtama->ambilPoint($where);
	echo json_encode(array('datapoint' => $datapoint));
    }

    public function getTukarpoint()
    {
        $datatukarpoint = $this->ModelUtama->getTukarpoint();
        echo json_encode(array('datatukarpoint' => $datatukarpoint));
    }

    public function fungsiTukarpoint()
    {
        $id_pengguna = $this->input->post('id_pengguna');
        $jumlah_point = $this->input->post('jumlah_point');
        $perlu_point = $this->input->post('perlu_point');
        $id_reward = $this->input->post('id_reward');
	$tgl_tukarpoint = date('Y/m/d');

        if ($id_pengguna == '' || $id_reward == '') {
            $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'GAGAL MENUKAR POINT'
            );

            echo json_encode($status);
        } else {
            if ($jumlah_point < $perlu_point) {
                $status = array(
                    'STATUS' => 'GAGAL',
                    'KETERANGAN' => 'POINT TIDAK CUKUP'
                );

                echo json_encode($status);
            } else {
                $datapoint = array(
                    'id_pengguna' => $id_pengguna,
                    'jumlah_point' => $jumlah_point,
                    'perlu_point' => $perlu_point,
                    'id_reward' => $id_reward,
	 	    'tgl_tukarpoint' => $tgl_tukarpoint
                );

                $this->ModelUtama->fungsiTukarpoint($datapoint);
            }
        }
    }
    
    public function getNohpadmin(){
        $this->ModelUtama->getNohpadmin();
    }
    
    public function setNohpadmin(){
        $nohpadmin = $this->input->post('nohp_admin');
        $datanohp = array(
                    'nohp_admin' => $nohpadmin
        );
        $this->ModelUtama->setNohpadmin($datanohp);
    }
    
    public function getProfilpengguna(){
        $id_pengguna = $this->input->post('id_pengguna');
        $where = array(
                    'id_pengguna' => $id_pengguna
        );
        $this->ModelUtama->getProfilpengguna($where);
    }
    
    public function getProfilkurir(){
        $id_kurir = $this->input->post('id_kurir');
        $where = array(
                    'id_kurir' => $id_kurir
        );
        $this->ModelUtama->getProfilkurir($where);
    }
    
    public function getProfiladmin(){
        $id_admin = $this->input->post('id_admin');
        $where = array(
                    'id_admin' => $id_admin
        );
        $this->ModelUtama->getProfiladmin($where);
    }
    
    public function setNohpkurir(){
        $idkurir = $this->input->post('id_kurir');
        $nohpkurir = $this->input->post('nohp_kurir');
        $where = array(
                    'id_kurir' => $idkurir
        );
        $datanohp = array(
                    'nohp_kurir' => $nohpkurir
        );
        $this->ModelUtama->setNohpkurir($where, $datanohp);
    }
    
    public function setNohppengguna(){
        $idpengguna = $this->input->post('id_pengguna');
        $nohppengguna = $this->input->post('nohp_pengguna');
        $where = array(
                    'id_pengguna' => $idpengguna
        );
        $datanohp = array(
                    'nohp_pengguna' => $nohppengguna
        );
        $this->ModelUtama->setNohppengguna($where, $datanohp);
    }
    
    
}

/* End of file Controllername.php */
				