@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Company') }}</div>
                <div class="card-body">
                    <form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="label">Company</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="text" name="company" placeholder="company name" value="{{old('company')}}">
                                @if($errors->has('company'))
                                    <div class="error text-danger mt-1">{{ $errors->first('company') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="text" name="email" placeholder="email" value="{{old('email')}}">
                                @if($errors->has('email'))
                                    <div class="error text-danger mt-1">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="logo">Logo</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="file" name="logo" placeholder="logo" value="{{old('logo')}}">
                                @if($errors->has('logo'))
                                    <div class="error text-danger mt-1">{{ $errors->first('logo') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="website">website</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="text" name="website" placeholder="website" value="{{old('website')}}">
                                @if($errors->has('website'))
                                    <div class="error text-danger mt-1">{{ $errors->first('website') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 text-right">
                                <button class="btn btn-primary" type="submit" id="submit">Create</button>
                            </div>
                        </div>
                    </form>
                    @include('includes.alerts')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
