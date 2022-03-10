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
                    <th><center>Nama Kamar</center></th>
                    <th><center>Kosong</center></th>
                </tr>
            </thead>
            <tbody>
                @foreach($kamar as $value)
                    <tr>
                        <td>{{ $value->nik }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('custom_js')

@endsection
