<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Model Sales Order
 *
 * @author White Code
 */
class M_sales_order extends CI_Model
{
    public $table = 'trx_sales_order';
    public $table_relation = 'trx_sales_order_detail';
    public $pk = 'so_id';

    public function __construct()
    {
        parent::__construct();
    }

    function getAll()
    {
        $q = $this->db->query("
            SELECT 
				DISTINCT
                a.*, b.name as customer, c.name as member,
				d.f_status,
				b.id as cuid, c.id as meid
            FROM
                trx_sales_order a
			left outer join trx_faktur_sales_order d on d.fso_so_id = a.so_id
            LEFT JOIN mst_customer b ON a.so_customer_id = b.id
            LEFT JOIN mst_member c ON a.so_member_id = c.id
            ORDER BY a.so_created_at DESC
        ");

        return $q->result();
    }

    function find($id)
    {
        $q = $this->db->query("
            SELECT 
                a.*, 
				b.name as customer, 
				c.name as member, 
				d.name as sales, 
				b.toko as toko, 
				b.address as alamat,
				
                CONCAT(e.code, f.code, ' ', f.name, ' ', e.name, ' ', g.name) AS brgname
				, z.name jname, b.code ccode,
				y.fso_remark,
				u1.sign as so_created_sign
            FROM
                $this->table a
            LEFT JOIN mst_customer b ON a.so_customer_id = b.id
            LEFT JOIN mst_member c ON a.so_member_id = c.id
            LEFT JOIN mst_sales d ON a.so_sales_id = d.id
			
			
            LEFT JOIN mst_barang e ON a.so_brg_id_trade = e.id
            LEFT JOIN mst_group f ON e.kategori = f.id
            LEFT JOIN mst_merk g ON e.merk = g.id
			
			
			left outer join mst_jenis_usaha z on b.jenisusaha = z.id
			left outer join trx_faktur_sales_order y on a.so_id = y.fso_so_id
			left outer join users u1 on d.name = u1.first_name
			
            WHERE a.so_id = $id
        ");

        return $q->row();
    }

    // Updated by Delian H (25/03/2021)
    function getCustomerStatusById($customer_id)
    {
        $this->db->select('status');
        $q = $this->db->get_where('mst_customer', ['id' => $customer_id]);

        return $q->row();
    }

    function getCustomerLimitById($customer_id)
    {
        $this->db->select('limit');
        $q = $this->db->get_where('mst_customer', ['id' => $customer_id]);

        return $q->row();
    }

    function getCustomerTopById($customer_id)
    {
        $this->db->select('top');
        $q = $this->db->get_where('mst_customer', ['id' => $customer_id]);

        return $q->row();
    }

    function getMemberStatusById($member_id)
    {
        $this->db->select('status');
        $q = $this->db->get_where('mst_customer', ['id' => $member_id]);

        return $q->row();
    }
    // End of Update

    /*function getBarangByIds($id)
    {
        $q = $this->db->query("
            SELECT 
                a.id AS id, 
                CONCAT('[STOK: ', (ifnull(a.rstok,0) + ifnull(d.qty,0) + ifnull(e.qty,0) + ifnull(h.qty,0)) - (ifnull(f.qty,0) + ifnull(g.qty,0)), ' ] - ', b.code, a.code, ' ', b.name, ' ', a.name, ' ', c.name) AS name,
				(ifnull(a.rstok,0) + ifnull(d.qty,0) + ifnull(e.qty,0) + ifnull(h.qty,0)) - (ifnull(f.qty,0) + ifnull(g.qty,0)) as stock
            FROM mst_barang a
            LEFT JOIN mst_group b ON a.kategori = b.id
            LEFT JOIN mst_merk c ON a.merk = c.id
			
			LEFT OUTER JOIN (
				select 
					a.invd_brg_id brg_id,
					SUM(a.invd_qty) qty
				from trx_invoice_detail a
				left outer join trx_invoice b on b.inv_id = a.invd_inv_id
				LEFT OUTER JOIN trx_receive_order d ON b.inv_rcv_id = d.rcv_id
				LEFT OUTER JOIN mst_alamat e ON d.rcv_receiver_type = e.alm_id
				WHERE d.rcv_receiver_type = 1
				AND b.inv_status = 2
				GROUP BY a.invd_brg_id
			) d ON a.id = d.brg_id
			LEFT OUTER JOIN (
				select 
					a.pbd_brg_id brg_id,
					SUM(a.pbd_qty) qty
				from trx_pindah_barang_detail a
				left outer join trx_pindah_barang b ON b.pb_id = a.pbd_pb_id
				LEFT OUTER JOIN mst_alamat e ON b.pb_id_alamat_tujuan = e.alm_id
				WHERE b.pb_id_alamat_tujuan = 1
				AND b.pb_status = 3
				GROUP BY a.pbd_brg_id
			) e ON a.id = e.brg_id

			LEFT OUTER JOIN (
				select 
					a.pbd_brg_id brg_id,
					SUM(a.pbd_qty) qty
				from trx_pindah_barang_detail a
				left outer join trx_pindah_barang b ON b.pb_id = a.pbd_pb_id
				LEFT OUTER JOIN mst_alamat e ON b.pb_id_alamat_asal = e.alm_id
				WHERE b.pb_id_alamat_asal = 1
				AND b.pb_status = 3
				GROUP BY a.pbd_brg_id
				
			)f ON a.id = f.brg_id
			LEFT OUTER JOIN(
				select 
					b.sod_brg_id brg_id,	
					SUM(CASE 1 WHEN 1  THEN b.sod_qty ELSE 0 END) qty
				from trx_faktur_sales_order a
				left outer join trx_sales_order_detail b on a.fso_so_id = b.sod_so_id 
				where f_status = 0
				GROUP BY b.sod_brg_id
			) g ON a.id = g.brg_id
			LEFT OUTER JOIN(
				select 
					b.so_brg_id_trade brg_id,	
					SUM(1) qty
				from trx_faktur_sales_order a
				left outer join trx_sales_order b on a.fso_so_id = b.so_id 
				where f_status = 0
				GROUP BY b.so_brg_id_trade
			) h ON a.id = h.brg_id
			
            WHERE ((ifnull(a.rstok,0) + ifnull(d.qty,0) + ifnull(e.qty,0) + ifnull(h.qty,0)) - (ifnull(f.qty,0) + ifnull(g.qty,0))) > 0
			AND a.id = $id
        ");

        return $q->row();
    }*/
    function getBarangByIds($id, $alamat_id)
    {
        $q = $this->db->query("
		select a.id, a.stok, (ifnull(b.invd_qty,0))+(ifnull(f.stok,0))-(ifnull(g.pbd_qty,0))-(ifnull(e.sod_qty,0)) as stoktoko,  d.rcv_receiver 
		from mst_barang a 
			LEFT OUTER JOIN trx_invoice_detail b on a.id = b.invd_brg_id
			LEFT OUTER JOIN trx_invoice c on b.invd_inv_id=c.inv_id
			LEFT OUTER JOIN trx_receive_order d on c.inv_rcv_id=d.rcv_id
			LEFT OUTER JOIN trx_sales_order_detail e on d.rcv_receiver=e.sod_alamat_id
			LEFT OUTER JOIN (select a.*, b.* from mst_barang a 
						LEFT OUTER JOIN trx_pindah_barang_detail b on a.id=b.pbd_brg_id
					where a.id=$id and b.pbd_pb_id_alamat_asal = $alamat_id ) g on a.id=g.pbd_brg_id
			LEFT OUTER JOIN (select a.*, b.* from mst_barang a
						LEFT OUTER JOIN trx_sales_order b on a.id = b.so_brg_id_trade
					where a.id= $id and b.so_alamat_id = $alamat_id )f on a.id=f.so_brg_id_trade
		where (ifnull(b.invd_qty,0))+(ifnull(f.stok,0))-(ifnull(e.sod_qty,0))-(ifnull(g.pbd_qty,0)) > 0 and a.id= $id 
		");

        return $q->row();
    }

    function getBarang()
    {
        $q = $this->db->query("
            SELECT 
                a.id AS id, 
                CONCAT('[STOK: ', (ifnull(a.stok,0) + ifnull(d.qty,0) + ifnull(e.qty,0) + ifnull(h.qty,0)) - (ifnull(f.qty,0) + ifnull(g.qty,0)), ' ] - ', b.code, a.code, ' ', b.name, ' ', a.name, ' ', c.name) AS name
            FROM mst_barang a
            LEFT JOIN mst_group b ON a.kategori = b.id
            LEFT JOIN mst_merk c ON a.merk = c.id
			
			LEFT OUTER JOIN (
				select 
					a.invd_brg_id brg_id,
					SUM(a.invd_qty) qty
				from trx_invoice_detail a
				left outer join trx_invoice b on b.inv_id = a.invd_inv_id
				LEFT OUTER JOIN trx_receive_order d ON b.inv_rcv_id = d.rcv_id
				LEFT OUTER JOIN mst_alamat e ON d.rcv_receiver_type = e.alm_id
				WHERE d.rcv_receiver_type = 1
				AND b.inv_status = 2
				GROUP BY a.invd_brg_id
			) d ON a.id = d.brg_id
			LEFT OUTER JOIN (
				select 
					a.pbd_brg_id brg_id,
					SUM(a.pbd_qty) qty
				from trx_pindah_barang_detail a
				left outer join trx_pindah_barang b ON b.pb_id = a.pbd_pb_id
				LEFT OUTER JOIN mst_alamat e ON b.pb_id_alamat_tujuan = e.alm_id
				WHERE b.pb_id_alamat_tujuan = 1
				AND b.pb_status = 3
				GROUP BY a.pbd_brg_id
			) e ON a.id = e.brg_id

			LEFT OUTER JOIN (
				select 
					a.pbd_brg_id brg_id,
					SUM(a.pbd_qty) qty
				from trx_pindah_barang_detail a
				left outer join trx_pindah_barang b ON b.pb_id = a.pbd_pb_id
				LEFT OUTER JOIN mst_alamat e ON b.pb_id_alamat_asal = e.alm_id
				WHERE b.pb_id_alamat_asal = 1
				AND b.pb_status = 3
				GROUP BY a.pbd_brg_id
				
			)f ON a.id = f.brg_id
			LEFT OUTER JOIN(
				select 
					b.sod_brg_id brg_id,	
					SUM(CASE 1 WHEN 1  THEN b.sod_qty ELSE 0 END) qty
				from trx_faktur_sales_order a
				left outer join trx_sales_order_detail b on a.fso_so_id = b.sod_so_id 
				where f_status = 0
				GROUP BY b.sod_brg_id
			) g ON a.id = g.brg_id
			LEFT OUTER JOIN(
				select 
					b.so_brg_id_trade brg_id,	
					SUM(1) qty
				from trx_faktur_sales_order a
				left outer join trx_sales_order b on a.fso_so_id = b.so_id 
				where f_status = 0
				GROUP BY b.so_brg_id_trade
			) h ON a.id = h.brg_id
			LEFT OUTER JOIN(
				SELECT c.pc_id_barang as brg_id,
					case 1 when 1 THEN SUM(1) else 0 end as qty
				FROM trx_tukar_barang_claim a
				LEFT JOIN trx_approve_permintaan_claim b ON b.app_id = a.tbc_idpermintaan_claim
				LEFT JOIN trx_permintaan_claim c ON c.pc_id = b.app_idpermintaan_claim
				where a.tbc_id is not null
				and a.tbc_status =3
				GROUP BY pc_id_barang
			) i ON a.id = i.brg_id
			
            WHERE ((ifnull(a.stok,0) + ifnull(d.qty,0) + ifnull(e.qty,0) + ifnull(h.qty,0)) - (ifnull(f.qty,0) + ifnull(g.qty,0))) > 0
        ");

        return $q->result();
    }

    /*function getBarangByAlamatId($alamat_id)
    {
        $q = $this->db->query("
            SELECT 
                a.id AS id, 
                CONCAT('[STOK: ', (ifnull(a.rstok,0) + ifnull(d.qty,0) + ifnull(e.qty,0) + ifnull(h.qty,0)) - (ifnull(f.qty,0) + ifnull(g.qty,0)), ' ] - ', b.code, a.code, ' ', b.name, ' ', a.name, ' ', c.name) AS name
            FROM mst_barang a
            LEFT JOIN mst_group b ON a.kategori = b.id
            LEFT JOIN mst_merk c ON a.merk = c.id
			
			LEFT OUTER JOIN (
				select 
					a.invd_brg_id brg_id,
					SUM(a.invd_qty) qty
				from trx_invoice_detail a
				left outer join trx_invoice b on b.inv_id = a.invd_inv_id
				LEFT OUTER JOIN trx_receive_order d ON b.inv_rcv_id = d.rcv_id
				LEFT OUTER JOIN mst_alamat e ON d.rcv_receiver_type = e.alm_id
				WHERE d.rcv_receiver_type = $alamat_id
				AND b.inv_status = 2
				GROUP BY a.invd_brg_id
			) d ON a.id = d.brg_id
			LEFT OUTER JOIN (
				select 
					a.pbd_brg_id brg_id,
					SUM(a.pbd_qty) qty
				from trx_pindah_barang_detail a
				left outer join trx_pindah_barang b ON b.pb_id = a.pbd_pb_id
				LEFT OUTER JOIN mst_alamat e ON b.pb_id_alamat_tujuan = e.alm_id
				WHERE b.pb_id_alamat_tujuan = $alamat_id
				AND b.pb_status = 3
				GROUP BY a.pbd_brg_id
			) e ON a.id = e.brg_id

			LEFT OUTER JOIN (
				select 
					a.pbd_brg_id brg_id,
					SUM(a.pbd_qty) qty
				from trx_pindah_barang_detail a
				left outer join trx_pindah_barang b ON b.pb_id = a.pbd_pb_id
				LEFT OUTER JOIN mst_alamat e ON b.pb_id_alamat_asal = e.alm_id
				WHERE b.pb_id_alamat_asal = $alamat_id
				AND b.pb_status = 3
				GROUP BY a.pbd_brg_id
				
			)f ON a.id = f.brg_id
			LEFT OUTER JOIN(
				select 
					b.sod_brg_id brg_id,	
					SUM(CASE $alamat_id WHEN 1  THEN b.sod_qty ELSE 0 END) qty
				from trx_faktur_sales_order a
				left outer join trx_sales_order_detail b on a.fso_so_id = b.sod_so_id 
				where f_status = 0
				GROUP BY b.sod_brg_id
			) g ON a.id = g.brg_id
			LEFT OUTER JOIN(
				select 
					b.so_brg_id_trade brg_id,	
					SUM(1) qty
				from trx_faktur_sales_order a
				left outer join trx_sales_order b on a.fso_so_id = b.so_id 
				where f_status = 0
				GROUP BY b.so_brg_id_trade
			) h ON a.id = h.brg_id
			LEFT OUTER JOIN(
				SELECT c.pc_id_barang as brg_id,
					case $alamat_id when 1 THEN SUM(1) else 0 end as qty
				FROM trx_tukar_barang_claim a
				LEFT JOIN trx_approve_permintaan_claim b ON b.app_id = a.tbc_idpermintaan_claim
				LEFT JOIN trx_permintaan_claim c ON c.pc_id = b.app_idpermintaan_claim
				where a.tbc_id is not null
				and a.tbc_status =3
				GROUP BY pc_id_barang
			) i ON a.id = i.brg_id
			
            WHERE ((ifnull(a.rstok,0) + ifnull(d.qty,0) + ifnull(e.qty,0) + ifnull(h.qty,0)) - (ifnull(f.qty,0) + ifnull(g.qty,0))) > 0
        ");

        return $q->result();
    }*/

    function getBarangByAlamatId($alamat_id)
    {
        $q = $this->db->query("
            SELECT 
                a.id AS id, 
                CONCAT('[STOK: ', (ifnull(d.qty,0) + ifnull(e.qty,0) + ifnull(h.qty,0)) - (ifnull(f.qty,0) + ifnull(g.qty,0)), ' ] - ', b.code, a.code, ' ', b.name, ' ', a.name, ' ', c.name) AS name
            FROM mst_barang a
            LEFT JOIN mst_group b ON a.kategori = b.id
            LEFT JOIN mst_merk c ON a.merk = c.id
			
			LEFT OUTER JOIN (
				select 
					a.invd_brg_id brg_id,
					SUM(a.invd_qty) qty
				from trx_invoice_detail a
				left outer join trx_invoice b on b.inv_id = a.invd_inv_id
				LEFT OUTER JOIN trx_receive_order d ON b.inv_rcv_id = d.rcv_id
				LEFT OUTER JOIN mst_alamat e ON d.rcv_receiver_type = e.alm_id
				WHERE d.rcv_receiver_type = $alamat_id
				AND b.inv_status = 2
				GROUP BY a.invd_brg_id
			) d ON a.id = d.brg_id
			LEFT OUTER JOIN (
				select 
					a.pbd_brg_id brg_id,
					SUM(a.pbd_qty) qty
				from trx_pindah_barang_detail a
				left outer join trx_pindah_barang b ON b.pb_id = a.pbd_pb_id
				LEFT OUTER JOIN mst_alamat e ON b.pb_id_alamat_tujuan = e.alm_id
				WHERE b.pb_id_alamat_tujuan = $alamat_id
				AND b.pb_status = 3
				GROUP BY a.pbd_brg_id
			) e ON a.id = e.brg_id

			LEFT OUTER JOIN (
				select 
					a.pbd_brg_id brg_id,
					SUM(a.pbd_qty) qty
				from trx_pindah_barang_detail a
				left outer join trx_pindah_barang b ON b.pb_id = a.pbd_pb_id
				LEFT OUTER JOIN mst_alamat e ON b.pb_id_alamat_asal = e.alm_id
				WHERE b.pb_id_alamat_asal = $alamat_id
				AND b.pb_status = 3
				GROUP BY a.pbd_brg_id
				
			)f ON a.id = f.brg_id
			LEFT OUTER JOIN(
				select 
					b.sod_brg_id brg_id,	
					SUM(b.sod_qty) qty
				from trx_faktur_sales_order a
				left outer join trx_sales_order_detail b on a.fso_so_id = b.sod_so_id 
				where f_status = 0 and b.sod_alamat_id = $alamat_id
				GROUP BY b.sod_brg_id
			) g ON a.id = g.brg_id
			LEFT OUTER JOIN(
				select 
					b.so_brg_id_trade brg_id,	
					SUM(1) qty
				from trx_faktur_sales_order a
				left outer join trx_sales_order b on a.fso_so_id = b.so_id 
				where f_status = 0 and b.so_alamat_id = $alamat_id
				GROUP BY b.so_brg_id_trade
			) h ON a.id = h.brg_id
			LEFT OUTER JOIN(
				SELECT c.pc_id_barang as brg_id,
					case $alamat_id when 1 THEN SUM(1) else 0 end as qty
				FROM trx_tukar_barang_claim a
				LEFT JOIN trx_approve_permintaan_claim b ON b.app_id = a.tbc_idpermintaan_claim
				LEFT JOIN trx_permintaan_claim c ON c.pc_id = b.app_idpermintaan_claim
				where a.tbc_id is not null
				and a.tbc_status =3
				GROUP BY pc_id_barang
			) i ON a.id = i.brg_id
			
            WHERE ((ifnull(d.qty,0) + ifnull(e.qty,0) + ifnull(h.qty,0)) - (ifnull(f.qty,0) + ifnull(g.qty,0))) > 0
        ");

        return $q->result();
    }

    function getBarangByAlamatIdanduser($alamat_id)
    {
        $q = $this->db->query("
            SELECT 
                a.id AS id, 
                CONCAT('[STOK: ', (ifnull(d.qty,0) + ifnull(e.qty,0) + ifnull(h.qty,0)) - (ifnull(f.qty,0) + ifnull(g.qty,0)), ' ] - ', b.code, a.code, ' ', b.name, ' ', a.name, ' ', c.name) AS name
            FROM mst_barang a
            LEFT JOIN mst_group b ON a.kategori = b.id
            LEFT JOIN mst_merk c ON a.merk = c.id
			
			LEFT OUTER JOIN (
				select 
					a.invd_brg_id brg_id,
					SUM(a.invd_qty) qty
				from trx_invoice_detail a
				left outer join trx_invoice b on b.inv_id = a.invd_inv_id
				LEFT OUTER JOIN trx_receive_order d ON b.inv_rcv_id = d.rcv_id
				LEFT OUTER JOIN mst_alamat e ON d.rcv_receiver_type = e.alm_id
				WHERE d.rcv_receiver_type = $alamat_id
				AND b.inv_status = 2
				GROUP BY a.invd_brg_id
			) d ON a.id = d.brg_id
			LEFT OUTER JOIN (
				select 
					a.pbd_brg_id brg_id,
					SUM(a.pbd_qty) qty
				from trx_pindah_barang_detail a
				left outer join trx_pindah_barang b ON b.pb_id = a.pbd_pb_id
				LEFT OUTER JOIN mst_alamat e ON b.pb_id_alamat_tujuan = e.alm_id
				WHERE b.pb_id_alamat_tujuan = $alamat_id
				AND b.pb_status = 3
				GROUP BY a.pbd_brg_id
			) e ON a.id = e.brg_id

			LEFT OUTER JOIN (
				select 
					a.pbd_brg_id brg_id,
					SUM(a.pbd_qty) qty
				from trx_pindah_barang_detail a
				left outer join trx_pindah_barang b ON b.pb_id = a.pbd_pb_id
				LEFT OUTER JOIN mst_alamat e ON b.pb_id_alamat_asal = e.alm_id
				WHERE b.pb_id_alamat_asal = $alamat_id
				AND b.pb_status = 3
				GROUP BY a.pbd_brg_id
				
			)f ON a.id = f.brg_id
			LEFT OUTER JOIN(
				select 
					b.sod_brg_id brg_id,	
					SUM(b.sod_qty) qty
				from trx_faktur_sales_order a
				left outer join trx_sales_order_detail b on a.fso_so_id = b.sod_so_id 
				where f_status = 0 and b.sod_alamat_id = $alamat_id
				GROUP BY b.sod_brg_id
			) g ON a.id = g.brg_id
			LEFT OUTER JOIN(
				select 
					b.so_brg_id_trade brg_id,	
					SUM(1) qty
				from trx_faktur_sales_order a
				left outer join trx_sales_order b on a.fso_so_id = b.so_id 
				where f_status = 0 and b.so_alamat_id = $alamat_id
				GROUP BY b.so_brg_id_trade
			) h ON a.id = h.brg_id
			LEFT OUTER JOIN(
				SELECT c.pc_id_barang as brg_id,
					case $alamat_id when 1 THEN SUM(1) else 0 end as qty
				FROM trx_tukar_barang_claim a
				LEFT JOIN trx_approve_permintaan_claim b ON b.app_id = a.tbc_idpermintaan_claim
				LEFT JOIN trx_permintaan_claim c ON c.pc_id = b.app_idpermintaan_claim
				where a.tbc_id is not null
				and a.tbc_status =3
				GROUP BY pc_id_barang
			) i ON a.id = i.brg_id
			
            WHERE ((ifnull(d.qty,0) + ifnull(e.qty,0) + ifnull(h.qty,0)) - (ifnull(f.qty,0) + ifnull(g.qty,0))) > 0 and b.code!='TRD'
        ");

        return $q->result();
    }

    function getBarangBekas()
    {
        $q = $this->db->query("
            SELECT 
                a.id AS id, 
                CONCAT(b.code, a.code, ' ', b.name, ' ', a.name, ' ', c.name) AS name
            FROM mst_barang a
            LEFT JOIN mst_group b ON a.kategori = b.id
            LEFT JOIN mst_merk c ON a.merk = c.id
            LEFT JOIN mst_group d ON a.kategori = d.id
            WHERE d.code = 'TRD'
        ");

        return $q->result();
    }

    function getBarangBekasById($id)
    {
        $q = $this->db->get_where('mst_barang', ['id' => $id]);

        return $q;
    }

    function getCalculateItems($so_id)
    {
        $q = $this->db->query("
            SELECT
              SUM(sod_amount) AS harga,
              SUM(sod_discount) AS diskon,
              SUM(sod_total) AS total
            FROM $this->table_relation
             WHERE sod_so_id = $so_id
        ");

        return $q->row();
    }

    function update($id, $update)
    {
        $this->db->where($this->pk, $id);

        $q = $this->db->update($this->table, $update);

        return $q;
    }

    function updatestoktrade($brg_id_trade)
    {
        $q = $this->db->query("
				update mst_barang a
				LEFT JOIN mst_group b ON a.kategori = b.id
				LEFT JOIN mst_merk c ON a.merk = c.id
				LEFT JOIN mst_group d ON a.kategori = d.id
					set a.stok = a.stok + 1
				WHERE d.code = 'TRD' and a.id='$brg_id_trade';
			
		");

        return $q;
    }

    function findItems($id)
    {
        $q = $this->db->query("
            SELECT 
                a.*, 
				CONCAT(f.code, b.code, ' ',  b.name, ' ', g.name, '-', b.satuan) as barang
				, b.satuan as satuan
            FROM
                $this->table_relation a
            LEFT JOIN mst_barang b ON a.sod_brg_id = b.id
			LEFT JOIN mst_group f ON b.kategori = f.id
            LEFT JOIN mst_merk g ON b.merk = g.id
            WHERE sod_so_id = $id
        ");

        return $q->result();
    }

    function getDetailItems($id)
    {
        $q = $this->db->query("
            SELECT 
                a.*, 
                CONCAT(c.code, b.code, ' ', b.name, ' ', d.name) AS barang
            FROM
                $this->table_relation a
            LEFT JOIN mst_barang b ON a.sod_brg_id = b.id
            LEFT JOIN mst_group c ON b.kategori = c.id
            LEFT JOIN mst_merk d ON b.merk = d.id
            WHERE a.sod_so_id = $id
        ");

        return $q->result();
    }

    function create($insert)
    {
        return $this->db->insert($this->table, $insert);
    }

    function createItem($insert)
    {
        return $this->db->insert($this->table_relation, $insert);
    }

    function updatealamat($so_id, $alamat_id)
    {
        $this->db->where('so_id', $so_id);
        return $this->db->update($this->table, ['so_alamat_id' => $alamat_id]);
    }

    function getexist($idbarang, $idso)
    {
        $query = $this->db->query("SELECT * FROM $this->table_relation WHERE sod_so_id=" . $idso . " AND sod_brg_id =" . $idbarang);
        //where($this->table, array('code' => $code, 'kategori'=>$kat));
        //$query =>$this->db->where_not_in('id', $ids);
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    function deleteItem($id)
    {
        $this->db->where('sod_id', $id);

        $q = $this->db->delete($this->table_relation);

        return $q;
    }

    function delete($id)
    {
        $this->db->where('so_id', $id);

        $q = $this->db->delete($this->table);

        return $q;
    }

    function getBarangById($brg_id)
    {
        $q = $this->db->get_where('mst_barang', ['id' => $brg_id]);

        return $q->row();
    }

    function getCustomerById($cus_id)
    {
        $this->db->select('id, name, jenisusaha');

        $q = $this->db->get_where('mst_customer', ['id' => $cus_id]);

        return $q->row();
    }

    function getCustomerById2($cus_id)
    {
        $this->db->select('id, name, jenisusaha');

        $q = $this->db->get_where('mst_customer', ['id' => $cus_id]);

        return $q->row();
    }

    function getDiskonCustomer($cuid, $brg_id)
    {
        $this->db->select('diskon');

        $q = $this->db->get_where('mst_customer_item', ['id_customer' => $cuid, 'id_barang' => $brg_id]);

        return $q->row();
    }

    function getDiskonPaket($brg_id)
    {
        $this->db->select('*');
        $this->db->from('mst_program_paket');
        $this->db->join('mst_program_paket_item', 'mst_program_paket_item.id = mst_program_paket.id');
        $this->db->where('id_barang', $brg_id);
        $q = $this->db->get();

        return $q->row();
    }

    function getDiskonJenisUsaha($ju, $brg_id)
    {
        $this->db->select('diskon');

        $q = $this->db->get_where('mst_jenis_usaha_item', ['id' => $ju, 'id_barang' => $brg_id]);

        return $q->row();
    }

    function createTempItem($insert)
    {
        return $this->db->insert('temp_sales_order_detail', $insert);
    }

    function getCustomer()
    {
        //$this->db->select("id, name, toko");
        //$q = $this->db->get('mst_customer');
        $q = $this->db->query("
          select 
			a.id,
			a.code,
			concat('[', b.name , '] ', LPAD(a.id, 4, '0'), ' - ', a.name) as name,
			a.toko
			from mst_customer a
			left outer join mst_jenis_usaha b on a.jenisusaha = b.id
			
        ");

        return $q->result();
    }

    function getCustomer2()
    {
        $q = $this->db->query("
           select 
			a.id,
			a.code,
			concat('[', b.name , '] ', LPAD(a.id, 4, '0'), ' - ', a.name) as name,
			a.toko
			from mst_customer a
			left outer join mst_jenis_usaha b on a.jenisusaha = b.id
			left outer JOIN(
                select 
                	b.so_customer_id so_customer_id,
                	sum(CASE WHEN ifnull(ttf_status,0) = 0 AND datediff(now(),ttf.ttf_date)>= c.top THEN 1 ELSE 0 end) inv_status,
                 	SUM(CASE WHEN ifnull(ttf_status,0) = 0 THEN b.so_gtotal ELSE 0 end) so_gtotal
                	from trx_faktur_sales_order a
                left outer join trx_sales_order b on a.fso_so_id = b.so_id
                LEFT OUTER JOIN trx_tanda_terima_faktur ttf ON ttf.ttf_fso_id = a.fso_id
                left outer join mst_customer c ON c.id =b.so_customer_id
                where a.fso_payment=1
				AND a.f_status <> -1
                group by b.so_customer_id
             ) c on a.id = c.so_customer_id
             where (ifnull(c.inv_status,0)=0 OR c.so_gtotal<= a.limit) AND a.status =1
        ");

        return $q->result();

        //return $q->result();
    }

    function getMember()
    {
        $this->db->select("id, name, lpad(id,4,'0') as code");
        $q = $this->db->get('mst_member');

        return $q->result();
    }

    function getSales($id = '')
    {
        if ($id == '' || $id == 0) {
            return $this->db->select('id, CONCAT(code, "-", name) as name')->from('mst_sales')->get();
        } else {
            return $this->db->select('id, CONCAT(code, "-", name) as name')->where('id', $id)->from('mst_sales')->get();
        }
    }

    function getMaxCode($date)
    {
        //$dates = date('Y-m-d', $date);
        $m = (int)substr($date, 5, 2); //$date('m');
        $y = (int)substr($date, 0, 4);

        $q = $this->db->query("
            SELECT MAX(SUBSTRING(so_code,1,3)) as kode
            FROM $this->table
            WHERE /*MONTH(so_date) = $m AND*/ YEAR(so_date) = $y
        ");

        return $q->row();
    }

    function getKopSurat()
    {
        $this->db->select("kop_surat_id, UPPER(cabang) AS cabang, is_default");
        $q = $this->db->get('mst_kop_surat');
        return $q->result();
    }

    function getKopSuratById($kop_surat_id)
    {
        $q = $this->db->get_where('mst_kop_surat', ['kop_surat_id' => $kop_surat_id]);
        return $q->row();
    }

    function getRekening()
    {
        $this->db->select("id, keterangan");
        $q = $this->db->get('mst_rekening');
        return $q->result();
    }

    function getPoAddress()
    {
        $this->db->where(['alm_jenis' => 1]);
        $q = $this->db->get('mst_alamat');

        return $q->result();
    }

    function getSalesOrderListByCustomer($customer_id)
    {
        $this->db->select("*");
        $this->db->from("trx_faktur_sales_order");
        $this->db->join('trx_sales_order', 'trx_faktur_sales_order.fso_so_id = trx_sales_order.so_id');
        $this->db->where("so_member_id = $customer_id OR so_customer_id = $customer_id AND fso_status = 0");
        $q = $this->db->get();

        return $q->result_array();
    }
}
