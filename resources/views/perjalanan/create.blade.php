@extends('layouts.main')
@section('title','Isi Data')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-inner--text">
                            {{ session('success') }}
                        </span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('perjalanan.store') }}">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                        <label for="tanggal">Tanggal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control datepicker" name="tanggal" id="tanggal" value="{{ old('tanggal') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control time" name="jam" id="jam" value="{{ old('jam') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi Yang Dikunjungi</label>
                        <textarea class="form-control" id="lokasi" name="lokasi" style="height:150px" value="{{ old('lokasi') }}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="suhu_tubuh">Suhu Tubuh</label>
                        <input type="text" class="form-control" name="suhu_tubuh" id="suhu_tubuh" value="{{ old('suhu_tubuh') }}">
                    </div>
                    <div class="text-right">
                        <a href="{{ route('perjalanan.index') }}" class="btn btn-danger">Kembali</a>
                        <button class="btn btn-primary" type="submit">Store</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

    $(document).ready(function() {
        $('#jam').timepicker({
            timeFormat: 'hh:mm:ss p',
            dropdown: true,
            scrollbar: true
        });
    });


    $(document).ready(function () {
        $('#tanggal').daterangepicker({
            singleDatePicker: true,
            startDate: moment(),
            locale: {
                format: 'YYYY-MM-DD',
            }
        });
    });
</script>
@endsection