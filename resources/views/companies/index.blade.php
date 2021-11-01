@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Company') }}</div>
                <a href="{{ route('companies.create') }}">{{ __('Create Company') }}</a>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-lg-12 table-responsive">
                    <table class="table table-bordered" id="editable">
                        <thead>
                            <tr>
                                <th>Srno</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Logo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($companies)
                                @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        {{ $company->name }}
                                    </td>
                                    <td>
                                        {{ $company->email }}
                                    </td>
                                    <td>
                                        {{ $company->website }}
                                    </td>
                                    <td>
                                        <img src="storage/{{ $company->logo }}" height="100px" width="100px"></img>             
                                    </td>
                                    <td>
                                        <a href="#" id="">edit</a> 
                                        / 
                                        <a href="#">delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                    @if(count($companies) === 0)
                        <h5>No Result Found</h5>
                    @endif
                </div>
                {{ $companies->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
