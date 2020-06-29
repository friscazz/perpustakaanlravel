@extends('layout.master')
@section('content')
@if(count($data_buku))
    <div class="container">
    <div>Ditemukan {{count($data_buku)}} data dengan kata : {{ $cari ?? '' }}</div>
        @if(Session::has('pesan'))
            <div class="alert alert-success">{{Session::get('pesan')}} </div>
        @endif
        <h2>Data Buku</h2>
        <p align="right"><a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a></p>
        <form action="{{route('buku.search')}}" method="GET">
            @csrf
            <input type="text" name="kata" class="form-control" placeholder="Cari...">
        </form>
        <table class="table table-stripe">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tgl. Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_buku as $buku)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ number_format($buku->harga, 0, ',', '.')}}</td>
                    <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                    <td>
                        <form method='post' action="{{route('buku.destroy',$buku->id)}}">
                            @csrf                    
                            <button class="btn btn-danger" onClick="return confirm('Yakin mau dihapus?')"> Hapus</button>
                        <a class="btn btn-warning" href="{{route('buku.edit',$buku->id)}}">Edit</a>                       
                        </form>                
                    </td>
                </tr>
                @endforeach      
            </tbody>
        </table>
        @else
            <div><h4>Data {{$cari ?? ''}} Tidak ditemukan</h4></div>
            <a href="/buku">Kembali</a>
        @endif
        <div class="text-align-left">{{$data_buku->links()}}</div>
    </div>
@endsection