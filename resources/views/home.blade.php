@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <h1>Selamat datang di aplikasi kasir</h1>
                    <a href="{{ url('/') }}">Klik untuk masuk kedalam aplikasi</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
