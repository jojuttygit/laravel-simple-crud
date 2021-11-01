@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Company') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="label">Company</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="text" name="company" placeholder="company name">
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="text" name="email" placeholder="email">
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="logo">Logo</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="file" name="logo" placeholder="logo">
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="website">website</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="text" name="website" placeholder="website">
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 text-right">
                                <button class="btn btn-primary" type="submit" id="submit">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
