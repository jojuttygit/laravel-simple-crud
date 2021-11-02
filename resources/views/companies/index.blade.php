@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Companies') }}</div>
                <div class="card-body">
                    <div class="col-lg-12 table-responsive">
                        <div class="text-right mb-3">
                            <a href="{{ route('companies.create') }}" class="">{{ __('Create Company') }}</a>
                        </div>
                        <table class="table table-bordered" id="editable">
                            <thead>
                                <tr>
                                    <th>Srno</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Logo</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($companies)
                                    @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $loop->index + $companies->firstItem() }}</td>
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
                                            <img src="{{URL::to('/')}}/storage/{{ $company->logo }}" height="100px" width="100px"></img>             
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-default">
                                                <a href="{{route('companies.edit', $company->company_id)}}">edit</a> 
                                            </button>
                                            <form action="{{route('companies.destroy', $company->company_id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-default">
                                                    <span class="text-danger">delete</span>
                                                </button>
                                            </form>
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
                    <div class="col-lg-12 mt-3">
                        {{ $companies->links() }}
                    </div>
                    @include('includes.alerts')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
