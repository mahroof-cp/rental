<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Repositories\Enquiry\EnquiryRepositoryInterface as EnquiryRepository;
use App\Http\Requests\Admin\Enquiry\EnquiryDeleteRequest;
use App\Http\Requests\Admin\Enquiry\EnquiryListDataRequest;
use App\Http\Requests\Admin\Enquiry\EnquiryListRequest;
use App\Http\Requests\Admin\Enquiry\EnquiryViewRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function list(EnquiryListRequest $request)
    {

        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['name' => "Enquiries"]
        ];
        return view('admin.enquiry.listEnquiry', compact('breadcrumbs'));
    }

    public function table(EnquiryListDataRequest $request, EnquiryRepository $enquiryRepo)
    {
        $enquiries = $enquiryRepo->getForDatatable();
        $dataTableJSON = DataTables::of($enquiries)
            ->addIndexColumn()
            ->addColumn('action', function ($enquiry) use ($request) {
                $data['view_url'] = route('admin_enquiry_view', ['id' => $enquiry->id]);
                $data['delete_url'] = route('admin_enquiry_delete', ['id' => $enquiry->id]);
                return view('admin.elements.listAction', compact('data'));
            })
            ->make();
        return $dataTableJSON;
    }

    public function view(EnquiryViewRequest $request, EnquiryRepository $enquiryRepo)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_enquiry_list', 'name' => "Enquires"],
            ['name' => "View Enquiries"]
        ];
        $enquiry = $enquiryRepo->get($request->id);
        return view('admin.enquiry.viewEnquiry', compact('enquiry', 'breadcrumbs'));
    }

    public function delete(EnquiryDeleteRequest $request, EnquiryRepository $enquiryRepo)
    {
        if ($enquiryRepo->delete($request->id)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }
}
