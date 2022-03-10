@extends('back.layout.app')

@section('content')
<div class="card card-flush shadow-sm">
    <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
        {{-- <h3 class="card-title">Title</h3> --}}
        <div class="ribbon-label bg-primary" style="font-size: large;">Master Data Menu</div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                <i class="fa fa-plus"></i> Menu
            </button>
        </div>
    </div>
    <div class="card-body py-5 table-responsive">
        <table id="table" class="table table-striped gy-5 gs-7 border rounded">
            <thead>
                <tr role="row">
                    <th width="2%"><center>NO</center></th>
                    <th><center>Nama Menu</center></th>
                    <th><center>Url</center></th>
                    <th><center>Icon</center></th>
                    <th><center>Status</center></th>
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
                <h5 class="modal-title">Tambah Menu Aplikasi</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <?php
                $status = ['Menu Tunggal','Parent Menu','Child Menu'];
            ?>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="form">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end">Status Menu :</label>
                        <div class="col-lg-8">
                            <select class="form-select" data-control="select2" name="status" id="status" data-placeholder="Pilih Menu Parent">
                                <option value="0">Menu Tunggal</option>
                                <option value="1">Parent Menu</option>
                                <option value="2">Child Menu</option>
                                <option value="3">Sub Parent Menu</option>
                                <option value="4">Child Sub Parent Menu</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10" id="parent" style="display: none">
                        <label class="col-lg-3 col-form-label text-lg-end">Pilih Parent Menu :</label>
                        <div class="col-lg-8">
                            <select class="form-select" data-control="select2" name="parent" data-placeholder="Pilih Menu Parent">
                                <option></option>
                                @foreach ($all as $item)
                                    <option value="{{ $item->id_menu }}">{{ $item->nama_menu }}</option>    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10" id="subparent" style="display: none">
                        <label class="col-lg-3 col-form-label text-lg-end">Pilih Sub Parent Menu :</label>
                        <div class="col-lg-8">
                            <select class="form-select" data-control="select2" name="subparent" data-placeholder="Pilih Sub Menu Parent">
                                <option></option>
                                @foreach ($sub as $item)
                                    <option value="{{ $item->id_menu }}">{{ $item->nama_menu }}</option>    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Menu :</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="nama_menu" placeholder="Nama Menu">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Url Menu :</label>
                        <div class="col-lg-8 col-xl-8">
                            <input type="text" class="form-control" name="url_menu" placeholder="Url Menu">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end">Icon Menu :</label>
                        <div class="col-lg-8 col-xl-8">
                            <input type="text" class="form-control" name="icon" placeholder="Icon Menu">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Status Menu :</label>
                        <div class="col-lg-4 col-xl-2">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <span class="form-check-label fw-bold text-muted">Non Aktif</span>&nbsp;&nbsp;
                                <input class="form-check-input" name="aktif_menu" type="checkbox" value="1" checked="checked" />
                                <span class="form-check-label fw-bold text-muted">Aktif</span>
                            </label>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Urutan ke - :</label>
                        <div class="col-lg-8 col-xl-8">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input type="number" class="form-control" name="urut" min="0" placeholder="Urutan Menu">
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
                <h5 class="modal-title">Edit Menu Aplikasi</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <?php
                    $status =['Menu Tunggal','Parent Menu','Child Menu', 'Sub Parent Menu', 'Child Sub Parent Menu'];
                ?>
                <form method="post" class="kt-form kt-form--label-right" id="formedit">
                    <input type="hidden" class="form-control" id="id_menu" name="id_menu">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end">Status Menu :</label>
                        <div class="col-lg-8">
                            <select class="form-select" data-control="select2" name="status" id="edit_status" data-placeholder="Pilih Menu Parent">
                                @foreach($status as $key => $value)
                                    <option value="{{ $key }}" {{ $key == 1 ? 'selected' : '' }}>
	                                    {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10" id="stat_parent" style="display: none">
                        <label class="col-lg-3 col-form-label text-lg-end">Pilih Parent Menu :</label>
                        <div class="col-lg-8">
                            <select class="form-select" data-control="select2" name="parent" id="edit_parent" data-placeholder="Pilih Menu Parent">
                                <option></option>
                                @foreach ($all as $item)
                                    <option value="{{ $item->id_menu }}" {{ $item['id_menu'] == 2 ? 'selected' : '' }}>{{ $item->nama_menu }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10" id="stat_subparent" style="display: none">
                        <label class="col-lg-3 col-form-label text-lg-end">Pilih Sub Parent Menu :</label>
                        <div class="col-lg-8">
                            <select class="form-select" data-control="select2" name="subparent" data-placeholder="Pilih Sub Menu Parent">
                                <option></option>
                                @foreach ($sub as $item)
                                    <option value="{{ $item->id_menu }}">{{ $item->nama_menu }}</option>    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Menu :</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="nama_menu" id="edit_nama" placeholder="Nama Menu">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Url Menu :</label>
                        <div class="col-lg-8 col-xl-8">
                            <input type="text" class="form-control" name="url_menu" id="edit_url" placeholder="Url Menu">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end">Icon Menu :</label>
                        <div class="col-lg-8 col-xl-8">
                            <input type="text" class="form-control" name="icon" id="edit_icon" placeholder="Icon Menu">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Status Menu :</label>
                        <div class="col-lg-4 col-xl-2">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <span class="form-check-label fw-bold text-muted">Non Aktif</span>&nbsp;&nbsp;
                                <input class="form-check-input" name="aktif_menu" type="checkbox" value="1" checked="checked" />
                                <span class="form-check-label fw-bold text-muted">Aktif</span>
                            </label>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Urutan ke - :</label>
                        <div class="col-lg-8 col-xl-8">
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input type="number" class="form-control" name="urut" min="0" id="edit_urut" placeholder="Urutan Menu">
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
                url : "{{ url('master/hak-akses/menu/datatable') }}",
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
                        url: "{{ url('master/hak-akses/menu/simpan') }}",
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
                        url: "{{ url('master/hak-akses/menu/ubah') }}",
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
                        url: "{{ url('master/hak-akses/menu/destroy') }}",
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

        $("#status").change(function() { 
            if ( $(this).val() == "2") {
                $("#parent").show();
                $("#parent").prop('required',true);
                $("#subparent").hide();
            } else if ($(this).val() == "3"){
                $("#parent").show();
                $("#parent").prop('required',true);
                $("#subparent").hide();
            } else if ($(this).val() == "4"){
                $("#parent").show();
                $("#parent").prop('required',true);
                $("#subparent").show();
                $("#subparent").prop('required',true);
            }
            else{
                $("#subparent").hide();
                $("#parent").hide();
            }
        });
        
        $("#edit_status").change(function() { 
            if ( $(this).val() == "2") {
                $("#stat_parent").show();
                $("#stat_parent").prop('required',true);
                $("#stat_subparent").hide();
            } else if ($(this).val() == "3"){
                $("#stat_parent").show();
                $("#stat_parent").prop('required',true);
                $("#stat_subparent").hide();
            } else if ($(this).val() == "4"){
                $("#stat_parent").show();
                $("#stat_parent").prop('required',true);
                $("#stat_subparent").show();
                $("#stat_subparent").prop('required',true);
            }
            else{
                $("#stat_subparent").hide();
                $("#stat_parent").hide();
            }
        });

        /* detail informasi subjek survey per kelurahan */
        $('#table').on('click', '.edit', function (e) {
            var menu = $(this).data('id_menu');

            $.ajax({
                url: "{{ url('master/hak-akses/menu/edit') }}",
                type: "post",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    menu: menu,
                },
                success: function(msg){
                    // Add response in Modal body
                    if(msg){
                        $('#id_menu').val(msg.id_menu);
                        $('#edit_nama').val(msg.nama_menu);
                        $('#edit_url').val(msg.url_menu);
                        $('#edit_icon').val(msg.icon);
                        $('#edit_urut').val(msg.urutan);
                        var x = msg.status;
                        // document.getElementById("edit_status").innerHTML = x;
                        // var select = document.getElementById('language');
                        // var option = x.options[x.selectedIndex];
                        _status = msg.status;

                        if (_status == 2) {
                            $("#stat_parent").show();
                            $("#stat_parent").prop('required',true);
                        }else{
                            $("#stat_parent").hide();
                        }
                    }else{
                        $('#id_menu').val('');
                        $('#edit_nama').val('');
                        $('#edit_url').val('');
                        $('#edit_icon').val('');
                        $('#edit_urut').val('');
                        $("#stat_parent").val('');
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
