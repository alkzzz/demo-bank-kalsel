@extends('_layout')

@section('content')
<div class="table-responsive">
    <table id="myTable" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nama Marketing</th>
                <th scope="col">Jumlah Tabungan</th>
                <th scope="col">Jumlah Poin</th>
                <th scope="col">Jumlah Bonus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftar_marketing as $marketing)
            <tr>
                <td>{{ $marketing->name }}</td>
                <td data-order="{{ $marketing->nasabah->sum('tabungan') }}">{{ rupiah($marketing->nasabah->sum('tabungan')) }}</td>
                <td>{{ hitungPoin($marketing->nasabah) }}</td>
                <td>{{ rupiah(hitungPoin($marketing->nasabah)*5000) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
