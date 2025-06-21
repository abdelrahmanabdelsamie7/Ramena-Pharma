<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\PharmacyRequest;
use App\Models\Pharmacy;
use App\traits\{ResponseJsonTrait,UploadFileTrait};
use App\Http\Controllers\Controller;

class PharmacyController extends Controller
{
    use ResponseJsonTrait, UploadFileTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $pharmacies = Pharmacy::all();
        return $this->sendSuccess('All Pharmacies Retrieved Successfully!',  $pharmacies);
    }
    public function show(string $id)
    {
        $pharmacy = Pharmacy::with('products')->findOrFail($id);
        return $this->sendSuccess('Product Retrieved Successfully!', $pharmacy);
    }
    public function store(PharmacyRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadfile($request->file('logo'), 'pharmacies');
        }
        $pharmacy = Pharmacy::create($data);
        return $this->sendSuccess('Pharmacy Added Successfully', $pharmacy, 201);
    }
    public function update(PharmacyRequest $request, string $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $this->deletefile($pharmacy->logo);
            $data['logo'] = $this->uploadfile($request->file('logo'), 'pharmacies');
        }
        $pharmacy->update($data);
        return $this->sendSuccess('Pharmacy Data Updated Successfully', $pharmacy, 200);
    }
    public function destroy($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $this->deletefile($pharmacy->logo);
        $pharmacy->delete();
        return $this->sendSuccess('Pharmacy Deleted Successfully');
    }
}
