<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Http\Traits\Api\ApiResponser;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use Intervention\Image\Drivers\Gd\Driver;

class EmployeeApiController extends Controller
{
    use ApiResponser;
    public function index()
    {
        $companys = Employee::with('company')->orderByDesc("id")->get();
        $res = EmployeeResource::collection($companys);
        return $this->successResponse('Employees', $res, 200);
    }

    public function show($id)
    {
        $company = Employee::with('company')->where("id",$id)->first();
        $res = new EmployeeResource($company);
        return $this->successResponse('Employees', $res, 200);
    }

    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');

            if (!in_array($profile->getClientMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
                return $this->errorResponse("The file must be a valid image!", 401);
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

        $employee = Employee::create($data);
        $res = new EmployeeResource($employee);
        return $this->successResponse('Employee', $res, 200);
    }

    public function updateEmployee(EmployeeRequest $request, $id)
    {
        $data = $request->validated();

        $employee = Employee::findOrFail($id);

        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');

            if (!in_array($profile->getClientMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
                return $this->errorResponse("The file must be a valid image!", 401);
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
        $res = new EmployeeResource($employee);
        return $this->successResponse('Updated successfully', $res, 200);
    }

    public function destroy($id)
    {
        Employee::destroy($id);
        return $this->successResponse('deleted', [], 200);
    }
}

