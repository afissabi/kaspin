@extends('back.layout.app')

@section('content')
<div class="card card-flush shadow-sm">
    <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
        {{-- <h3 class="card-title">Title</h3> --}}
        <div class="ribbon-label bg-primary" style="font-size: large;">Data Barang Masuk</div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                <i class="fa fa-plus"></i> Barang Masuk
            </button>
        </div>
    </div>
    <div class="card-body py-5 table-responsive">
        <table id="table" class="table table-striped gy-5 gs-7 border rounded">
            <thead>
                <tr role="row">
                    <th width="2%"><center>NO</center></th>
                    <th><center>Tanggal Transaksi</center></th>
                    <th><center>Kode Barang</center></th>
                    <th><center>Nama Barang</center></th>
                    <th><center>Satuan Barang</center></th>
                    <th><center>Jumlah Sebelum</center></th>
                    <th><center>Jumlah Masuk</center></th>
                    <th><center>Catatan</center></th>
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
                <h5 class="modal-title">Tambah Barang Masuk</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="form">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Tanggal Transaksi :</label>
                        <div class="col-lg-8 col-xl-8">
                            <input type="date" class="form-control" name="tanggal" placeholder="Tanggal Transaksi">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Barang :</label>
                        <div class="col-lg-8">
                            <select class="form-select" data-control="select2" name="barang" data-placeholder="Pilih Barang">
                                <option></option>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->id_barang }}">{{ $item->kd_barang }} | {{ $item->nama_barang }}</option>    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Jumlah Barang :</label>
                        <div class="col-lg-8 col-xl-8">
                            <input type="number" min="0" class="form-control" name="jumlah" placeholder="Jumlah Barang">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end">Catatan Transaksi :</label>
                        <div class="col-lg-8 col-xl-8">
                            <textarea class="form-control" name="catatan" rows="4"></textarea>
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
                <h5 class="modal-title">Edit Data Barang Masuk</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                
                <form method="post" class="kt-form kt-form--label-right" id="formedit">
                    <input type="hidden" class="form-control" id="id_t_barang" name="id_t_barang">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Tanggal Transaksi :</label>
                        <div class="col-lg-8 col-xl-8">
                            <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal Transaksi">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Barang :</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="barang" id="barang">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Jumlah Barang :</label>
                        <div class="col-lg-8 col-xl-8">
                            <input type="hidden" min="0" class="form-control" name="jum_sebelum" id="jum_sebelum">
                            <input type="number" min="0" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah Barang">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end">Catatan Transaksi :</label>
                        <div class="col-lg-8 col-xl-8">
                            <textarea class="form-control" name="catatan" id="catatan" rows="4"></textarea>
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
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
<script type="text/javascript">
    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "{{ config('services.firebase.api_key') }}",
        authDomain: "{{ config('services.firebase.auth_domain') }}",
        databaseURL: "{{ config('services.firebase.database_url') }}",
        projectId: "{{ config('services.firebase.project_id') }}",
        storageBucket: "{{ config('services.firebase.storage_bucket') }}",
        messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
        appId: "{{ config('services.firebase.app_id') }}"
    };

    // Initialize Firebase
    const app = firebase.initializeApp(firebaseConfig);

    var database = firebase.database();

    var lastId = 0;
    
    // get post data
    database.ref("posts").on('value', function(snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function(index, value){
            if(value) {
                htmls.push('<tr>\
                    <td>'+ index +'</td>\
                    <td>'+ value.title +'</td>\
                    <td>'+ value.content +'</td>\
                    <td><a data-bs-toggle="modal" data-bs-target="#update-modal" class="btn btn-success update-post" data-id="' + index + '">Update</a>\
                    <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn btn-danger delete-data" data-id="' + index + '">Delete</a></td>\
                </tr>');
            }       
            lastId = index;
        });
        $('#table-list').html(htmls);
    });

    // add data
    $('#add-submit').on('click', function() {
        var formData = $('#add-post').serializeArray();
        var createId = Number(lastId) + 1;

        firebase.database().ref('posts/' + createId).set({
            title: formData[0].value,
            content: formData[1].value,
        });

        // Reassign lastID value
        lastId = createId;
        $("#add-post")[0].reset();
        $("#add-modal").modal('hide');
    });

    // update modal
    var updateID = 0;
    $('body').on('click', '.update-post', function() {
        updateID = $(this).attr('data-id');
        firebase.database().ref('posts/' + updateID).on('value', function(snapshot) {
            var values = snapshot.val();
            $('#update-title').val(values.title);
            $('#update-content').val(values.content);
        });
    });

    // update post
    $('#update-button').on('click', function() {
        var values = $("#update-post").serializeArray();
        var postData = {
            title : values[0].value,
            content : values[1].value,
        };

        var updatedPost = {};
        updatedPost['/posts/' + updateID] = postData;

        firebase.database().ref().update(updatedPost);

        $("#update-modal").modal('hide');
        $("#update-post")[0].reset();
    });

    // delete modal
    $("body").on('click', '.delete-data', function() {
        var id = $(this).attr('data-id');
        $('#post-id').val(id);
    });

    // delete post
    $('#delete-button').on('click', function() {
        var id = $('#post-id').val();
        firebase.database().ref('posts/' + id).remove();

        $('#post-id').val('');
        $("#delete-modal").modal('hide');
    });
</script>
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
                url : "{{ url('transaksi/barang-masuk/datatable') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: function(data){
                }
            },
            columnDefs: [{
                targets: [2, 3, 4],
                // className: ''
            }]
        });
    })

    $(function () {
        $("#form").submit(function(e) {
            e.preventDefault();

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambah Data Barang",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Tambah!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('transaksi/barang-masuk/simpan') }}",
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
                text: "Mengedit data barang tersebut",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Yakin!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('transaksi/barang-masuk/ubah') }}",
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
                text: "Menghapus Data Barang",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('transaksi/barang-masuk/destroy') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        data: {
                            id_t_barang : id_data
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

        $('#table').on('click', '.edit', function (e) {
            var id_t_barang = $(this).data('id_t_barang');

            $.ajax({
                url: "{{ url('transaksi/barang-masuk/edit') }}",
                type: "post",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    id_t_barang: id_t_barang,
                },
                success: function(msg){
                    // Add response in Modal body
                    if(msg){
                        $('#id_t_barang').val(msg.id_t_barang);
                        $('#barang').val(msg.barang);
                        $('#tanggal').val(msg.tanggal);
                        $('#jumlah').val(msg.jumlah);
                        $('#jum_sebelum').val(msg.jumlah);
                        $('#catatan').val(msg.catatan);
                    }else{
                        $('#id_t_barang').val('');
                        $('#barang').val('');
                        $('#tanggal').val('');
                        $('#jumlah').val('');
                        $('#jum_sebelum').val('');
                        $('#catatan').val('');
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
