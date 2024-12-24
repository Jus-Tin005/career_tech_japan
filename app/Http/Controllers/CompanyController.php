<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CompanyRequest;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::query();

        // Search
        if($request->filled('search')){
            $search = $request->search;
            $query->where(function($q) use($search){
                $q->where("name","LIKE","%{$search}%")
                  ->orWhere("email","LIKE","%{$search}%")
                  ->orWhere("website","LIKE","%{$search}%");
            });

        }


        // Filter By Date
        if($request->filled('start_date') && $request->filled('end_date')){
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $query->whereBetween('created_at',[$start_date,$end_date]);
        }
        $companies = $query->orderByDesc('id')->paginate(5);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {

    }

    public function store(CompanyRequest $request)
    {
        $data = $request->validated();

        try{
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');

                if (!in_array($logo->getClientMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
                    session()->flash('error','The file must be a valid image!');
                    return redirect()->back();
                }

                $manager = new ImageManager(new Driver());
                $image = $manager->read($logo);
                $image->resize(300, 300);

                $fileName = uniqid() . '.' . $logo->getClientOriginalExtension();

                $directoryPath = storage_path('app/public/logos');
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                $filePath = 'logos/' . $fileName;
                $image->save(storage_path('app/public/' . $filePath));

                $data['logo'] = 'storage/' . $filePath;

            }

            $data['email'] = $request['email'];
            $data['website'] = $request['website'];

            Company::create($data);

            return redirect(route('companies.index'))->with('success',"Created Successfully!");

        }catch (Exception $e) {
            Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating data.');
        }

    }

    public function show(Company $company)
    {

    }

    public function edit(Company $company)
    {
        $html =  view('companies.edit_modal', compact('company'))->render();
        if(request()->ajax()) {
            return response()->json([
                'success' => true,
                'msg' => 'Error occured while passing data!',
                'html'=>$html
            ]);
        }
    }

    public function update(CompanyRequest $request, Company $company)
    {

        $data = $request->validated();

        try{
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');

                if (!in_array($logo->getClientMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
                    session()->flash('error','The file must be a valid image!');
                    return redirect()->back();
                }

                $manager = new ImageManager(new Driver());
                $image = $manager->read($logo);
                $image->resize(300, 300);

                $fileName = uniqid() . '.' . $logo->getClientOriginalExtension();

                $directoryPath = storage_path('app/public/logos');
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                $filePath = 'logos/' . $fileName;
                $image->save(storage_path('app/public/' . $filePath));

                $data['logo'] = 'storage/' . $filePath;

            }

            $data['name'] = $request['edit_name'];
            $data['email'] = $request['email'];
            $data['website'] = $request['website'];

            $company->update($data);

            return response()->json([
                'success' => true,
                'msg' => 'Updated Successfully!',
            ]);

        }catch (Exception $e) {
            Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating data.');
        }

    }

    public function destroy(Company $company)
    {
        $company->delete();
        if(request()->ajax()) {
            return response()->json(['success' => true, 'msg' => 'Deleted successfully!']);
        }
    }
}

