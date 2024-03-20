<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $dataorg['short_org'].' - '.$title ?></title>

    <link href="<?php echo base_url() ?>asset/admininspina/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>asset/admininspina/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>asset/admininspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>asset/admininspina/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>asset/admininspina/css/style.css" rel="stylesheet">
    <link rel="icon" href="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['favicon_org'] ?>" type="image/x-icon" />
    <!-- Sweet Alert -->
    <link href="<?php echo base_url() ?>asset/admininspina/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <!-- Menu -->
            <?php 
                $akses = $this->session->userdata('id_akses');
                if($akses == 1)
                {
                
            ?>
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="block m-t-xs font-bold"><?=@$_SESSION['nama_user'];?></span>
                                    <span class="text-muted text-xs block"><?=@$_SESSION['nama_akses'];?> <b class="caret"></b></span>
                                </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a class="dropdown-item" href="#"><?=@$_SESSION['nama_div'];?></a></li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url() ?>troubleshoot/logout">Logout</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                B
                            </div>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>ts/home"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                        </li>
                        <li class="active">
                            <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Administrator</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo base_url() ?>ts/user"><i class="fa fa-users"></i> Data Pengguna</a></li>
                                <li><a href="<?php echo base_url() ?>ts/klien"><i class="fa fa-users"></i> Data Klien</a></li>
                                <li><a href="<?php echo base_url() ?>ts/location"><i class="fa fa-building"></i> Data Lokasi</a></li>
                                <li><a href="<?php echo base_url() ?>ts/department"><i class="fa fa-bank"></i> Data Departemen</a></li>
                                <li><a href="<?php echo base_url() ?>ts/divisi"><i class="fa fa-user-md"></i> Data Divisi</a></li>
                                <li><a href="<?php echo base_url() ?>ts/category"><i class="fa fa-sitemap"></i> Data Kategori</a></li>
                                <li><a href="<?php echo base_url() ?>ts/organisasi"><i class="fa fa-institution"></i> Konfig Organisasi</a></li>
                                <li><a href="<?php echo base_url() ?>ts/email"><i class="fa fa-envelope"></i> Konfig Email</a></li>
                                <li><a href="<?php echo base_url() ?>ts/whatsapp"><i class="fa fa-send"></i> Konfig Whatsapp</a></li>
                                <li class="active"><a href="<?php echo base_url() ?>ts/wagroup"><i class="fa fa-whatsapp"></i> Konfig WA Group</a></li>
                                <li><a href="<?php echo base_url() ?>ts/backupdb"><i class="fa fa-download"></i> Backup Database</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Ticket Helpdesk</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="<?php echo base_url() ?>ts/ticket"><i class="fa fa-inbox"></i> Ticket Masuk</a></li>
                                <li><a href="<?php echo base_url() ?>ts/ticket/proses"><i class="fa fa-yelp"></i> Ticket Diproses</a></li>
                                <li><a href="<?php echo base_url() ?>ts/ticket/selesai"><i class="fa fa-check-square"></i> Ticket Selesai</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>ts/report"><i class="fa fa-book"></i> <span class="nav-label">Rekap Ticket</span>  </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>troubleshoot/logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
                        </li>
                    </ul>

                </div>
            </nav>
            <?php 
                }else{
            ?>
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="block m-t-xs font-bold"><?=@$_SESSION['nama_user'];?></span>
                                    <span class="text-muted text-xs block"><?=@$_SESSION['nama_akses'];?> <b class="caret"></b></span>
                                </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a class="dropdown-item" href="#"><?=@$_SESSION['nama_div'];?></a></li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url() ?>troubleshoot/logout">Logout</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                B
                            </div>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>ts/home"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Ticket Helpdesk</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="<?php echo base_url() ?>ts/ticket"><i class="fa fa-inbox"></i> Ticket Masuk</a></li>
                                <li><a href="<?php echo base_url() ?>ts/ticket/proses"><i class="fa fa-yelp"></i> Ticket Diproses</a></li>
                                <li><a href="<?php echo base_url() ?>ts/ticket/selesai"><i class="fa fa-check-square"></i> Ticket Selesai</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>ts/report"><i class="fa fa-book"></i> <span class="nav-label">Rekap Ticket</span>  </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>troubleshoot/logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
                        </li>
                    </ul>

                </div>
            </nav>
            <?php } ?>
        <!-- //Menu -->

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="<?php echo base_url() ?>ts/logout">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Master Data Kategori Masalah</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url() ?>ts/home">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Administrator</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Data Whatsapp Group</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <button class="btn btn-primary dim" type="button" data-toggle="modal" data-target="#addwagroup" ><i class="fa fa-sitemap"></i> Tambah WA Group</button>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-wagroup" id="table-wagroup">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lokasi</th>
                                            <th>Nama Divisi</th>
                                            <th>Nama WA Group</th>
                                            <th>ID WA Group</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        foreach($wagroup as $l){ ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $l->nama_loc ?></td>
                                            <td><?php echo $l->nama_div ?></td>
                                            <td><?php echo $l->nama_wagroup ?></td>
                                            <td><?php echo $l->token_wagroup ?></td>
                                            <td>
                                                <?php if($l->sts_wagroup == 1){
                                                    echo '<button type="button" class="btn btn-primary btn-xs active" data-wagroup-id="'.$l->id_wagroup.'" title="Whatsapp Group Aktif"><i class="fa fa-check"></i> Aktif</button>';
                                                }else{
                                                    echo '<button type="button" class="btn btn-danger btn-xs nonactive" data-wagroup-id="'.$l->id_wagroup.'" title="Whatsapp Group Non-Aktif"><i class="fa fa-exclamation-triangle"></i> Non-Aktif</button>';
                                                }
                                                ?>
                                            </td>
                                            <td><button type="button" class="btn btn-warning btn-xs editwagroup" data-wagroup-id="<?php echo $l->id_wagroup ?>" title="Edit Whatsapp Group"><i class="fa fa-edit"></i></button> | 
                                                <button type="button" class="btn btn-danger btn-xs deletewagroup" data-wagroup-id="<?php echo $l->id_wagroup ?>" title="Hapus Whatsapp Group"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lokasi</th>
                                            <th>Nama Divisi</th>
                                            <th>Nama WA Group</th>
                                            <th>ID WA Group</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="footer">
                <div class="float-right">
                    BluHelpdesk <strong>Version 1.1</strong>
                </div>
                <div>
                    <strong>Copyright</strong> - <?php echo $dataorg['nama_org'] ?> &copy; 2023
                </div>
            </div>

        </div>

        <!-- Modals -->
        <div class="modal inmodal" id="addwagroup" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-whatsapp modal-icon"></i>
                        <h4 class="modal-title">Tambah WA Group Baru</h4>
                        <small>Silakan buat grup whatsapp untuk notifikasi pada setiap divisi</small>
                    </div>
                    <form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/wagroup/add">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <select class="form-control m-b" name="id_loc" required>
                                        <option selected="selected" value="">-- Silakan pilih Lokasi--</option>
                                        <?php 
                                            foreach($dataloc as $row2)
                                            { 
                                                echo '<option value="'.$row2->id_loc.'">'.$row2->nama_loc.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Divisi</label>
                                    <select class="form-control m-b" name="id_div" required>
                                        <option selected="selected" value="">-- Silakan pilih Divisi--</option>
                                        <?php 
                                            foreach($datadiv as $row2)
                                            { 
                                                echo '<option value="'.$row2->id_div.'">'.$row2->nama_div.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama WA Group</label>
                                    <input type="text" class="form-control" name="nama_wagroup" placeholder="Masukkan nama group whatsapp" required />
                                </div>
                                <div class="form-group">
                                    <label>ID WA Group</label>
                                    <input type="text" class="form-control" name="token_wagroup" placeholder="Masukkan ID group whatsapp" required />
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modals Nonactive -->
        <div class="modal inmodal" id="modal-nonactive" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-whatsapp modal-icon"></i>
                        <h4 class="modal-title">Aktivasi Whatsapp Group</h4>
                        <small>Anda akan merubah status Whatsapp Group</small>
                    </div>
                    
                    <div class="modal-body" id="viewnonactive">
                            
                    </div>
                </div>
            </div>
        </div>
        <!-- Modals -->

        <!-- Modals Edit -->
        <div class="modal inmodal" id="modal-edit" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-whatsapp modal-icon"></i>
                        <h4 class="modal-title">Edit Whatsapp Group</h4>
                        <small>Anda akan merubah Whatsapp Group</small>
                    </div>
                    
                    <div class="modal-body" id="viewedit">
                            
                    </div>
                </div>
            </div>
        </div>
        <!-- Modals -->

        <!-- Modals Delete -->
        <div class="modal inmodal" id="modal-delete" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-trash modal-icon"></i>
                        <h4 class="modal-title">Hapus Whatsapp Group</h4>
                        <small>Anda akan menghapus Whatsapp Group</small>
                    </div>
                    
                    <div class="modal-body" id="viewdelete">
                            
                    </div>
                </div>
            </div>
        </div>
        <!-- Modals -->

    </div>

    


    <!-- Mainly scripts -->
    <script src="<?php echo base_url() ?>asset/admininspina/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>asset/admininspina/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>asset/admininspina/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>asset/admininspina/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url() ?>asset/admininspina/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Datatables scripts -->
    <script src="<?php echo base_url() ?>asset/admininspina/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url() ?>asset/admininspina/js/inspinia.js"></script>
    <script src="<?php echo base_url() ?>asset/admininspina/js/plugins/pace/pace.min.js"></script>

    <!-- Jquery Validate -->
    <script src="<?php echo base_url() ?>asset/admininspina/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?php echo base_url() ?>asset/admininspina/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Sweet alert -->
    <script src="<?php echo base_url() ?>asset/admininspina/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
         $(document).ready(function(){

             $("#form").validate({
                 rules: {
                     nama_cat: {
                         required: true,
                         minlength: 3
                     }
                 }
             });
        });
    </script>

    <!-- Page-Level Scripts -->
    <script>

        // Upgrade button class name
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        $(document).ready(function(){
            $('.dataTables-wagroup').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

    </script>

    <!-- Notifikasi -->
    <script>
        $(document).ready(function() {
            var message = '<?php echo $this->session->flashdata('message'); ?>';
            var type = '<?php echo $this->session->flashdata('type'); ?>';
            
            if (message) {
                switch (type) {
                    case 'success':
                        swal("Success", message, "success");
                        break;
                    case 'error':
                        swal("Error", message, "error");
                        break;
                    case 'warning':
                        swal("Warning", message, "warning");
                        break;
                    case 'info':
                        swal("Info", message, "info");
                        break;
                }
            }
        });
    </script>

    <script>
			$("#table-wagroup").on('click', '.active', function(e) {
                e.preventDefault();
                var wagroup_id = $(e.currentTarget).attr('data-wagroup-id');
                if (wagroup_id === '') return;
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('ts/wagroup/ajax?type=nonactive'); ?>',
                    data: {
                        wagroup_id: wagroup_id
                    },
                    beforeSend: function() {
                        swal({
                            title: "Mempersiapkan Data",
                            text: "Please wait",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: function(data) {
                        swal({
                            title: "Mempersiapkan Data",
                            text: "Please wait",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 200, // Waktu dalam milidetik (dalam contoh ini, 0.8 detik)
                        });
                        $('#modal-nonactive').modal('show');
                        $('#viewnonactive').html(data);

                    },
                    error: function() {
                        swal("Ambil Data Gagal", "Ada Kesalahan Saat menampilkan data!", "error");
                    }
                });
            });

            $("#table-wagroup").on('click', '.nonactive', function(e) {
                e.preventDefault();
                var wagroup_id = $(e.currentTarget).attr('data-wagroup-id');
                if (wagroup_id === '') return;
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('ts/wagroup/ajax?type=nonactive'); ?>',
                    data: {
                        wagroup_id: wagroup_id
                    },
                    beforeSend: function() {
                        swal({
                            title: "Mempersiapkan Data",
                            text: "Please wait",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: function(data) {
                        swal({
                            title: "Mempersiapkan Data",
                            text: "Please wait",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 200, // Waktu dalam milidetik (dalam contoh ini, 0.8 detik)
                        });
                        $('#modal-nonactive').modal('show');
                        $('#viewnonactive').html(data);

                    },
                    error: function() {
                        swal("Ambil Data Gagal", "Ada Kesalahan Saat menampilkan data!", "error");
                    }
                });
            });

            $("#table-wagroup").on('click', '.editwagroup', function(e) {
                e.preventDefault();
                var wagroup_id = $(e.currentTarget).attr('data-wagroup-id');
                if (wagroup_id === '') return;
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('ts/wagroup/ajax?type=editwagroup'); ?>',
                    data: {
                        wagroup_id: wagroup_id
                    },
                    beforeSend: function() {
                        swal({
                            title: "Mempersiapkan Data",
                            text: "Please wait",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: function(data) {
                        swal({
                            title: "Mempersiapkan Data",
                            text: "Please wait",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 200, // Waktu dalam milidetik (dalam contoh ini, 0.8 detik)
                        });
                        $('#modal-edit').modal('show');
                        $('#viewedit').html(data);

                    },
                    error: function() {
                        swal("Ambil Data Gagal", "Ada Kesalahan Saat menampilkan data!", "error");
                    }
                });
            });

            $("#table-wagroup").on('click', '.deletewagroup', function(e) {
                e.preventDefault();
                var wagroup_id = $(e.currentTarget).attr('data-wagroup-id');
                if (wagroup_id === '') return;
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('ts/wagroup/ajax?type=deletewagroup'); ?>',
                    data: {
                        wagroup_id: wagroup_id
                    },
                    beforeSend: function() {
                        swal({
                            title: "Mempersiapkan Data",
                            text: "Please wait",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    },
                    success: function(data) {
                        swal({
                            title: "Mempersiapkan Data",
                            text: "Please wait",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 200, // Waktu dalam milidetik (dalam contoh ini, 0.8 detik)
                        });
                        $('#modal-delete').modal('show');
                        $('#viewdelete').html(data);

                    },
                    error: function() {
                        swal("Ambil Data Gagal", "Ada Kesalahan Saat menampilkan data!", "error");
                    }
                });
            });
    </script>

</body>

</html>
