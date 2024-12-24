<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use App\Http\Requests\EmployeeRequest;
use Intervention\Image\Drivers\Gd\Driver;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {
        $query = Employee::query();

        // Search
        if($request->filled('search')){
            $search = $request->search;
            $query->where(function($q) use($search){
                $q->orWhere("name","LIKE","%{$search}%")
                    ->orWhere("email","LIKE","%{$search}%")
                    ->orWhere("phone","LIKE","%{$search}%")
                    ->orWhereHas("company",function($q) use($search){
                        $q->where("name","LIKE","%{$search}%");
                    });
            });

        }


        // Filter By Date
        if($request->filled('start_date') && $request->filled('end_date')){
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $query->whereBetween('created_at',[$start_date,$end_date]);
        }

        $employees = $query->orderByDesc('id')->paginate(5);
        $companies = Company::all();
        return view('employees.index', compact('employees','companies'));
    }

    public function create()
    {

    }

    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();

        try{
            if ($request->hasFile('profile')) {
                $profile = $request->file('profile');

                if (!in_array($profile->getClientMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
                    session()->flash('error','The file must be a valid image!');
                    return redirect()->back();
                }

                $manager = new ImageManager(new Driver());
                $image = $manager->read($profile);
                $image->resize(300, 300);

                $fileName = uniqid() . '.' . $profile->getClientOriginalExtension();

                $directoryPath = storage_path('app/public/profiles');
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                $filePath = 'profiles/' . $fileName;
                $image->save(storage_path('app/public/' . $filePath));

                $data['profile'] = 'storage/' . $filePath;

            }

            $data['name'] = $request['name'];
            $data['email'] = $request['email'];
            $data['phone'] = $request['phone'];
            $data['company_id'] = $request['company_id'];

            Employee::create($data);

            return redirect(route('employees.index'))->with('success',"Created Successfully!");

        }catch (Exception $e) {
            Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating data.');
        }

    }

    public function show(Employee $employee)
    {

    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();
        $html =  view('employees.edit_modal', compact('employee', 'companies'))->render();
        if(request()->ajax()) {
            return response()->json([
                'success' => true,
                'msg' => 'Error occured while passing data!',
                'html'=>$html
            ]);
        }
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {

        $data = $request->validated();

        try{
            if ($request->hasFile('profile')) {
                $profile = $request->file('profile');

                if (!in_array($profile->getClientMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
                    session()->flash('error','The file must be a valid image!');
                    return redirect()->back();
                }

                $manager = new ImageManager(new Driver());
                $image = $manager->read($profile);
                $image->resize(300, 300);

                $fileName = uniqid() . '.' . $profile->getClientOriginalExtension();

                $directoryPath = storage_path('app/public/profiles');
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                $filePath = 'profiles/' . $fileName;
                $image->save(storage_path('app/public/' . $filePath));

                $data['profile'] = 'storage/' . $filePath;

            }

            $data['name'] = $request['edit_name'];
            $data['email'] = $request['email'];
            $data['phone'] = $request['phone'];
            $data['company_id'] = $request['edit_company_id'];

            $employee->update($data);

            return response()->json([
                'success' => true,
                'msg' => 'Updated Successfully!',
            ]);

        }catch (Exception $e) {
            Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating data.');
        }

    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        if(request()->ajax()) {
            return response()->json(['success' => true, 'msg' => 'Deleted successfully!']);
        }
    }
}
