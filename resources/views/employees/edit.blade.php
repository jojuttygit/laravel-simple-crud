@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Employee') }}</div>
                <div class="card-body">
                    <form action="{{route('employees.update', $employee->employee_id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="first-name">First name</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="text" name="first_name" placeholder="first name" value="{{old('first_name', $employee->first_name)}}">
                                @if($errors->has('first_name'))
                                    <div class="error text-danger mt-1">{{ $errors->first('first_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="last-name">Last name</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="text" name="last_name" placeholder="last name" value="{{old('last_name', $employee->last_name)}}">
                                @if($errors->has('last_name'))
                                    <div class="error text-danger mt-1">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="text" name="email" placeholder="email" value="{{old('email', $employee->email)}}">
                                @if($errors->has('email'))
                                    <div class="error text-danger mt-1">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="phone">Phone</label>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="text" name="phone" placeholder="phone" value="{{old('phone', $employee->phone)}}">
                                @if($errors->has('phone'))
                                    <div class="error text-danger mt-1">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label for="company">Company</label>
                            </div>
                            <div class="col-lg-4">
                                <select class="form-control" name="company">
                                    <option>Select company</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->company_id }}" {{ ( old('company') == $company->company_id || $company->company_id == $employee->company_id) ? 'selected' : '' }}> {{ $company->name }} </option>
                                    @endforeach    
                                </select>
                                @if($errors->has('company'))
                                    <div class="error text-danger mt-1">{{ $errors->first('company') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 text-right">
                                <button class="btn btn-primary" type="submit">update</button>
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
