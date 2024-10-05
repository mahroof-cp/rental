<?php

namespace App\Http\Controllers\Admin\Includes\Service;

use App\Http\Requests\Admin\Services\Facility\FacilitySaveRequest;
use App\Http\Requests\Admin\Services\Facility\ServicesHoursSaveRequest;
use App\Http\Requests\Admin\Services\Facility\FacilityListDataRequest;
use App\Http\Requests\Admin\Services\Facility\FacilityEditRequest;
use App\Http\Requests\Admin\Services\Facility\FacilityUpdateRequest;
use App\Http\Requests\Admin\Services\Facility\FacilityViewRequest;
use App\Http\Requests\Admin\Services\Facility\FacilityDeleteRequest;
use App\Http\Requests\Admin\Services\Facility\FacilityAddRequest;
use App\Repositories\Services\ServicesRepositoryInterface as ServicesRepository;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;



trait Facility
{
    public function tablefacility(FacilityListDataRequest $request, ServicesRepository $servicesRepo)
    {
        $services = $servicesRepo->getForFacilityDatatable($request->all()); 
        $dataTableJSON = DataTables::of($services)
            ->addIndexColumn()
            ->addColumn('status', function ($service) use ($request) {
                $data['url'] = $request->user()->can('services_update') ? route('admin_services_status') : "";
                $data['id'] = $service->id;
                $data['status'] = $service->status;
                return view('admin.elements.listStatus', compact('data'));
            })
            ->addColumn('action', function ($service) use ($request) {
                $data['view_url'] = $request->user()->can('service_read') ? route('admin_facility_viewfacility', ['id' => $service->id]) : "";
                $data['edit_url'] = $request->user()->can('service_update') ? route('admin_facility_editfacility', ['id' => $service->id]) : "";
                $data['delete_url'] = $request->user()->can('services_delete') ? route('admin_facility_deletefacility', ['id' => $service->id]) : "";
                return view('admin.elements.listAction', compact('data'));
            })
            ->make();
        return $dataTableJSON;
    }

    public function savefacility(ServicesRepository $servicesRepo, FacilitySaveRequest $request)
    {

        $inputData = [
            'status' => $request->status,
            'title' => $request->title,
            'description' => $request->html,
            'icon' => $request->icon,
            'service_id' => $request->services_id,
            
        ];
        $services = $servicesRepo->savefacility($inputData);
       
        return redirect()
            ->route('admin_services_view')
            ->with('success', 'services added successfully');
    }

    public function editfacility(ServicesRepository $servicesRepo, FacilityEditRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_facility_editfacility', 'name' => "Facility", "permision" => "services_read"],
            ['name' => "Edit Facility"]
        ];
        $facility = $servicesRepo->getfacility($request->id);
        return view('admin.services.facility.editFacility', compact('facility', 'breadcrumbs'));
    }

    public function updatefacility(ServicesRepository $servicesRepo,Request $request)
    {
        
        $inputData = [
            'id'    =>  $request->id,
            'status' => $request->status,
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->html,
            'service' => $request->service_id,
            
        ];
        $servicesRepo->updatefacility($inputData);
        return redirect()
        ->route('admin_services_view')
        ->with('success', 'services added successfully');
    }

    public function viewfacility(ServicesRepository $servicesRepo, FacilityViewRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_services_list', 'name' => "services", "permision" => "crud_read"],
            ['name' => "View Facility"]
        ];
        $facility = $servicesRepo->getfacility($request->id);
        return view('admin.services.facility.viewFacility', compact('facility', 'breadcrumbs'));
    }

    public function deletefacility(ServicesRepository $servicesRepo, FacilityDeleteRequest $request)
    {
        if ($servicesRepo->deletefacility($request->id)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }

    public function addfacility(ServicesRepository $servicesRepo, FacilityAddRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_services_list', 'name' => "Srevices", "permision" => "services_read"],
            ['name' => "Add Srevices"]
        ]; 
        $services = $servicesRepo->get($request->id);
        dd($services);
        return view('admin.services.facility.addFacility', compact('services','breadcrumbs'));
    }

    public function savehoursfacility(ServicesRepository $servicesRepo, ServicesHoursSaveRequest $request)
    {

        $inputData = [
            'mon' => $request->mon,
            'tus' => $request->tus,
            'wed' => $request->wed,
            'thur' => $request->thur,
            'fri' => $request->fri,
            'sat' => $request->sat,
            'sun' => $request->sun,
        ];
        $services = $servicesRepo->savefacilityhours($inputData);
       
        return redirect()
            ->route('admin_services_view')
            ->with('success', 'services added successfully');
    }
}