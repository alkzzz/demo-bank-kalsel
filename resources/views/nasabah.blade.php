@extends('_layout')

@section('content')
<h2>{{ Date::now()->format('l, j F Y H:i') }}</h2>
<hr>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahNasabah">
    Tambah Nasabah
</button>

<div class="modal fade" id="tambahNasabah" tabindex="-1" role="dialog" aria-labelledby="tambahNasabahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahNasabahLabel">Tambah Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ route('tambah_nasabah') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                            <label for="marketing">Pilih Marketing</label>
                            <select id="user_id" class="form-control" id="marketing" name="user_id">
                                @foreach ($daftar_marketing as $marketing)
                                <option value="{{ $marketing->id }}">{{ $marketing->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="nasabah">Nama Nasabah</label>
                        <input type="text" class="form-control" id="nasabah" name="name" />
                    </div>
                    <div class="form-group">
                        <label for="tabungan">Tabungan</label>
                        <input id="tabungan" type="text" class="form-control" name="tabungan" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="tambah-nasabah" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<p></p>
<div class="table-responsive">
    <table id="myTable" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nama Nasabah</th>
                <th scope="col">Nama Marketing</th>
                <th scope="col">Tabungan</th>
                <th scope="col">Tambah</th>
                <th scope="col">Kurang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftar_nasabah as $nasabah)
            <tr>
                <td>{{ $nasabah->name }}</td>
                <td>{{ $nasabah->user->name }}</td>
                <td>{{ "Rp " . number_format($nasabah->tabungan,2,',','.') }}</td>
                <td><button id="{{ $nasabah->id }}" type="button" class="btn btn-success tambah" data-toggle="modal"
                        data-target="#tambahTabungan">
                        Tambah Tabungan
                    </button></td>
                <td><button id="{{ $nasabah->id }}" type="button" class="btn btn-danger kurang" data-toggle="modal"
                        data-target="#kurangTabungan">
                        Kurang Tabungan
                    </button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="tambahTabungan" tabindex="-1" role="dialog" aria-labelledby="tambahTabunganLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahTabunganLabel">Tambah Tabungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="tabungan">Tabungan</label>
                        <input type="text" class="form-control tabunganTambah" name="tabungan" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="tambah-tabungan" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kurangTabungan" tabindex="-1" role="dialog" aria-labelledby="tambahTabunganLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahTabunganLabel">Kurang Tabungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="tabungan">Tabungan</label>
                        <input type="text" class="form-control tabunganKurang" name="tabungan" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="kurang-tabungan" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<script type="text/javascript">
    var token = "{{ Session::token() }}";
    var nasabah_id;

    $(document).ready(function () {
        @if($errors-> any())
        alert("{{ $errors->first() }}");
        @endif
        $('#tambah-nasabah').click(function () {
            
            $.ajax({
                method: 'POST',
                url: "{{ route('tambah_nasabah') }}",
                data: {
                    name: $('#nasabah').val(),
                    user_id: $("#user_id").val(),
                    tabungan : $('#tabungan').maskMoney('unmasked')[0],
                    _token: token
                },
                dataType: 'JSON'
            }).done(function (data) {
                window.location.replace("{{ url('/') }}");
            });
        });
        $(document).on('click', ".tambah", function () {
            nasabah_id = $(this).attr('id');
            $('#tambahTabungan').modal();
        });

        $(document).on('click', ".kurang", function () {
            nasabah_id = $(this).attr('id');
            $('.tabungan').data('id', nasabah_id);
            $('#kurangTabungan').modal();
        });

        $('#tambah-tabungan').click(function () {
            $('.tabunganTambah').attr('data-id', nasabah_id);
            var tabungan = $(".tabunganTambah[data-id="+nasabah_id+"]");
            var url = '{{ route("tambah_tabungan", ":id") }}';
            url = url.replace(':id', nasabah_id);
            var tabungan = tabungan.maskMoney('unmasked')[0];
            $.ajax({
                method: 'PATCH',
                url: url,
                data: {
                    tabungan: tabungan,
                    _token: token
                },
                dataType: 'JSON'
            }).done(function (data) {
                window.location.replace("{{ url('/') }}");
            });
        });

        $('#kurang-tabungan').click(function () {
            $('.tabunganKurang').attr('data-id', nasabah_id);
            var tabungan = $(".tabunganKurang[data-id="+nasabah_id+"]");
            var url = '{{ route("kurang_tabungan", ":id") }}';
            url = url.replace(':id', nasabah_id);
            var tabungan = tabungan.maskMoney('unmasked')[0];
            $.ajax({
                method: 'PATCH',
                url: url,
                data: {
                    tabungan: tabungan,
                    _token: token
                },
                dataType: 'JSON'
            }).done(function (data) {
                window.location.replace("{{ url('/') }}");
            });
        });

         $('#tabungan').maskMoney({
            prefix: 'Rp ',
            thousands: '.',
            decimal: ','
        });

        $('.tabunganTambah').maskMoney({
            prefix: 'Rp ',
            thousands: '.',
            decimal: ','
        });

         $('.tabunganKurang').maskMoney({
            prefix: 'Rp ',
            thousands: '.',
            decimal: ','
        });
    });

</script>
@endsection
