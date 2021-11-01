<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyFormRequest;
use Company, Log;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::simplePaginate(10);
        $data = [
            'companies' => $companies,
        ];
        
        return view('companies.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CompanyFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = 'Failed to insert company data';

        try {
            $file_name = time() . '_' . $request->file('logo')->getClientOriginalName();
            $file_path = $request->file('logo')->storeAs('uploads', $file_name, 'public');

            $company = new Company;
            $company->name = $request->company;
            $company->email = $request->email;
            $company->logo = $file_path;
            $company->save();
            $message = 'Employee successfully created';

            return redirect()->route('companies.index')
                ->with([
                    'success' => true, 
                    'message' => $message
                ]
            );
        } catch (Exception $e) {
            Log::error($message, $request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
