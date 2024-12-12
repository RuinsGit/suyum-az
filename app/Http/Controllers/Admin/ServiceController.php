<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(10);
        return view('back.pages.service.index', compact('services'));
    }

    public function create()
    {
        return view('back.pages.service.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $data = $request->all();
        $data['status'] = 1;

        $data['description_az'] = $request->description_az;
        $data['description_en'] = $request->description_en;
        $data['description_ru'] = $request->description_ru;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = public_path('uploads/services');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/services/' . $fileName;
        }

        Service::create($data);

        return redirect()->route('pages.service.index')
            ->with('success', 'Xidmət uğurla əlavə edildi.');
    }

    public function edit(Service $service)
    {
        return view('back.pages.service.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $data = $request->all();
        $data['status'] = 1;

        $data['description_az'] = $request->description_az;
        $data['description_en'] = $request->description_en;
        $data['description_ru'] = $request->description_ru;

        if ($request->hasFile('image')) {
            if ($service->image && File::exists(public_path($service->image))) {
                File::delete(public_path($service->image));
            }

            $file = $request->file('image');
            $destinationPath = public_path('uploads/services');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/services/' . $fileName;
        }

        $service->update($data);

        return redirect()->route('pages.service.index')
            ->with('success', 'Xidmət uğurla yeniləndi.');
    }

    public function destroy(Service $service)
    {
        if ($service->image && File::exists(public_path($service->image))) {
            File::delete(public_path($service->image));
        }

        $service->delete();

        return redirect()->route('pages.service.index')
            ->with('success', 'Xidmət uğurla silindi.');
    }

    public function toggleStatus(Service $service)
    {
        $service->status = !$service->status;
        $service->save();
        
        return redirect()->back()->with('success', 'Status uğurla dəyişdirildi');
    }
}