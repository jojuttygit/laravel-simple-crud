<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyFormRequest;
use DB, Company, Log;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::simplePaginate(config('constant.pagination_count'));
        return view('companies.index', compact('companies'));
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
    public function store(CompanyFormRequest $request)
    {
        $response = [
            'error' => true,
            'message' => 'Failed to insert company data'
        ];

        try {
            $file_name = time() . '_' . $request->file('logo')->getClientOriginalName();
            $file_path = $request->file('logo')->storeAs('uploads', $file_name);

            $company = new Company;
            $company->name = $request->company;
            $company->email = $request->email;
            $company->logo = $file_path;
            $company->website = $request->website;
            $company->save();
            $response = [
                'success' => true,
                'message' => 'Company successfully created'
            ];
        } catch (Exception $e) {
            Log::error($e->getMessage(), $request->all());
        }

        return redirect()->back()
            ->with($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function show($company_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function edit($company_id)
    {
        $company = Company::find($company_id);

        if ($company) {
            $data = [
                'company' => $company
            ];

            return view('companies.edit', $data);
        }

        return redirect()->back()
            ->with([
                'error' => true, 
                'message' => 'Company not found'
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CompanyFormRequest  $request
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyFormRequest $request, $company_id)
    {
        $company = Company::find($company_id);
        $response = [
            'error' => true,
            'message' => 'Failed to updated company data'
        ];

        try {
            $company->name = $request->company;
            $company->email = $request->email;

            if ($request->hasFile('logo')) {
                $file_name = time() . '_' . $request->file('logo')->getClientOriginalName();
                $file_path = $request->file('logo')->storeAs('uploads', $file_name);
                $company->logo = $file_path;
            }

            $company->website = $request->website;
            $company->save();
            $response = [
                'success' => true,
                'message' => 'Company successfully updated'
            ];
        } catch (Exception $e) {
            Log::error($e->getMessage(), $request->all());
        }

        return redirect()->back()
            ->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $company_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company_id)
    {
        $company = Company::find($company_id);
        $response = [
            'error' => true,
            'message' => 'Fail to delete ethe company data',
        ];

        if ($company) {
            DB::beginTransaction();

            try {
                $company->delete();
                DB::commit();
                $response = [
                    'success' => true,
                    'message' => 'Company successfully deleted',
                ];
            } catch (Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage(), ['company_id' => $company_id]);
            }
        }

        return redirect()->back()
            ->with($response);
    }
}
