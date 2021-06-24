@extends('layouts.admin')

@section('title', 'All Posts')

@section('content')

<div class="container">
    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                <h3>Profile</h3>
            </div>
            <div class="card-body">
                <div class="user-panel mt-3 mb-3" style="text-align: center;">
                    <div class="image">
                        @if(auth()->user()->image)
                        <img src="{{ asset( 'upload/profile/' . auth()->user()->image) }}" class="img-circle elevation-2"  alt="User Image" style="width: 250px;">
                        @endif
                    </div>

                </div>
                <p>Name: {{ auth()->user()->name}}</p>
                <p>Email: {{ auth()->user()->email }}</p>
                <p>Role: {{ ucfirst(auth()->user()->role) }}</p>
            </div>
            <div class="card-footer text-right">
                {{-- <!-- <a href="{{ url('admin/profiles/edit') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-edit"></i>
                    Edit
                </a> --> --}}
                <a class="btn btn-sm btn-info" href="{{ route('admin.profiles.edit', auth()->user()->id) }}">
                    <i class="fas fa-edit"></i>
                    {{ trans('global.edit') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
