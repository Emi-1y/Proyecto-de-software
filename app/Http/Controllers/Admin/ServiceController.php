<?php

// Author: Emily Cardona Castañeda 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('service.admin_list_title');
        $viewData['subtitle'] = __('service.admin_list_subtitle');
        $viewData['services'] = Service::orderBy('id', 'desc')->get();

        return view('admin.service.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('service.create_title');
        $viewData['subtitle'] = __('service.create_subtitle');

        return view('admin.service.create')->with('viewData', $viewData);
    }

    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['features'] = json_encode(
            array_filter(array_map('trim', explode("\n", $data['features_text'] ?? '')))
        );
        unset($data['features_text']);

        Service::create($data);

        return redirect()->route('admin.service.index')->with('success', __('service.created_successfully'));
    }

    public function edit(Service $service): View
    {
        $viewData = [];
        $viewData['title'] = __('service.edit_title');
        $viewData['subtitle'] = __('service.edit_subtitle');
        $viewData['service'] = $service;

        return view('admin.service.edit')->with('viewData', $viewData);
    }

    public function update(UpdateServiceRequest $request, Service $service): RedirectResponse
    {
        $data = $request->validated();
        $data['features'] = json_encode(
            array_filter(array_map('trim', explode("\n", $data['features_text'] ?? '')))
        );
        unset($data['features_text']);

        $service->update($data);

        return redirect()->route('admin.service.index')->with('success', __('service.updated_successfully'));
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.service.index')->with('success', __('service.deleted_successfully'));
    }
}
