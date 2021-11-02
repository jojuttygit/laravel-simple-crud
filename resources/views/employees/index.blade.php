@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Employees') }}</div>
                <div class="card-body">
                    <div class="col-lg-12 table-responsive">
                        <div class="text-right mb-3">
                            <a href="{{ route('employees.create') }}" class="">{{ __('Create Employee') }}</a>
                        </div>
                        {{$employees}}
                        <table class="table table-bordered" id="editable">
                            <thead>
                                <tr>
                                    <th>Srno</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @isset($employees)
                                    @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->index + $employees->firstItem() }}</td>
                                        <td>
                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                        </td>
                                        <td>
                                            {{ $employee->email }}
                                        </td>
                                        <td>
                                            {{ $employee->phone }}
                                        </td>
                                        <td>
                                            {{ $employee->company->name }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-default">
                                                <a href="{{route('employees.edit', $employee->employee_id)}}">edit</a> 
                                            </button>
                                            <form action="{{route('employees.destroy', $employee->employee_id)}}" method="post">
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
                        @if(count($employees) === 0)
                            <h5>No Result Found</h5>
                        @endif
                    </div>
                    <div class="col-lg-12 mt-3">
                        {{ $employees->links() }}
                    </div>
                    @include('includes.alerts')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
