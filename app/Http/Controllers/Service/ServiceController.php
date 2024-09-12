<?php

namespace App\Http\Controllers\Service;

use App\Http\Requests\ServiceStoreRequest;
use App\Models\District;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceImage;
use App\Models\Thana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use DateTime;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->type == 'admin') {
            $services = Service::get();
        } else {
            $services = Service::where('user_id', auth()->user()->id)->get();
        }

        if ($request->ajax()) {
            return DataTables::of($services)->addIndexColumn()
                ->addColumn('action', function ($service) {
                    $is_approve = '';
                    if ($service->is_approved == 'pending') {
                        $is_approve = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
        </svg>';
                    } else {
                        $is_approve = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
</svg>';
                    }
                    $button = '';
                    $button .= '<a href="' . route("service.edit", $service->id) . '" class="btn btn-sm btn-primary "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                      </svg></a>';
                    $button .= '<a href="" data-id=' . $service->id . ' style="margin-left: 5px" class="btn btn-sm btn-danger service-delete"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
</svg></a>';
                    if (auth()->user()->type == 'admin') {
                        $button .= '<form action=' . route('service-approve', $service->id) . ' method="POST" style="display:inline;">
    ' . csrf_field() . '
    ' . method_field('PATCH') . '
    <button type="submit" class="btn btn-sm btn-info">
       ' . $is_approve . '
    </button>
</form>
';
                    }
                    return $button;
                })
                ->make(true);
        }
        return view("service.index", compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategory::all();
        $districts = District::all();
        return view('service.create', compact('categories', 'districts'));
    }

    public function approve_service($id)
    {
        $service = Service::findOrFail($id);
        if ($service->is_approved == 'approved') {
            $service->update([
                'is_approved' => 'pending',
            ]);
        } else {
            $service->update([
                'is_approved' => 'approved',
            ]);
        }
        return redirect()->route('service');
    }

    public function store(ServiceStoreRequest $request)
    {
        $request['user_id'] = auth()->id();
        if ($request->status === 'busy') {
            $request['start_date'] = DateTime::createFromFormat('d-M-Y', $request->start_date)->format('Y-m-d');
        } else {
            $request['start_date'] = now()->format('Y-m-d');
        }
        //create service
        $service = Service::create($request->except(['_token', 'images', 'district_id', 'thana_id']));

        //insert service image
        foreach ($request->file('images') as $file) {
            $path = $file->store('service', 'public');
            $service->images()->create([
                'url' => $path
            ]);
        }

        //insert service areas
        foreach ($request->thana_id as $thanaId) {
            $service->thana()->attach($thanaId);
        }
        return redirect()->route('service');
    }

    public function edit($id)
    {
        $service = Service::with('images')->findOrFail($id);
        $categories = ServiceCategory::all();
        $districts = District::all();
        return view('service.edit', compact('service', 'categories', 'districts'));
    }

    public function update(ServiceStoreRequest $request, $id)
    {
        $request['user_id'] = auth()->id();
        if ($request->status === 'busy') {
            $request['start_date'] = DateTime::createFromFormat('d-M-Y', $request->start_date)->format('Y-m-d');
        } else {
            $request['start_date'] = now()->format('Y-m-d');
        }
        //create service
        $service = Service::with('images')->findOrFail($id);
        if ($request->hasFile('images')) {
            $service->images()->delete();
            foreach ($request->file('images') as $image) {
                $path = $image->store('service', 'public');
                $service->images()->create([
                    'url' => $path
                ]);
            }
        }
        $service->update($request->except(['_token', 'images', 'district_id', 'thana_id']));
        $service->thana()->sync($request->thana_id);
        return redirect()->route('service');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        return $service->delete();
    }
}
