@extends('back.layout.app')

@section('content')
<div class="card card-flush shadow-sm">
    <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
        {{-- <h3 class="card-title">Title</h3> --}}
        <div class="ribbon-label bg-primary" style="font-size: large;">Master Data Role Aplikasi</div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                <i class="fa fa-plus"></i> Role
            </button>
        </div>
    </div>
    <div class="card-body py-5 table-responsive">
        <table id="table" class="table table-striped gy-5 gs-7 border rounded">
            <thead>
                <tr role="row">
                    <th width="2%"><center>NO</center></th>
                    <th><center>Nama Role</center></th>
                    <th><center>Keterangan</center></th>
                    <th><center>Status Aktif</center></th>
                    <th width="15%"><center>Detail</center></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Data --}}
<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Role Aplikasi</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="form">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Role :</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="nama_role" placeholder="Nama Role">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Keterangan :</label>
                        <div class="col-lg-8 col-xl-8">
                            <textarea class="form-control" name="keterangan"></textarea>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Status Role :</label>
                        <div class="col-lg-4 col-xl-2">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <span class="form-check-label fw-bold text-muted">Non Aktif</span>&nbsp;&nbsp;
                                <input class="form-check-input" name="aktif_menu" type="checkbox" value="1" checked="checked" />
                                <span class="form-check-label fw-bold text-muted">Aktif</span>
                            </label>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Modal Edit Data --}}
<div class="modal fade" tabindex="-1" id="edit">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role Aplikasi</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formedit">
                    <input type="hidden" class="form-control" id="id_role" name="id_role">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Role :</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="nama_role" id="edit_role" placeholder="Nama Role">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Keterangan :</label>
                        <div class="col-lg-8 col-xl-8">
                            <textarea class="form-control" name="keterangan" id="edit_keterangan"></textarea>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Status Role :</label>
                        <div class="col-lg-4 col-xl-2">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <span class="form-check-label fw-bold text-muted">Non Aktif</span>&nbsp;&nbsp;
                                <input class="form-check-input" name="aktif_menu" type="checkbox" value="1" checked="checked" />
                                <span class="form-check-label fw-bold text-muted">Aktif</span>
                            </label>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
    var tabelData;

    $(function () {
        tabelData = $('#table').DataTable({
            language: {
                lengthMenu: "Show _MENU_",
            },
            dom:
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">",
            ajax: {
                url : "{{ url('master/hak-akses/role-user/datatable') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: function(data){
                }
            },
            columnDefs: [{
                targets: [2, 3, 4],
                className: ''
            }]
        });
    })

    $(function () {
        $("#form").submit(function(e) {
            e.preventDefault();

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambah Data Menu Baru",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Tambah!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('master/hak-akses/role-user/simpan') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        data: $('#form').serialize()
                    })
                    .done(function(hasil) {
                        var tittle = "";
                        var icon = "";

                        if (hasil.status == true) {
                            title = "Berhasil!";
                            icon = "success";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            }).then(function() {
                                $('#kt_modal_1').modal('hide');
                                load_data_table();
                            });
                        } else {
                            title = "Gagal!";
                            icon = "error";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            })
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        errorNotification();
                    });
                }
            });
        });
    })

    $(function () {
        $("#formedit").submit(function(e) {
            e.preventDefault();

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Mengedit data menu tersebut",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Yakin!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('master/hak-akses/role-user/ubah') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        data: $('#formedit').serialize()
                    })
                    .done(function(hasil) {
                        var tittle = "";
                        var icon = "";

                        if (hasil.status == true) {
                            title = "Berhasil!";
                            icon = "success";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            }).then(function() {
                                $('#edit').modal('hide');
                                load_data_table();
                            });
                        } else {
                            title = "Gagal!";
                            icon = "error";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            })
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        errorNotification();
                    });
                }
            });
        });
    })

    function hapus(id_data) {
            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menghapus Data Menu",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('master/hak-akses/role-user/destroy') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        data: {
                            id : id_data
                        }
                    })
                    .done(function(hasil) {
                        var tittle = "";
                        var icon = "";

                        if (hasil.status == true) {
                            title = "Berhasil!";
                            icon = "success";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            }).then(function(result) {
                                load_data_table();
                            })
                        } else {
                            title = "Gagal!";
                            icon = "error";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            })
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        errorNotification();
                    });
                }
            });
        }

        /* detail informasi subjek survey per kelurahan */
        $('#table').on('click', '.edit', function (e) {
            var role = $(this).data('id_role');

            $.ajax({
                url: "{{ url('master/hak-akses/role-user/edit') }}",
                type: "post",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    role: role,
                },
                success: function(msg){
                    // Add response in Modal body
                    if(msg){
                        $('#id_role').val(msg.id_role);
                        $('#edit_role').val(msg.nama_role);
                        $('#edit_keterangan').val(msg.keterangan);
                    }else{
                        $('#id_role').val('');
                        $('#edit_role').val('');
                        $('#edit_keterangan').val('');
                    }
                    // Display Modal
                    $('#edit').modal('show');
                }
            });
        });

        function load_data_table() {
            tabelData.ajax.reload(null, 'refresh');
        }

</script>
@endsection
