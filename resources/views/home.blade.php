@extends('layouts.master')

@section('heading')
    <h3>Dashboard</h4>
    @endsection

    @section('content')
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4>Welcome, {{ auth()->user()->name }}
    </h3>
    <br>
    @if (auth()->user()->hasRole('admin'))
        <ul class="list-group">
            <li class="list-group-item">You can manage users on user menu</li>
            <li class="list-group-item">You can manage roles and assign role on role menu</li>
            <li class="list-group-item">You can manage coin records and print record on coin menu</li>
        </ul>
    @endif
    @if (auth()->user()->hasRole('bendahara'))
        <ul class="list-group">
            <li class="list-group-item">You can manage coin records and print record on coin menu</li>
        </ul>
    @endif
    @if (auth()->user()->hasRole('kolektor'))
        <ul class="list-group">
            <li class="list-group-item">You can manage coin records on coin menu</li>
        </ul>
    @endif
    </div>
    </div>
@endsection
