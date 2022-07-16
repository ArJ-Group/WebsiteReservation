<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $employee = Employee::search(['name', 'skill', 'description'], $search)->get();
        } else {
            $employee = Employee::get();
        }
        return view('admin.employeeIndex', compact('employee'));
    }

    public function employeeCustomer()
    {
        $employees = Employee::get();
        return view('customer.barber', compact('employees'));
    }

    public function create()
    {
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'skill' => 'required',
            'description' => 'required',
            'image' => 'nullable',
        ]);

        $employee = new Employee;
        if ($request->file('image')) {
            $image = $request->file('image')->store('images', 'public');
            $employee->image = $image;
        }

        $employee->name = $request->get('name');
        $employee->skill = $request->get('skill');
        $employee->description = $request->get('description');

        $employee->save();


        return redirect()->route('employee.index')
            ->with('success', 'Employee Successfully Added');
    }


    public function show(Employee $employee)
    {
        //
    }


    public function edit($idemployee)
    {
        $employee = Employee::where('employee_id', $idemployee)
            ->first();
        return view('admin.employeeEdit', ['employee' => $employee]);
    }


    public function update(Request $request, $idemployee)
    {
        $request->validate([
            'name' => 'required',
            'skill' => 'required',
            'description' => 'required',
            'image' => 'nullable',
        ]);

        $employee = Employee::where('employee_id', $idemployee)
            ->first();

        if ($request->file('image')) {
            if ($employee->image && file_exists(storage_path('app/public/' . $employee->image))) {
                if($employee->image !== 'images/employeeDefault.jpg'){
                Storage::delete('public/' . $employee->image);
                }
                $image = $request->file('image')->store('images', 'public');
                $employee->image = $image;
            }
        }

        $employee->name = $request->get('name');
        $employee->skill = $request->get('skill');
        $employee->description = $request->get('description');;

        $employee->save();


        return redirect()->route('employee.index')
            ->with('success', 'Employee Successfully Updated');
    }


    public function destroy($idemployee)
    {
        $employee = Employee::where('employee_id', $idemployee)
            ->first();
        if($employee->image !== 'images/employeeDefault.jpg'){
        Storage::delete('public/' . $employee->image);
        }
        $employee->delete();
        return redirect()->route('employee.index')
            ->with('success', 'Employee seccesfully Deleted');
    }
}
