@extends('back.layout.app')

@section('content')
<div class="card card-flush shadow-sm">
    <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
        {{-- <h3 class="card-title">Title</h3> --}}
        <div class="ribbon-label bg-primary" style="font-size: large;">Akses Menu User {{ $user->nama }}</div>
    </div>
    <div class="card-body py-5 table-responsive">
        <table id="table" class="table table-striped gy-5 gs-7 border rounded">
            <thead>
                <tr role="row">
                    <th width="2%"><center>NO</center></th>
                    <th><center>Nama Menu</center></th>
                    <th><center>Pilih</center></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;    
                ?>
                @foreach($menu as $value)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $value->nama_menu }}</td>
                        <td><input type="checkbox" value="{{ $value->id_menu }}" name="id_menu[]" @if($value->menu_user != null ) checked @endif></td>
                    </tr>
                    @foreach($value->sub as $item)
                    <tr>
                        <td>-</td>
                        <td>{{ $item->nama_menu }}</td>
                        <td><input type="checkbox" value="{{ $item->id_menu }}" name="id_menu[]" @if($item->menu_user != null ) checked @endif></td>
                    </tr>
                        @foreach($item->sub_child as $item)
                        <tr>
                            <td></td>
                            <td># {{ $item->nama_menu }}</td>
                            <td><input type="checkbox" value="{{ $item->id_menu }}" name="id_menu[]" @if($value->menu_user != null ) checked @endif></td>
                        </tr>
                        @endforeach
                    @endforeach    
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('custom_js')

@endsection
