<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Http\Requests\CompanyRequest;

use App\Http\Traits\Api\ApiResponser;
use App\Http\Resources\CompanyResource;
use Intervention\Image\Drivers\Gd\Driver;

class CompanyApiController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $companies = Company::orderByDesc("id")->get();
        $res = CompanyResource::collection($companies);
        return $this->successResponse('Companies', $res, 200);
    }

    public function show($id)
    {
        $company = Company::find($id);
        $res = new CompanyResource($company);
        return $this->successResponse('Company', $res, 200);
    }

    public function store(CompanyRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');

            if (!in_array($logo->getClientMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
                return $this->errorResponse("The file must be a valid image!", 422);
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

        $company = Company::create($data);
        $res = new CompanyResource($company);
        return $this->successResponse('Company', $res, 200);
    }

    public function updateCompany(CompanyRequest $request, $id)
    {
        $data = $request->validated();

        $company = Company::findOrFail($id);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');

            if (!in_array($logo->getClientMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
                return $this->errorResponse("The file must be a valid image!", 422);
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
        $res = new CompanyResource($company);
        return $this->successResponse('Updated successfully', $res, 200);
    }

    public function destroy($id)
    {
        Company::destroy($id);
        return $this->successResponse('deleted', [], 200);
    }




}
