@extends('_layout')

@section('content')
<div class="container">
    <h2>Nama Marketing : {{ $marketing->name }}</h2>
    <hr>
    <a class="btn btn-lg btn-warning" href="{{ route('update', $marketing->id) }}">Hitung Akumulasi 1 Hari</a>
    <a class="btn btn-lg btn-info" href="{{ route('bonus', $marketing->id) }}">Hitung Bonus 3 Bulan</a>
    <hr>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">
                    <h2>Total Tabungan Nasabah</h2>
                </div>
                <div class="card-body">
                    <h1 class="text-center mb-0">{{ rupiah($marketing->total_tabungan) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">
                    <h2>Total Poin</h2>
                </div>
                <div class="card-body">
                    <h1 class="text-center mb-0">{{ $marketing->poin }} Poin</h2>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">
                    <h2>Total Bonus</h2>
                </div>
                <div class="card-body">
                    <h1 class="text-center mb-0">{{ rupiah($marketing->poin*5000) }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
@endsection
