<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeFormRequest;
use Company, Employee;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('company')
            ->has('company')
            ->simplePaginate(config('constant.pagination_count'));
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::select('company_id', 'name')->get();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\EmployeeFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeFormRequest $request)
    {
        $response = [
            'error' => true,
            'message' => 'Failed to insert employee data'
        ];

        try {
            $employee = new Employee;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->company_id = $request->company;
            $employee->save();
            $response = [
                'success' => true, 
                'message' => 'Employee successfully created'
            ];
        } catch (Exception $e) {
            Log::error($e->getMessage(), $request->all());
        }

        return redirect()->back()->with($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function show($employee_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function edit($employee_id)
    {
        $employee = Employee::find($employee_id);

        if ($employee) {
            $companies = Company::select('company_id', 'name')->get();
            $data = [
                'employee' => $employee,
                'companies' => $companies,
            ];

            return view('employees.edit', $data);
        }

        return redirect()->back()
            ->with([
                'error' => true, 
                'message' => 'Employee not found'
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\EmployeeFormRequest  $request
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeFormRequest $request, $employee_id)
    {
        $response = [
            'error' => true,
            'message' => 'Failed to update employee data',
        ];

        try {
            $employee = Employee::find($employee_id);
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->company_id = $request->company;
            $employee->save();
            $response = [
                'success' => true, 
                'message' => 'Employee successfully updated'
            ];
        } catch (Exception $e) {
            Log::error($e->getMessage(), $request->all());
        }

        return redirect()->back()->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee_id)
    {
        $employee = Employee::find($employee_id);
        $response = [
            'error' => true,
            'message' => 'Fail to delete employee data',
        ];

        if ($employee) {
            $employee->delete();
            $response = [
                'success' => true,
                'message' => 'Employee deleted',
            ];
        }

        return redirect()->back()
            ->with($response);
    }
}
