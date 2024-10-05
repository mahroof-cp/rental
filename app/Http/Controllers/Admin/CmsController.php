<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Cms\CmsRepositoryInterface as CmsRepository;
use App\Http\Requests\Admin\Cms\CmsAddRequest;
use App\Http\Requests\Admin\Cms\CmsSaveRequest;
use App\Http\Requests\Admin\Cms\CmsUpdateRequest;
use App\Http\Requests\Admin\Cms\CmsDeleteRequest;
use App\Http\Requests\Admin\Cms\CmsEditRequest;
use App\Http\Requests\Admin\Cms\CmsListDataRequest;
use App\Http\Requests\Admin\Cms\CmsListRequest;
use App\Http\Requests\Admin\Cms\CmsRemoveFileRequest;
use App\Http\Requests\Admin\Cms\CmsStatusUpdateRequest;
use App\Http\Requests\Admin\Cms\CmsViewRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class CmsController extends Controller
{

    public function list(CmsListRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['name' => "Cms Contents"]
        ];
        return view('admin.cms.listCms', compact('breadcrumbs'));
    }

    public function table(CmsListDataRequest $request, CmsRepository $cmsRepo)
    {
        $cmspages = $cmsRepo->getForDatatable($request->all());
        $dataTableJSON = DataTables::of($cmspages)
            ->addIndexColumn()
            ->addColumn('status', function ($cms) use ($request) {
                $data['url'] = $request->user()->can('cms_update') ? route('admin_cms_status') : "";
                $data['id'] = $cms->id;
                $data['status'] = $cms->status;
                return view('admin.elements.listStatus', compact('data'));
            })
            ->addColumn('action', function ($cms) use ($request) {
                $data['view_url'] = route('admin_cms_view', ['id' => $cms->id]);
                $data['edit_url'] = route('admin_cms_edit', ['id' => $cms->id]);
                $data['delete_url'] = route('admin_cms_delete', ['id' => $cms->id]);
                return view('admin.elements.listAction', compact('data'));
            })
            ->make(true);
        return $dataTableJSON;
    }

    public function add(CmsAddRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_cms_list', 'name' => "Cms Contents"],
            ['name' => "Add Cms"]
        ];
        return view('admin.cms.addCms', compact('breadcrumbs'));
    }

    public function save(CmsRepository $cmsRepo, CmsSaveRequest $request)
    {
        $inputData = [
            'cms_category_id' => $request->cms_category_id,
            'name' => $request->name,
            'title' => $request->title,
            'html' => $request->html,
        ];
        if ($request->hasFile('file')) {
            $filePath = 'cms';
            $fileName = Storage::disk('rentel')->putFile($filePath, $request->file('file'));
            $inputData['file'] = $fileName;
        }
        if ($request->hasFile('thumbnail')) {
            $filePath = 'cms';
            $fileName = Storage::disk('rentel')->putFile($filePath, $request->file('thumbnail'));
            $inputData['thumbnail'] = $fileName;
        }
        $cmsRepo->save($inputData);
        return redirect()
            ->route('admin_cms_list')
            ->with('success', 'Cms added successfully');
    }

    public function edit(CmsRepository $cmsRepo, CmsEditRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_cms_list', 'name' => "Cms Contents"],
            ['name' => "Edit Cms"]
        ];

        $cms = $cmsRepo->get($request->id);
        return view('admin.cms.editCms', compact('cms', 'breadcrumbs'));
    }

    public function removeFile(CmsRepository $cmsRepo, CmsRemoveFileRequest $request)
    {
        if ($this->_removeFile($cmsRepo, $request->id, $request->field)) {
            $cmsRepo->resetFile($request->id, $request->field);
        }
        return redirect()
            ->route('admin_cms_edit', ['id' => $request->id])
            ->with('success', 'Deleted successfully');
    }

    private function _removeFile($cmsRepo, $id, $file)
    {
        $cms = $cmsRepo->get($id);
        if ($cms->$file && Storage::disk('rentel')->delete($cms->$file)) {
            return true;
        }
        return false;
    }

    public function update(CmsRepository $cmsRepo, CmsUpdateRequest $request)
    {
        $cms = $cmsRepo->get($request->id);
        $inputData = [
            'id' => $request->id,
            'status' => !$cms->is_editable ? 1 : $request->status,
            'cms_category_id' => $request->cms_category_id,
            'name' => $request->name,
            'title' => $request->title,
            'html' => $request->html,
        ];
        if ($request->hasFile('file')) {
            $this->_removeFile($cmsRepo, $request->id, 'file');
            $filePath = 'cms';
            $fileName = Storage::disk('rentel')->putFile($filePath, $request->file('file'));
            $inputData['file'] = $fileName;
        }
        if ($request->hasFile('thumbnail')) {
            $this->_removeFile($cmsRepo, $request->id, 'thumbnail');
            $filePath = 'cms';
            $fileName = Storage::disk('rentel')->putFile($filePath, $request->file('thumbnail'));
            $inputData['thumbnail'] = $fileName;
        }
        $cmsRepo->update($inputData);
        if (!$cms->is_deletable) {
            $inputData = [
                'id' => $request->id,
                'slug' => $cms->slug,
            ];
            $cmsRepo->update($inputData);
        }
        return redirect()->route('admin_cms_list')->with('success', 'Data Updated successfully');
    }

    public function status(CmsRepository $cmsRepo, CmsStatusUpdateRequest $request)
    {
        $data = [
            'id' => $request->id
        ];

        if ($cmsRepo->statusUpdate($data)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }

    public function delete(CmsRepository $cmsRepo, CmsDeleteRequest $request)
    {
        if ($cmsRepo->delete($request->id)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }
}
