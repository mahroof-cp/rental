<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Services\ServicesRepositoryInterface as ServicesRepository;
use App\Http\Requests\Admin\Services\ServicesSaveRequest;
use App\Http\Requests\Admin\Services\ServicesUpdateRequest;
use App\Http\Requests\Admin\Services\ServicesDeleteRequest;
use App\Http\Requests\Admin\Services\ServicesStatusUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Admin\Services\ServicesListRequest;
use App\Http\Requests\Admin\Services\ServicesListDataRequest;
use App\Http\Requests\Admin\Services\ServicesAddRequest;
use App\Http\Requests\Admin\Services\ServicesEditRequest;
use App\Http\Requests\Admin\Services\ServicesRemoveFileRequest;
use App\Http\Requests\Admin\Services\ServicesViewRequest;
use App\Http\Controllers\Admin\Includes\Service\Facility;

class ServicesController extends Controller
{

    use Facility;

    public function list(ServicesListRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['name' => "Services"]
        ];
        return view('admin.services.listServices', compact('breadcrumbs'));
    }

    public function table(ServicesListDataRequest $request, ServicesRepository $servicesRepo)
    {
        $services = $servicesRepo->getForDatatable($request->all());
        $dataTableJSON = DataTables::of($services)
            ->addIndexColumn()
            ->addColumn('status', function ($service) use ($request) {
                $data['url'] = $request->user()->can('services_update') ? route('admin_services_status') : "";
                $data['id'] = $service->id;
                $data['status'] = $service->status;
                return view('admin.elements.listStatus', compact('data'));
            })
            ->addColumn('action', function ($service) use ($request) {
                $data['view_url'] = route('admin_services_view', ['id' => $service->id]);
                $data['edit_url'] = route('admin_services_edit', ['id' => $service->id]);
                $data['delete_url'] = route('admin_services_delete', ['id' => $service->id]);
                return view('admin.elements.listAction', compact('data'));
            })
            ->make();
        return $dataTableJSON;
    }

    public function add(ServicesAddRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_services_list', 'name' => "Srevices", "permision" => "services_read"],
            ['name' => "Add Srevices"]
        ];
        return view('admin.services.addServices', compact('breadcrumbs'));
    }

    public function save(ServicesRepository $servicesRepo, ServicesSaveRequest $request)
    {
        $resultString  = $request->name;
        $slug = str_replace(' ','-', $resultString);
        $inputData = [
            'status' => $request->status,
            'name' => $request->name,
            'description' => $request->html,
            'slug' => $slug.'-'.'serveses',

        ];
        if ($request->hasFile('file')) {
            $filePath = 'services';
            $image = $request->file('file');
            $fileNames = Storage::disk('rentel')->putFile($filePath, $image);
            $inputData['image'] = $fileNames;
        }
        $services = $servicesRepo->save($inputData);

        return redirect()
            ->route('admin_services_list')
            ->with('success', 'services added successfully');
    }


    public function view(ServicesRepository $servicesRepo, ServicesViewRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_services_list', 'name' => "services", "permision" => "crud_read"],
            ['name' => "View Service"]
        ];
        $services = $servicesRepo->get($request->id);
        return view('admin.services.viewServices', compact('services', 'breadcrumbs'));
    }

    public function edit(ServicesRepository $servicesRepo, ServicesEditRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_services_list', 'name' => "Services", "permision" => "services_read"],
            ['name' => "Edit Services"]
        ];
        $services = $servicesRepo->get($request->id);
        return view('admin.services.editServices', compact('services', 'breadcrumbs'));
    }

    public function removeFile(ServicesRepository $servicesRepo, ServicesRemoveFileRequest $request)
    {
        if ($this->_removeFile($servicesRepo, $request->id, $request->field)) {
            $servicesRepo->resetFile($request->id, $request->field);
        }
        return redirect()
            ->route('admin_services_edit', ['id' => $request->id])
            ->with('success', 'Deleted successfully');
    }

    private function _removeFile($servicesRepo, $id, $file)
    {
        $services = $servicesRepo->get($id);
        if ($services->$file && Storage::disk('rentel')->delete($services->$file)) {
            return true;
        }
        return false;
    }

    public function update(ServicesRepository $servicesRepo, ServicesUpdateRequest $request)
    {
        $resultString  = $request->name;
        $slug = str_replace(' ','-', $resultString);
        $inputData = [
            'id'    =>  $request->id,
            'status' => $request->status,
            'name' => $request->name,
            'description' => $request->html,
            'slug' => $slug.'-'.'serveses',

        ];
        if ($request->hasFile('file')) {
            $filePath = 'services';
            $image = $request->file('file');
            $fileNames = Storage::disk('rentel')->putFile($filePath, $image);
            $inputData['image'] = $fileNames;
        }

        $servicesRepo->update($inputData);
        return redirect()
            ->route('admin_services_list')
            ->with('success', 'Services updated successfully');
    }

    public function status(BannerRepository $bannerRepo, BannerStatusUpdateRequest $request)
    {
        $data = [
            'id' => $request->id
        ];

        if ($bannerRepo->statusUpdate($data)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }

    public function delete(ServicesRepository $servicesRepo, ServiceDeleteRequest $request)
    {
        if ($servicesRepo->delete($request->id)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }
}
