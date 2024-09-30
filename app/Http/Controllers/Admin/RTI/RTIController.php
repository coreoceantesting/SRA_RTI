<?php

namespace App\Http\Controllers\Admin\RTI;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RTI\StoreRtiRequest;
use App\Http\Requests\Admin\RTI\UpdateRtiRequest;
use App\Http\Requests\FirstAppeal\StoreFirstAppealRequest;
use App\Http\Requests\SecondAppeal\StoreSecondAppealRequest;
use App\Models\Rti;
use App\Models\Department;
use App\Models\FirstAppeal;
use App\Models\SecondAppeal;
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
        if(auth()->user()->roles->pluck('name')[0] === "Department")
        {
            $rtis = Rti::join('departments', 'rtis.concerned_department', '=', 'departments.id')
            ->where('rtis.concerned_department', auth()->user()->department)
            ->get(['rtis.*','departments.department_name']);
        }else{
            $rtis = Rti::join('departments', 'rtis.concerned_department', '=', 'departments.id')->get(['rtis.*','departments.department_name']);
        }
        $departments = Department::latest()->get();

        return view('RTI.rtis')->with(['rtis'=> $rtis, 'departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::latest()->get();

        return view('RTI.createRti')->with(['departments' => $departments]);
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
    public function edit($id)
    {
        $rti = Rti::findOrFail($id);
        $departments = Department::latest()->get();

        return view('RTI.editRti')->with(['rti' => $rti ,'departments' => $departments]);
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

    public function first_appeal($id)
    {
        $rtis = Rti::findOrFail($id);
        $departments = Department::latest()->get();
        return view('RTI.first_appeal')->with(['rtis' => $rtis, 'departments' => $departments]);
    }

    public function store_first_appeal(StoreFirstAppealRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['rti_id'] = $request->input('edit_model_id');
            FirstAppeal::create($input);
            DB::table('rtis')->where('id', $request->input('edit_model_id'))->update([
                'status' => "First Appeal"
            ]);
            DB::commit();

            return response()->json(['success'=> 'First Appeal Successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'firstAppeal');
        }
    }

    public function second_appeal($id)
    {
        $rtis = Rti::findOrFail($id);
        $departments = Department::latest()->get();
        return view('RTI.second_appeal')->with(['rtis' => $rtis, 'departments' => $departments]);
    }

    public function store_second_appeal(StoreSecondAppealRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['rti_id'] = $request->input('edit_model_id');

            if ($request->hasFile('old_document')) {
                $Doc = $request->file('old_document');
                $DocPath = $Doc->store('old_document', 'public');
                $input['old_document'] = $DocPath;
            }

            SecondAppeal::create($input);
            DB::table('rtis')->where('id', $request->input('edit_model_id'))->update([
                'status' => "Second Appeal"
            ]);
            DB::commit();

            return response()->json(['success'=> 'Second Appeal Successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'SecondAppeal');
        }
    }

    public function first_appeal_list()
    {
        if(auth()->user()->roles->pluck('name')[0] === "Department")
        {
            $lists = FirstAppeal::join('departments', 'first_appeals.concerned_department', '=', 'departments.id')
                    ->where('first_appeals.concerned_department', auth()->user()->department)
                    ->get(['first_appeals.*','departments.department_name']);
        }else{
            $lists = FirstAppeal::join('departments', 'first_appeals.concerned_department', '=', 'departments.id')->get(['first_appeals.*','departments.department_name']);

        }
        return view('RTI.first_appeal_list')->with(['lists' => $lists]);
    }

    public function second_appeal_list()
    {
        $lists = SecondAppeal::latest()->get();
        return view('RTI.second_appeal_list')->with(['lists' => $lists]);
    }
}
