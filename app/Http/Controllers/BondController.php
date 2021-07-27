<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use App\Models\User;
use App\Models\Role;
use App\Models\Course;
use App\Models\Pole;
use Illuminate\Http\Request;
use App\CustomClasses\SgcLogger;
use App\Models\Employee;
use App\Http\Requests\StoreBondRequest;
use App\Http\Requests\UpdateBondRequest;
use App\Models\EmployeeDocument;
use App\Models\BondDocument;

class BondController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonds = Bond::with(['employee', 'course', 'role', 'pole'])->paginate(10); //->orderBy('employee')
        //dd($bonds);
        SgcLogger::writeLog('Bond');

        return view('bond.index', compact('bonds'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::orderBy('name')->get();
        $roles = Role::orderBy('name')->get();
        $courses = Course::orderBy('name')->get();
        $poles = Pole::orderBy('name')->get();
        $bond = new Bond;

        SgcLogger::writeLog('Bond');

        return view('bond.create', compact('employees', 'roles', 'courses', 'poles', 'bond'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBondRequest $request)
    {
        $bond = new Bond;

        $bond->employee_id = $request->employees;
        $bond->role_id = $request->roles;
        $bond->course_id = $request->courses;
        $bond->pole_id = $request->poles;
        $bond->begin = $request->begin;
        $bond->end = $request->end;
        $bond->terminated_on = null;
        $bond->volunteer = $request->has('volunteer');
        $bond->impediment = false;
        $bond->uaba_checked_on = null;

        $bond->save();

        $documents = EmployeeDocument::where('employee_id', $bond->employee_id)->get();
        foreach ($documents as $doc)
        {
            $bondDocument = new BondDocument();
            $bondDocument->original_name = $doc->original_name;
            $bondDocument->file_data = $doc->file_data;
            $bondDocument->document_type_id = $doc->documentType->id;
            $bondDocument->bond_id = $bond->id;

            $bondDocument->save();
        }

        SgcLogger::writeLog($bond);

        return redirect()->route('bonds.index')->with('success', 'Vínculo criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function show(Bond $bond)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function edit(Bond $bond)
    {
        $employees = Employee::orderBy('name')->get();
        $roles = Role::orderBy('name')->get();
        $courses = Course::orderBy('name')->get();
        $poles = Pole::orderBy('name')->get();

        SgcLogger::writeLog($bond);

        return view('bond.edit', compact('employees', 'roles', 'courses', 'poles', 'bond'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBondRequest $request, Bond $bond)
    {
        $bond->employee_id = $request->employees;
        $bond->role_id = $request->roles;
        $bond->course_id = $request->courses;
        $bond->pole_id = $request->poles;
        $bond->begin = $request->begin;
        $bond->end = $request->end;
        $bond->volunteer = $request->has('volunteer');

        try {
            $bond->save();
        } catch (\Exception $e) {
            return back()->withErrors(['noStore' => 'Não foi possível salvar o vínculo: ' . $e->getMessage()]);
        }

        SgcLogger::writeLog($bond);

        return redirect()->route('bonds.index')->with('success', 'Vínculo atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bond $bond)
    {
        SgcLogger::writeLog($bond);

        try {
            $bond->delete();
        } catch (\Exception $e) {
            return back()->withErrors(['noDestroy' => 'Não foi possível excluir o vínculo: ' . $e->getMessage()]);
        }

        return redirect()->route('bonds.index')->with('success', 'Vínculo excluído com sucesso.');
    }
}