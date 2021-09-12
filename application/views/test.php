<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Sales Order
 *
 * @author White Code
 */
class Sales_order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->model('penjualan/m_sales_order', 'the_m');
        $this->load->helper('geturl');
    }

    public function index()
    {
        $this->otoritas->rule('R');

        $data["title_panel"] = "Sales Order";
        $data["sub_title_panel"] = "";

        $this->breadcrumbs->clear();
        $this->breadcrumbs->add_crumb('Dashboard', site_url('dashboard'));
        $this->breadcrumbs->add_crumb('Sales Order');

        $data["message"] = $this->_show_message();

        $data['link_tambah'] = site_url('penjualan/sales_order/create');

        $this->layout->render('default', 'penjualan/sales_order/index', $data);
    }

    public function datatables()
    {
        $sales_order = $this->the_m->getAll();

        $data = [];

        $no = 1;
        foreach ($sales_order as $value) {
            $field = [];

            $field['no'] = $no;
            $field['id'] = $value->so_id;
            $field['tanggal'] = tanggal_indonesia($value->so_date);
            $field['code'] = $value->so_code;

            if ($value->so_type == 1) {
                $field['pelanggan'] = '[CUSTOMER] ' . str_pad($value->cuid, 4, '0', STR_PAD_LEFT) . ' - ' . $value->customer;
            } else if ($value->so_type == 2) {
                $field['pelanggan'] = '[MEMBER] ' . str_pad($value->meid, 4, '0', STR_PAD_LEFT) . ' - ' . $value->member;
            } else {
                $field['pelanggan'] = '';
            }

            $field['total'] = format_rupiah($value->so_total);

            $display_edit = '';
            $display_delete = '';

            if ($value->f_status == "-1") {
                $status = '<label class="label label-danger">Batal</label>';
                $display_edit = 'style="display:none"';
                $display_delete = 'style="display:none"';
            } else {
                if ($value->so_status == 0) {
                    $status = '<label class="label label-default">Pengajuan</label>';
                    $display_edit = 'style=""';
                    $display_delete = 'style=""';
                } else if ($value->so_status == 1) {
                    $status = '<label class="label label-warning">Menyetujui/Dalam Proses</label>';
                    $display_edit = 'style="display:none"';
                    $display_delete = 'style="display:none"';
                } else if ($value->so_status == 2) {
                    $status = '<label class="label label-success">Selesai</label>';
                    $display_edit = 'style="display:none"';
                    $display_delete = 'style="display:none"';
                } else if ($value->so_status == 3) {
                    $status = '<label class="label label-info">Mengetahui</label>';
                    $display_edit = 'style="display:none"';
                    $display_delete = 'style="display:none"';
                }
            }

            $field['status'] = $status;

            if ($value->so_types == 1) {
                $field['tipe_so'] = '<label class="label label-success">Penjualan</label>';
                $edit = "<a title='Ubah' href='" . site_url("penjualan/sales_order/edit/" . $value->so_id) . "' class='btn btn-sm btn-success' $display_edit><i class='fa fa-edit'></i></a>";
            } else if ($value->so_types == 2) {
                $field['tipe_so'] = '<label class="label label-warning">Klaim</label>';
                $edit = "<a title='Ubah' href='" . site_url("penjualan/sales_order/editClaim/" . $value->so_id) . "' class='btn btn-sm btn-success' $display_edit><i class='fa fa-edit'></i></a>";
            } else {
                $field['tipe_so'] = '';
                $edit = "";
            }

            if ($value->so_status != 0) {
                if ($value->so_type == 1) {
                    if ($value->so_sj == '' || $value->so_sj == null) {
                        $field['sj'] = "
                            <a title='Buat Surat Jalan' href='#' ref='" . site_url("penjualan/sales_order/dataSj/" . $value->so_id) . "' data-toggle='modal' data-target='#confirm-sj' class='btn btn-xs btn-success buat-sj'>Buat SJ</a>
                        ";
                    } else {
                        $field['sj'] = "
                            <a title='Cetak Surat Jalan' href='#' ref='" . site_url("penjualan/sales_order/cetakSj/" . $value->so_id) . "' class='btn btn-xs bg-purple cetak-sj' target='_blank' data-toggle='modal' data-target='#cetak-sj'>Cetak SJ</a>
                        ";
                    }
                } else {
                    $field['sj'] = '';
                }
            } else {
                $field['sj'] = '';
            }

            $field['action'] = "
                $edit
                <a title='Detail/Approval' href='" . site_url("penjualan/sales_order/detail/" . $value->so_id) . "' class='btn btn-sm btn-default' data-toggle='tooltip'><i class='fa fa-search'></i></a>
                <a title='Hapus' href='#' data-toggle='modal' data-target='#confirm-delete' data-href='" . site_url("penjualan/sales_order/delete/" . $value->so_id) . "' class='btn btn-sm btn-danger' $display_delete><i class='fa fa-trash'></i></a>
            ";

            $data[] = $field;

            $no = $no + 1;
        }

        echo json_encode(['data' => $data], true);
    }

    public function tes()
    {
        print_r($this->session->userdata());
    }

    public function create()
    {
        $this->otoritas->rule('C');

        $this->load->library('form_validation');

        $data["title_panel"] = "Sales Order";
        $data["sub_title_panel"] = "Tambah Data";
        $data["title_box"] = "Tambah";

        $this->breadcrumbs->clear();
        $this->breadcrumbs->add_crumb('Dashboard', site_url('dashboard'));
        $this->breadcrumbs->add_crumb('Sales Order', site_url('penjualan/sales_order'));
        $this->breadcrumbs->add_crumb('Tambah Data');

        if ($this->session->userdata('group') == 'direktur' or $this->ion_auth->is_admin()) {
            $data['customer'] = $this->the_m->getCustomer();
        } else {
            $data['customer'] = $this->the_m->getCustomer2();
        }
        $data['member'] = $this->the_m->getMember();

        //if($this->ion_auth->is_admin()) {
        $sales = $this->the_m->getSales()->result();
        //} else {
        //    $sales = $this->the_m->getSales($this->session->userdata('sales_id'))->result();
        //}

        $data['sales'] = $sales;

        $this->form_validation->set_rules('so_date', 'Tanggal', 'required');
        $this->form_validation->set_rules('so_sales_id', 'Sales', 'required');

        if ($this->form_validation->run() == TRUE) {
            $type = $this->input->post('so_type');
            $date = $this->input->post('so_date');
            $max_code = $this->the_m->getMaxCode($date);
            $kode = sprintf('%03s', intval($max_code->kode) + 1);
            $nomor = $kode . '/' . getRomawi((int)substr($date, 5, 2)) . '/' . substr($date, 0, 4);

            if ($type == 1) {
                $customer_id = $this->input->post('so_customer_id');
                $member_id = 0;
            } else if ($type ==  2) {
                $customer_id = 0;
                $member_id = $this->input->post('so_member_id');
            }

            $insert = [
                'so_types' => $this->input->post('so_types'),
                'so_code' => $nomor,
                'so_date' => $date,
                'so_sales_id' => $this->input->post('so_sales_id'),
                'so_desc' => $this->input->post('so_desc'),
                'so_type' => $this->input->post('so_type'),
                'so_customer_id' => $customer_id,
                'so_member_id' => $member_id,
                'so_created_by' => $this->session->name,
                'so_created_at' => date('Y-m-d H:i:s'),
                'so_updated_at' => date('Y-m-d H:i:s')
            ];

            $create = $this->the_m->create($insert);

            $insert_id = $this->db->insert_id();

            $type_so = $this->input->post('so_types');

            if ($create) {
                //if($this->session->userdata('group') == 'direktur' OR $this->ion_auth->is_admin()) 
                //	redirect('penjualan/sales_order', 'refresh');
                //else
                return redirect('penjualan/sales_order/item/' . $insert_id);
                //if($type_so == 1) {
                //	return redirect('penjualan/sales_order/item/'.$insert_id);
                //} else if($type_so == 2) {
                //    return redirect('penjualan/sales_order/claim/'.$insert_id);
                //}
            }
        } else {
            $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->layout->render('default', 'penjualan/sales_order/create', $data);
        }
    }

    // Updated by Delian H (25/03/2021)
    public function findCustomerStatus()
    {
        $id = $this->input->post('id');
        $customer = $this->the_m->getCustomerStatusById($id);

        if ($customer->status == 2) {
            $data["block_reason"] = $this->blockedReason($id);
        }

        $data["customer"] = $customer;

        echo json_encode($data);
    }

    function blockedReason($customer_id)
    {
        $block_reason = "";
        $sales_list = $this->the_m->getSalesOrderListByCustomer($customer_id);
        $top_exceeded = false;
        $current_date = date("Y-m-d");
        $top_date_cust = $this->the_m->getCustomerTopById($customer_id);
        $current_limit = $this->the_m->getCustomerLimitById($customer_id)->limit * 1000000;


        $total = 0;
        foreach ($sales_list as $sales_order) {
            $total = $total + $sales_order["so_subtotal"];
            $so_date_str =  $sales_order["so_date"];

            $diff = date_diff(date_create($so_date_str), date_create($current_date));
            if ($diff->days > $top_date_cust->top && !$top_exceeded) {
                $top_exceeded = true;
            }
        }

        if ($total > $current_limit) {
            $block_reason .= "<br />Hutang melebihi limit yang ditentukan";
        }
        if ($top_exceeded) {
            $block_reason .= "<br />Terdapat top yang melebihi batas";
        }

        return $block_reason;
    }

    public function findMemberStatus()
    {
        $id = $this->input->post('id');

        $member = $this->the_m->getMemberStatusById($id);

        echo json_encode($member);
    }
    // End of Update

    public function item($id)
    {
        $this->otoritas->rule('U');

        $this->load->library('form_validation');

        $cek = $this->the_m->find($id);
        $kopSurat = $this->the_m->getKopSurat();
        $rekening = $this->the_m->getRekening();
        $alamat = $this->the_m->getPoAddress();

        if (!$cek) {
            return redirect('penjualan/sales_order');
        }

        $data["title_panel"] = "Sales Order";
        $data["sub_title_panel"] = "Tambah Item Sales Order";
        $data["title_box"] = "Tambah Item";

        $this->breadcrumbs->clear();
        $this->breadcrumbs->add_crumb('Dashboard', site_url('dashboard'));
        $this->breadcrumbs->add_crumb('Sales Order', site_url('penjualan/sales_order'));
        $this->breadcrumbs->add_crumb('Tambah Data');

        $this->form_validation->set_rules('so_date', 'Tanggal', 'required');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() == TRUE) {

                $update = [
                    'so_kop_surat_id' => $this->input->post('so_kop_surat_id'),
                    'so_rekening_id' => $this->input->post('so_rekening_id'),
                    'so_amount' => $this->input->post('so_amount'),
                    'so_subtotal' => $this->input->post('so_subtotal'),
                    'so_tax' => $this->input->post('so_tax'),
                    'so_tax_amount' => $this->input->post('so_tax_amount'),
                    'so_total' => $this->input->post('so_total'),
                    'so_brg_id_trade' => $this->input->post('so_brg_id_trade'),
                    'so_tradein' => $this->input->post('so_tradein'),
                    'so_discount' => $this->input->post('discount'),
                    'so_gtotal' => $this->input->post('so_total'),
                    'so_updated_at' => date('Y-m-d H:i:s')
                ];

                $brg_id_trade = $this->input->post('so_brg_id_trade');

                $this->the_m->update($id, $update);

                $this->the_m->updatestoktrade($brg_id_trade);

                $this->session->set_flashdata('success', 'Data Berhasil Ditambahkan');

                redirect('penjualan/sales_order', 'refresh');
            }
        }

        $data['barang'] = $this->the_m->getBarang();
        $data['barang_bekas'] = $this->the_m->getBarangBekas();
        $data['so'] = $cek;
        $data['total'] = $this->the_m->getCalculateItems($id);
        $data['kop_surat'] = $kopSurat;
        $data['rekening'] = $rekening;
        $data['alamat'] = $alamat;

        $this->layout->render('default', 'penjualan/sales_order/create_item', $data);
    }

    public function getBarangFromAlamat($alamat_id)
    {
        if (!$alamat_id || empty($alamat_id)) {
            return;
        }

        if ($this->session->userdata('group') == 'direktur') {
            $barangs = $this->the_m->getBarangByAlamatId($alamat_id);
        } else {
            $barangs = $this->the_m->getBarangByAlamatIdanduser($alamat_id);
        }

        echo json_encode($barangs);
    }

    public function claim($id)
    {
        $this->otoritas->rule('U');

        $this->load->library('form_validation');

        $cek = $this->the_m->find($id);

        if (!$cek) {
            return redirect('penjualan/sales_order');
        }

        $data["title_panel"] = "Sales Order";
        $data["sub_title_panel"] = "Tambah Item Claim Sales Order";
        $data["title_box"] = "Tambah Item Claim";

        $this->breadcrumbs->clear();
        $this->breadcrumbs->add_crumb('Dashboard', site_url('dashboard'));
        $this->breadcrumbs->add_crumb('Sales Order', site_url('penjualan/sales_order'));
        $this->breadcrumbs->add_crumb('Tambah Data Klaim');

        $this->form_validation->set_rules('so_date', 'Tanggal', 'required');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() == TRUE) {
                $update = [
                    'so_amount' => 0,
                    'so_subtotal' => 0,
                    'so_tax' => 0,
                    'so_tax_amount' => 0,
                    'so_total' => 0,
                    'so_tradein' => 0,
                    'so_updated_at' => date('Y-m-d H:i:s')
                ];

                $this->the_m->update($id, $update);

                $this->session->set_flashdata('success', 'Data Berhasil Ditambahkan');

                redirect('penjualan/sales_order', 'refresh');
            }
        }

        $data['barang'] = $this->the_m->getBarang();
        $data['barang_bekas'] = $this->the_m->getBarangBekas();
        $data['so'] = $cek;
        $data['total'] = $this->the_m->getCalculateItems($id);

        $this->layout->render('default', 'penjualan/sales_order/create_klaim', $data);
    }

    public function editClaim($id)
    {
        $this->otoritas->rule('U');

        $this->load->library('form_validation');

        $cek = $this->the_m->find($id);

        if (!$cek) {
            return redirect('penjualan/sales_order');
        }

        $data["title_panel"] = "Sales Order";
        $data["sub_title_panel"] = "Edit Item Klaim Sales Order";
        $data["title_box"] = "Edit Item Klaim";

        $this->breadcrumbs->clear();
        $this->breadcrumbs->add_crumb('Dashboard', site_url('dashboard'));
        $this->breadcrumbs->add_crumb('Sales Order', site_url('penjualan/sales_order'));
        $this->breadcrumbs->add_crumb('Edit Data Klaim');

        $this->form_validation->set_rules('so_date', 'Tanggal', 'required');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() == TRUE) {
                $update = [
                    'so_amount' => 0,
                    'so_subtotal' => 0,
                    'so_tax' => 0,
                    'so_tax_amount' => 0,
                    'so_total' => 0,
                    'so_tradein' => 0,
                    'so_updated_at' => date('Y-m-d H:i:s')
                ];

                $this->the_m->update($id, $update);

                $this->session->set_flashdata('success', 'Data Berhasil Ditambahkan');

                redirect('penjualan/sales_order', 'refresh');
            }
        }

        $data['barang'] = $this->the_m->getBarang();
        $data['barang_bekas'] = $this->the_m->getBarangBekas();
        $data['so'] = $cek;
        $data['total'] = $this->the_m->getCalculateItems($id);

        $this->layout->render('default', 'penjualan/sales_order/edit_klaim', $data);
    }

    public function listItem($id)
    {
        $list = $this->the_m->findItems($id);

        $data = [];

        foreach ($list as $value) {
            $field = [];

            if ($value->sod_type == 1) {
                $field['type'] = $value->sod_discount_percent;
            } else {
                $field['type'] = 'Trade in';
            }

            $field['barang'] = $value->barang;
            $field['jumlah'] = $value->sod_qty;
            $field['harga'] = format_rupiah($value->sod_amount);
            $field['diskon'] = format_rupiah($value->sod_discount);
            $field['total'] = format_rupiah($value->sod_total);

            $field['action'] = "
                <a onclick=\"deleteItem(" . $value->sod_id . ");\" class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></a>
            ";

            $data[] = $field;
        }

        echo json_encode(['data' => $data], true);
    }

    public function saveItem()
    {
        $this->otoritas->rule('C');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('item_barang', 'Barang', 'required');
        $this->form_validation->set_rules('item_qty', 'Jumlah', 'required');
        $this->form_validation->set_rules('item_amount', 'Harga', 'required');
        //$this->form_validation->set_rules('item_diskon', 'Diskon', 'required');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();

            echo json_encode(['error' => $errors], true);
        } else {
            $so_id = $this->input->post('so_id');

            $brg_id = $this->input->post('item_barang');

            $alamat_id = $this->input->post('item_alamat');

            $qty = $this->input->post('item_qty');

            $amount = $this->input->post('item_amount');

            $percent = $this->input->post('item_diskon_percent');

            $is_trade = $this->input->post('item_type');

            $discount = $this->input->post('item_diskon');

            $subtotal = $this->input->post('item_price');

            $barang = $this->the_m->getBarangByIds($brg_id, $alamat_id);

            if ($barang->stoktoko >= $qty) {

                if ($this->the_m->getexist(
                    $brg_id,
                    $so_id
                )) {
                    $insert = [
                        'sod_type' => $is_trade,
                        'sod_so_id' => $so_id,
                        'sod_brg_id' => $brg_id,
                        'sod_qty' => $qty,
                        'sod_amount' => $amount,
                        'sod_discount_percent' => $percent,
                        'sod_discount' => $discount,
                        'sod_total' => $subtotal,
                        'sod_alamat_id' => $alamat_id,
                    ];

                    $this->the_m->createItem($insert);

                    $this->the_m->updatealamat($so_id, $alamat_id);

                    echo json_encode(['success' => 'success'], true);
                } else {
                    $errors = "Item Sudah ada";

                    echo json_encode(['error' => $errors], true);
                }
            } else {
                $errors = "Stock TIdak Cukup";

                echo json_encode(['error' => $errors], true);
            }
        }
    }

    public function calcItem()
    {
        $brg_id = $this->input->post('item_barang');

        $type = $this->input->post('so_type');

        if ($type == "") {
            $error = 'Harap pilih tipe customer atau member terlebih dahulu';

            echo json_encode(['error' => $error], true);
        } else {
            if ($type == 1) {
                $cus_id = $this->input->post('so_customer_id');

                $customer = $this->the_m->getCustomerById($cus_id);

                if (!$customer) {
                    $error = 'Data customer tidak ditemukan';

                    echo json_encode(['error' => $error], true);
                } else {
                    $diskonJU = $this->the_m->getDiskonJenisUsaha($customer->jenisusaha, $brg_id);
                    $diskonCU = $this->the_m->getDiskonCustomer($cus_id, $brg_id);
                    $diskon_paket = $this->the_m->getDiskonPaket($brg_id);

                    if ($diskonCU) {
                        $data['diskon'] = $diskonCU->diskon;
                        $data['deskripsi_diskon'] = "Diskon Customer";
                    } else if ($diskonJU) {
                        $data['diskon'] = $diskonJU->diskon;
                        $data['deskripsi_diskon'] = "Diskon Jenis Usaha";
                    } else if ($diskon_paket) {
                        $data['diskon'] = $diskon_paket->diskon;
                        $data['deskripsi_diskon'] = "Diskon Paket";
                    } else {
                        $data['diskon'] = 0;
                    }
                }
            } else {
                $data['diskon'] = 0;
            }

            $barang = $this->the_m->getBarangById($brg_id);

            if (!$barang) {
                $error = 'Barang tidak ditemukan';

                echo json_encode(['error' => $error], true);
            } else {
                $harga_jual = $barang->harga_jual;

                $harga = $harga_jual * 1;

                $harga_diskon = ($data['diskon'] / 100) * $harga_jual;

                $total = $harga - $harga_diskon;
            }

            $data['jumlah'] = 1;
            $data['harga_jual'] = round($harga_jual, 2);
            $data['harga_diskon'] = round($harga_diskon, 2);
            $data['total'] = round($total);

            echo json_encode($data, true);
        }
    }

    public function calcBarangBekas($id)
    {
        $barang = $this->the_m->getBarangBekasById($id)->row();

        $data['id'] = $barang->id;
        $data['harga_tradein'] = $barang->harga_tradein;

        echo json_encode($data, true);
    }

    public function detail($id)
    {
        $this->otoritas->rule('R');

        if (!$id || empty($id)) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect("penjualan/sales_order", 'refresh');
        }

        $data['title_panel'] = "Sales Order";
        $data['sub_title_panel'] = "Detail Data";
        $data['title_box'] = "Detail";

        $this->breadcrumbs->clear();
        $this->breadcrumbs->add_crumb('Dashboard', site_url('dashboard'));
        $this->breadcrumbs->add_crumb('Sales Order', site_url('penjualan/sales_order'));
        $this->breadcrumbs->add_crumb('Detail Data');

        $so = $this->the_m->find($id);

        if ($so->so_type == 1) {
            $data['pelanggan'] = '[CUSTOMER] ' . $so->ccode . ' - ' . strtoupper($so->customer) . '-' . $so->jname;
        } else if ($so->so_type == 2) {
            $data['pelanggan'] = '[MEMBER] - ' . strtoupper($so->member);
        } else {
            $data['pelanggan'] = '';
        }

        $data['so'] = $so;

        $data['items'] = $this->the_m->getDetailItems($id);

        $this->layout->render('default', 'penjualan/sales_order/detail', $data);
    }

    public function change_status($id)
    {
        $update = $this->the_m->update($id, ['so_status' => $this->input->post('status_id')]);

        echo json_encode($update);
    }

    public function edit($id)
    {
        $this->otoritas->rule('U');

        $this->load->library('form_validation');

        $cek = $this->the_m->find($id);
        $kopSurat = $this->the_m->getKopSurat();
        $rekening = $this->the_m->getRekening();
        $alamat = $this->the_m->getPoAddress();

        if (!$cek) {
            return redirect('penjualan/sales_order');
        }

        $data["title_panel"] = "Sales Order";
        $data["sub_title_panel"] = "Tambah Item Sales Order";
        $data["title_box"] = "Tambah Item";

        $this->breadcrumbs->clear();
        $this->breadcrumbs->add_crumb('Dashboard', site_url('dashboard'));
        $this->breadcrumbs->add_crumb('Sales Order', site_url('penjualan/sales_order'));
        $this->breadcrumbs->add_crumb('Tambah Data');

        $this->form_validation->set_rules('so_date', 'Tanggal', 'required');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() == TRUE) {
                $update = [
                    'so_kop_surat_id' => $this->input->post('so_kop_surat_id'),
                    'so_rekening_id' => $this->input->post('so_rekening_id'),
                    'so_amount' => $this->input->post('so_amount'),
                    'so_subtotal' => $this->input->post('so_subtotal'),
                    'so_tax' => $this->input->post('so_tax'),
                    'so_tax_amount' => $this->input->post('so_tax_amount'),
                    'so_total' => $this->input->post('so_total'),
                    'so_brg_id_trade' => $this->input->post('so_brg_id_trade'),
                    'so_tradein' => $this->input->post('so_tradein'),
                    'so_updated_at' => date('Y-m-d H:i:s'),
                    'so_discount'   => $this->input->post('discount'),
                ];

                $this->the_m->update($id, $update);

                $this->session->set_flashdata('success', 'Data Berhasil Ditambahkan');

                redirect('penjualan/sales_order', 'refresh');
            }
        }

        $data['barang'] = $this->the_m->getBarang();
        $data['barang_bekas'] = $this->the_m->getBarangBekas();
        $data['so'] = $cek;
        $data['total'] = $this->the_m->getCalculateItems($id);
        $data['kop_surat'] = $kopSurat;
        $data['rekening'] = $rekening;
        $data['alamat'] = $alamat;

        $this->layout->render('default', 'penjualan/sales_order/edit_item', $data);
    }

    public function delete($id)
    {

        $delete = $this->the_m->delete($id);

        redirect('penjualan/sales_order', 'refresh');
    }

    public function deleteItem()
    {
        $id = $this->input->get('id');

        $delete = $this->the_m->deleteItem($id);

        echo json_encode(['success' => $delete], true);
    }

    public function dataSj($id)
    {
        $get = $this->the_m->find($id);

        $data['id'] = $get->so_id;
        $data['sj'] = 'SJ-SO/' . $get->so_code;

        echo json_encode($data, true);
    }

    public function sj()
    {
        $update = [
            'so_sj' => $this->input->post('sj'),
            'so_sj_date' => date('Y-m-d'),
            'so_updated_at' => date('Y-m-d'),
        ];

        $q = $this->the_m->update($this->input->post('id'), $update);

        if ($q) {
            $this->session->set_flashdata('success', 'Surat jalan berhasil dibuat');
        } else {
            $this->session->set_flashdata('error', 'Surat jalan gagal dibuat');
        }

        redirect('penjualan/sales_order', 'refresh');
    }

    public function cetakSj($id)
    {
        $so = $this->the_m->find($id);
        $data['id'] = $id;
        $data['code'] = $so->so_code;

        echo json_encode($data);
    }

    public function printout()
    {
        $id = $this->input->post('id');
        $isTampil = $this->input->post('is_tampil');

        $so = $this->the_m->find($id);

        $items = $this->the_m->findItems($id);
        $data['cuname'] = $isTampil == 1 ? ('[' . $so->customer . '] ' . $so->toko) : ('[' . $so->customer . ']');

        $data['so'] = $so;
        $data['kop_surat'] = $this->the_m->getKopSuratById($so->so_kop_surat_id);
        $data['items'] = $items;

        $this->load->view('print/surat_jalan', $data);
    }

    public function approve()
    {
        $id = $this->input->post('ro');
        $status = $this->input->post('status');
        // echo "<pre>";print_r($status);die;

        if ($status == 1) {
            $cek = $this->the_m->find($id)->so_approve_by;

            if ($cek == '') {
                $nama = $this->session->name;
            } else {
                $nama = $cek;
            }

            $status_ro = 3;
        } else if ($status == 0) {
            $nama = '';
            $status_ro = 0;
        }

        $this->the_m->update($id, ['so_status' => $status_ro, 'so_approve' => $status, 'so_approve_by' => $nama]);

        echo json_encode(['success' => 'success'], true);
    }

    public function approveName($id)
    {
        $this->the_m->update($id, ['so_approve_by' => $this->input->post('so_approve_by')]);

        return redirect('penjualan/sales_order/detail/' . $id);
    }

    public function agree()
    {
        $id = $this->input->post('ro');
        $status = $this->input->post('status');

        if ($status == 1) {
            $cek = $this->the_m->find($id)->so_agree_by;

            if ($cek == '') {
                $nama = $this->session->name;
            } else {
                $nama = $cek;
            }

            $status_ro = 1;
        } else if ($status == 0) {
            $nama = '';
            $status_ro = 3;
        }

        $this->the_m->update($id, ['so_status' => $status_ro, 'so_agree' => $status, 'so_agree_by' => $nama]);

        echo json_encode(['success' => 'success'], true);
    }

    public function agreeName($id)
    {
        $this->the_m->update($id, ['so_agree_by' => $this->input->post('so_agree_by')]);

        return redirect('penjualan/sales_order/detail/' . $id);
    }

    function _show_message()
    {
        $notifForm = "";
        if ($this->session->flashdata('error') != "") {
            $notifForm .= '<div class="alert alert-danger alert-dismissable">';
            $notifForm .= '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
            $notifForm .= $this->session->flashdata('error');
            $notifForm .= '</div>';
        } else if ($this->session->flashdata('success') != "") {
            $notifForm .= '<div class="alert alert-success alert-dismissable">';
            $notifForm .= '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
            $notifForm .= $this->session->flashdata('success');
            $notifForm .= '</div>';
        }
        return $notifForm;
    }
}
