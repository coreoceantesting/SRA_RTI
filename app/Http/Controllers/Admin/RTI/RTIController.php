<?php

namespace App\Http\Controllers\Admin\RTI;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RTI\StoreRtiRequest;
use App\Http\Requests\Admin\RTI\UpdateRtiRequest;
use App\Models\Rti;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RTIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rtis = Rti::join('departments', 'rtis.concerned_department', '=', 'departments.id')->get(['rtis.*','departments.department_name']);
        $departments = Department::latest()->get();

        return view('RTI.rtis')->with(['rtis'=> $rtis, 'departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRtiRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            Rti::create($input);
            DB::commit();

            return response()->json(['success'=> 'RTI created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'RTI');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rti $rti)
    {
        if ($rti)
        {
            $response = [
                'result' => 1,
                'rti' => $rti,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRtiRequest $request, Rti $rti)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $rti->update($input);
            DB::commit();

            return response()->json(['success'=> 'RTI updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'RTI');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rti $rti)
    {
        try
        {
            DB::beginTransaction();
            $rti->delete();
            DB::commit();

            return response()->json(['success'=> 'RTI deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'RTI');
        }
    }
}
