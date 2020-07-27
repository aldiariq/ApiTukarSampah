<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelUtama extends CI_Model
{

    public function fungsiCekakun($username, $tipeakun)
    {
        if ($tipeakun == 'KURIR') {
            $datacek = array('username_kurir' => $username);
            $query = $this->db->get_where('tb_kurir', $datacek);
        } else if ($tipeakun == 'PENGGUNA') {
            $datacek = array('username_pengguna' => $username);
            $query = $this->db->get_where('tb_pengguna', $datacek);
        }

        return $query->num_rows();
    }

    public function fungsiDaftarKurir($data)
    {
        $query = $this->db->insert('tb_kurir', $data);
        if ($query) {
            $data = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'REGISTRASI KURIR BERHASIL'
            );
        } else {
            $data = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'REGISTRASI KURIR GAGAL'
            );
        }

        return $data;
    }

    public function fungsiDaftarPengguna($data)
    {
        $query = $this->db->insert('tb_pengguna', $data);
        if ($query) {
            $data = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'REGISTRASI PENGGUNA BERHASIL'
            );
        } else {
            $data = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'REGISTRASI PENGGUNA GAGAL'
            );
        }

        return $data;
    }

    public function fungsiMasukKurir($data)
    {
        $query = $this->db->get_where('tb_kurir', $data);
        return $query;
    }

    public function fungsiMasukPengguna($data)
    {
        $query = $this->db->get_where('tb_pengguna', $data);
        return $query;
    }

    public function fungsiMasukAdmin($data)
    {
        $query = $this->db->get_where('tb_admin', $data);
        return $query;
    }

    public function fungsiCekpassword($username, $passwordlama, $tipeakun)
    {
        if ($tipeakun == 'KURIR') {
            $datapassword = array(
                'username_kurir' => $username,
                'password_kurir' => $passwordlama
            );

            $query = $this->db->get_where('tb_kurir', $datapassword);
        } else if ($tipeakun == 'PENGGUNA') {
            $datapassword = array(
                'username_pengguna' => $username,
                'password_pengguna' => $passwordlama
            );

            $query = $this->db->get_where('tb_pengguna', $datapassword);
        } else if ($tipeakun == 'ADMIN') {
            $datapassword = array(
                'username_admin' => $username,
                'password_admin' => $passwordlama
            );

            $query = $this->db->get_where('tb_admin', $datapassword);
        }

        return $query->num_rows();
    }

    public function getKurir()
    {
        $query = $this->db->query('SELECT id_kurir, username_kurir FROM tb_kurir');
        return $query->result();
    }

    public function getPengguna()
    {
        $query = $this->db->query('SELECT id_pengguna, username_pengguna, nohp_pengguna FROM tb_pengguna');
        return $query->result();
    }

    public function fungsiUbahpassword($username, $passwordbaru, $tipeakun)
    {
        if ($tipeakun == 'KURIR') {
            $datausername = array('username_kurir' => $username);

            $datapassword = array('password_kurir' => $passwordbaru);

            $query = $this->db->where($datausername);
            $query = $this->db->update('tb_kurir', $datapassword);

            if ($query) {
                $status = array(
                    'STATUS' => 'BERHASIL',
                    'KETERANGAN' => 'BERHASIL MENGGANTI PASSWORD'
                );

                echo json_encode($status);
            } else {
                $status = array(
                    'STATUS' => 'GAGAL',
                    'KETERANGAN' => 'GAGAL MENGGANTI PASSWORD'
                );

                echo json_encode($status);
            }
        } else if ($tipeakun == 'PENGGUNA') {
            $datausername = array('username_pengguna' => $username);

            $datapassword = array('password_pengguna' => $passwordbaru);

            $query = $this->db->where($datausername);
            $query = $this->db->update('tb_pengguna', $datapassword);

            if ($query) {
                $status = array(
                    'STATUS' => 'BERHASIL',
                    'KETERANGAN' => 'BERHASIL MENGGANTI PASSWORD'
                );

                echo json_encode($status);
            } else {
                $status = array(
                    'STATUS' => 'GAGAL',
                    'KETERANGAN' => 'GAGAL MENGGANTI PASSWORD'
                );

                echo json_encode($status);
            }
        } else if ($tipeakun == 'ADMIN') {
            $datausername = array('username_admin' => $username);

            $datapassword = array('password_admin' => $passwordbaru);

            $query = $this->db->where($datausername);
            $query = $this->db->update('tb_admin', $datapassword);

            if ($query) {
                $status = array(
                    'STATUS' => 'BERHASIL',
                    'KETERANGAN' => 'BERHASIL MENGGANTI PASSWORD'
                );

                echo json_encode($status);
            } else {
                $status = array(
                    'STATUS' => 'GAGAL',
                    'KETERANGAN' => 'GAGAL MENGGANTI PASSWORD'
                );

                echo json_encode($status);
            }
        }
    }

    public function getReward()
    {
        $query = $this->db->get('tb_reward');
        return $query->result();
    }

    public function setReward($datareward)
    {
        $query = $this->db->insert('tb_reward', $datareward);
        if ($query) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'BERHASIL MENAMBAHKAN REWARD'
            );

            echo json_encode($status);
        } else {
            $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'GAGAL MENAMBAHKAN REWARD'
            );

            echo json_encode($status);
        }
    }

    public function cekreward($where)
    {
        $query = $this->db->get_where('tb_reward', $where);
        return $query->num_rows();
    }

    public function updateReward($where, $data)
    {
        $query = $this->db->where($where);
        $query = $this->db->update('tb_reward', $data);

        if ($query) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'BERHASIL MENGUBAH REWARD'
            );

            echo json_encode($status);
        }
    }

    public function deleteReward($where)
    {
        $query = $this->db->where($where);
        $query = $this->db->delete('tb_reward');

        if ($query) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'BERHASIL MENGHAPUS REWARD'
            );

            echo json_encode($status);
        }
    }

    public function deleteAkun($username, $tipeakun)
    {
        if ($tipeakun == 'KURIR') {
            $dataakun = array('username_kurir' => $username);
            $query = $this->db->where($dataakun);
            $query = $this->db->delete('tb_kurir');
        } else if ($tipeakun == 'PENGGUNA') {
            $dataakun = array('username_pengguna' => $username);
            $query = $this->db->where($dataakun);
            $query = $this->db->delete('tb_pengguna');
        }

        if ($query) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'BERHASIL MENGHAPUS AKUN'
            );

            echo json_encode($status);
        }
    }

    public function resetpassAkun($username, $tipeakun)
    {
        if ($tipeakun == 'KURIR') {
            $dataakun = array('username_kurir' => $username);
            $passwordawal = array('password_kurir' => md5($username));
            $query = $this->db->where($dataakun);
            $query = $this->db->update('tb_kurir', $passwordawal);
        } else if ($tipeakun == 'PENGGUNA') {
            $dataakun = array('username_pengguna' => $username);
            $passwordawal = array('password_pengguna' => md5($username));
            $query = $this->db->where($dataakun);
            $query = $this->db->update('tb_pengguna', $passwordawal);
        }

        if ($query) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'BERHASIL MERESET PASSWORD AKUN'
            );

            echo json_encode($status);
        }
    }

    public function ambilPoint($where)
    {
        $query = $this->db->get_where('tb_point', $where);
        return $query->result();
    }
    
    public function fungsigetStatusberlangganan($id_pengguna){
        $tempstatus = array(
            'id_pengguna' => $id_pengguna,
            'status_langganan' => 'YA'
        );
        
        $query = $this->db->get_where('tb_pengguna', $tempstatus);
        $query = $query->num_rows();
        return $query;
    }
    
    public function fungsisetStatusberlangganan($id_pengguna){
        $where = array(
            'id_pengguna' => $id_pengguna
        );
        
        $tempstatus = array(
            'status_langganan' => 'YA'
        );
        
        $query = $this->db->where($where);
        $query = $this->db->update('tb_pengguna', $tempstatus);
        
        if ($query = $this->db->affected_rows()) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'BERHASIL BERLANGGANAN'
            );
            echo json_encode($status);
        }else {
	    $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'GAGAL BERLANGGANAN'
            );
            echo json_encode($status);
	    }
    }

    public function getTransaksi()
    {
        $query = $this->db->select('tb_pengguna.username_pengguna, tb_kurir.username_kurir, tb_transaksi.jumlah_transaksi, tb_transaksi.tgl_transaksi');
        $query = $this->db->from('tb_transaksi');
        $query = $this->db->join('tb_pengguna', 'tb_pengguna.id_pengguna = tb_transaksi.id_pengguna');
        $query = $this->db->join('tb_kurir', 'tb_kurir.id_kurir = tb_transaksi.id_kurir');
        $query = $this->db->get();
        return $query->result();
    }

    public function getTransaksipengguna($where)
    {
	$query = $this->db->select('tb_pengguna.username_pengguna, tb_kurir.username_kurir, tb_kurir.nohp_kurir, tb_kurir.alamat_kurir, tb_transaksi.*');
	$query = $this->db->from('tb_transaksi');
	$query = $this->db->join('tb_pengguna', 'tb_pengguna.id_pengguna = tb_transaksi.id_pengguna');
	$query = $this->db->join('tb_kurir', 'tb_kurir.id_kurir = tb_transaksi.id_kurir');
	$query = $this->db->where('tb_transaksi.id_pengguna', $where['id_pengguna']);
	$query = $this->db->where('tb_transaksi.status_transaksi', 'PROSES');
	$query = $this->db->get();
        return $query->result();
    }

    public function getTransaksikurir($where)
    {
        $query = $this->db->select('tb_kurir.username_kurir, tb_pengguna.username_pengguna, tb_pengguna.nohp_pengguna, tb_pengguna.alamat_pengguna, tb_transaksi.*');
        $query = $this->db->from('tb_transaksi');
        $query = $this->db->join('tb_kurir', 'tb_kurir.id_kurir = tb_transaksi.id_kurir');
	$query = $this->db->join('tb_pengguna', 'tb_pengguna.id_pengguna = tb_transaksi.id_pengguna');
        $query = $this->db->where('tb_transaksi.id_kurir', $where['id_kurir']);
        $query = $this->db->where('tb_transaksi.status_transaksi', 'PROSES');
        $query = $this->db->get();
        return $query->result();

    }

    public function fungsiBataltransaksi($where)
    {
        $query = $this->db->where($where);
        $bataltransaksi = array('status_transaksi' => 'BATAL');
        $query = $this->db->update('tb_transaksi', $bataltransaksi);
        if ($query = $this->db->affected_rows()) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'BERHASIL MEMBATALKAN TRANSAKSI'
            );
            echo json_encode($status);
        }else {
	    $status = array(
                'STATUS' => 'GAGAL',
                'KETERANGAN' => 'GAGAL MEMBATALKAN TRANSAKSI'
            );
            echo json_encode($status);
	}
    }

    public function getNohppengguna($where)
    {
        $query = $this->db->where($where);
        $query = $this->db->query('SELECT nohp_pengguna FROM tb_pengguna WHERE id_pengguna = '.$where['id_pengguna']);
        return $query->result();
    }

    public function getNohpkurir($where)
    {
        $query = $this->db->where($where);
        $query = $this->db->query('SELECT nohp_kurir FROM tb_kurir WHERE id_kurir = '.$where['id_kurir']);
        return $query->result();
    }

    public function fungsiSuksestransaksi($where, $data)
    {
        $query = $this->db->where($where);
        $suksestransaksi = array('status_transaksi' => 'SELESAI');
        $query = $this->db->update('tb_transaksi', $suksestransaksi);

        $where = array('id_pengguna' => $data['id_pengguna']);

        $datapoint = array(
            'jumlah_point' => $data['jumlah_transaksi'] * 10,
            'id_pengguna' => $data['id_pengguna']
        );

        if ($this->ambilPoint($where) == null) {
            $query = $this->db->insert('tb_point', $datapoint);
        } else {
            foreach ($this->ambilPoint($where) as $point) {
                $query = $this->db->where('id_point', $point->id_point);
                $tempdatapoint = array(
                    'jumlah_point' => $point->jumlah_point + ($data['jumlah_transaksi'] * 10),
                    'id_pengguna' => $data['id_pengguna']
                );
                $query = $this->db->update('tb_point', $tempdatapoint);
            }
        }

        if ($query = $this->db->affected_rows()) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'PROSES TRANSAKSI BERHASIL'
            );
            echo json_encode($status);
        }
    }

    public function fungsiTransaksi($datatransaksi)
    {
        $query = $this->db->insert('tb_transaksi', $datatransaksi);

        if ($query) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'TRANSAKSI BERHASIL'
            );

            echo json_encode($status);
        }
    }

    public function getTukarpoint()
    {
        $query = $this->db->select('tb_pengguna.username_pengguna, tb_reward.hadiah_reward, tb_reward.point_reward, tb_tukarpoint.tgl_tukarpoint');
        $query = $this->db->from('tb_tukarpoint');
        $query = $this->db->join('tb_pengguna', 'tb_pengguna.id_pengguna = tb_tukarpoint.id_pengguna');
        $query = $this->db->join('tb_reward', 'tb_reward.id_reward = tb_tukarpoint.id_reward');
        $query = $this->db->get();
        return $query->result();
    }

    public function fungsiTukarpoint($datapoint)
    {
        $query = $this->db->insert('tb_tukarpoint', $datapoint);

        $query = $this->db->where('id_pengguna', $datapoint['id_pengguna']);

        $tempdatapoint = array(
            'jumlah_point' => $datapoint['jumlah_point'] - $datapoint['perlu_point'],
            'id_pengguna' => $datapoint['id_pengguna']
        );

        $query = $this->db->update('tb_point', $tempdatapoint);

        if ($query) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'BERHASIL MENUKAR POINT',
            );

            echo json_encode($status);
        }
    }
    
    public function getNohpadmin(){
        $query = $this->db->select('nohp_admin'); 
        $query = $this->db->from('tb_admin');   
        $query = $this->db->get()->result();
        
        foreach($query as $dataquery){
            $status = array(
                'STATUS' => 'BERHASIL',
                'NOHP_ADMIN' => $dataquery->nohp_admin
            );

            echo json_encode($status);
        }
        
        
    }
    
    public function setNohpadmin($datanohp){
        $where = array(
            'username_admin' => 'admin'
        );
        $query = $this->db->where($where);
        $query = $this->db->update('tb_admin', $datanohp);
        if ($query = $this->db->affected_rows()) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'BERHASIL MENGGANTI NO HP',
            );

            echo json_encode($status);
        }else {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'GAGAL MENGGANTI NO HP',
            );

            echo json_encode($status);
        }
    }
    
    public function getProfilpengguna($where){
        $query = $this->db->select('id_pengguna, username_pengguna, nohp_pengguna, alamat_pengguna, tipe_akun');
        $query = $this->db->from('tb_pengguna');
        $qyert = $this->db->where($where);
        $query = $this->db->get()->result();;
        foreach($query as $dataquery){
            $status = array(
                'STATUS' => 'BERHASIL',
                'ID_PENGGUNA' => $dataquery->id_pengguna,
                'USERNAME_PENGGUNA' => $dataquery->username_pengguna,
                'NOHP_PENGGUNA' => $dataquery->nohp_pengguna,
                'ALAMAT_PENGGUNA' => $dataquery->alamat_pengguna,
                'TIPE_AKUN' => $dataquery->tipe_akun,
            );

            echo json_encode($status);
        }
    }
    
    public function getProfilkurir($where){
        $query = $this->db->select('id_kurir, username_kurir, nohp_kurir, alamat_kurir, tipe_akun');
        $query = $this->db->from('tb_kurir');
        $query = $this->db->where($where);
        $query = $this->db->get()->result();
        foreach($query as $dataquery){
            $status = array(
                'STATUS' => 'BERHASIL',
                'ID_KURIR' => $dataquery->id_kurir,
                'USERNAME_KURIR' => $dataquery->username_kurir,
                'NOHP_KURIR' => $dataquery->nohp_kurir,
                'ALAMAT_KURIR' => $dataquery->alamat_kurir,
                'TIPE_AKUN' => $dataquery->tipe_akun,
            );

            echo json_encode($status);
        }
    }
    
    public function getProfiladmin($where){
        $query = $this->db->select('id_admin, username_admin, nohp_admin, tipe_akun');
        $query = $this->db->from('tb_admin');
        $query = $this->db->where($where);
        $query = $this->db->get()->result();
        foreach($query as $dataquery){
            $status = array(
                'STATUS' => 'BERHASIL',
                'ID_ADMIN' => $dataquery->id_admin,
                'USERNAME_ADMIN' => $dataquery->username_admin,
                'NOHP_ADMIN' => $dataquery->nohp_admin,
                'TIPE_AKUN' => $dataquery->tipe_akun
            );

            echo json_encode($status);
        }
    }
    
    public function setNohpkurir($where, $datanohp){
        $query = $this->db->where($where);
        $query = $this->db->update('tb_kurir', $datanohp);
        if ($query = $this->db->affected_rows()) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'BERHASIL MENGGANTI NO HP',
            );

            echo json_encode($status);
        }else {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'GAGAL MENGGANTI NO HP',
            );

            echo json_encode($status);
        }
    }
    
    public function setNohppengguna($where, $datanohp){
        $query = $this->db->where($where);
        $query = $this->db->update('tb_pengguna', $datanohp);
        if ($query = $this->db->affected_rows()) {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'BERHASIL MENGGANTI NO HP',
            );

            echo json_encode($status);
        }else {
            $status = array(
                'STATUS' => 'BERHASIL',
                'KETERANGAN' => 'GAGAL MENGGANTI NO HP',
            );

            echo json_encode($status);
        }
    }
}

/* End of file ModelUtama.php */
