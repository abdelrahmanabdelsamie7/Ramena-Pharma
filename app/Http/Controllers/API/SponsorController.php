<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\SponsorRequest;
use App\Models\Sponsor;
use App\traits\{ResponseJsonTrait,UploadFileTrait};
use App\Http\Controllers\Controller;

class SponsorController extends Controller
{
    use ResponseJsonTrait, UploadFileTrait;
    public function index()
    {
        $sponsors = Sponsor::all();
        return $this->sendSuccess('All Sponsors Retrieved Successfully!',  $sponsors);
    }
    public function show(string $id)
    {
        $sponsor = Sponsor::findOrFail($id);
        return $this->sendSuccess('Product Retrieved Successfully!', $sponsor);
    }
    public function store(SponsorRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadfile($request->file('logo'), 'sponsors');
        }
        $sponsor = Sponsor::create($data);
        return $this->sendSuccess('Sponsor Added Successfully', $sponsor, 201);
    }
    public function update(SponsorRequest $request, string $id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $this->deletefile($sponsor->logo);
            $data['logo'] = $this->uploadfile($request->file('logo'), 'sponsors');
        }
        $sponsor->update($data);
        return $this->sendSuccess('Sponsor Data Updated Successfully', $sponsor, 200);
    }
    public function destroy($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $this->deletefile($sponsor->logo);
        $sponsor->delete();
        return $this->sendSuccess('Sponsor Deleted Successfully');
    }
}