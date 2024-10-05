<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Banner\BannerRepositoryInterface as BannerRepository;
use App\Http\Requests\Admin\Banner\BannerSaveRequest;
use App\Http\Requests\Admin\Banner\BannerUpdateRequest;
use App\Http\Requests\Admin\Banner\BannerDeleteRequest;
use App\Http\Requests\Admin\Banner\BannerStatusUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Admin\Banner\BannerListRequest;
use App\Http\Requests\Admin\Banner\BannerListDataRequest;
use App\Http\Requests\Admin\Banner\BannerAddRequest;
use App\Http\Requests\Admin\Banner\BannerEditRequest;
use App\Http\Requests\Admin\Banner\BannerRemoveFileRequest;
use App\Http\Requests\Admin\Banner\BannerViewRequest;

class BannerController extends Controller
{
    public function list(BannerListRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['name' => "Banner"]
        ];
        return view('admin.banner.listBanner', compact('breadcrumbs'));
    }

    public function table(BannerListDataRequest $request, BannerRepository $bannerRepo)
    {
        $banners = $bannerRepo->getForDatatable($request->all());
        $dataTableJSON = DataTables::of($banners)
            ->addIndexColumn()
            ->addColumn('status', function ($banner) use ($request) {
                $data['url'] = route('admin_banner_status');
                $data['id'] = $banner->id;
                $data['status'] = $banner->status;
                return view('admin.elements.listStatus', compact('data'));
            })
            ->addColumn('action', function ($banner) use ($request) {
                $data['view_url'] = route('admin_banner_view', ['id' => $banner->id]);
                $data['edit_url'] = route('admin_banner_edit', ['id' => $banner->id]);
                $data['delete_url'] = route('admin_banner_delete', ['id' => $banner->id]);
                return view('admin.elements.listAction', compact('data'));
            })
            ->make();
        return $dataTableJSON;
    }

    public function add(BannerAddRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_banner_list', 'name' => "Banner"],
            ['name' => "Add Banner"]
        ];
        return view('admin.banner.addBanner', compact('breadcrumbs'));
    }

    public function save(BannerRepository $bannerRepo, BannerSaveRequest $request)
    {
        $inputData = [
            'status' => 1,
            'name' => $request->name,
        ];
        $banner = $bannerRepo->save($inputData);

        if ($request->hasFile('file')) {
            $fileNames = array();
            $filePath = 'banner';
            foreach ($request->file('file') as $image) {
                $fileNames[] = Storage::disk('rentel')->putFile($filePath, $image);
            }
            if (count($fileNames) == 1) {
                $inputData = [
                    'id' => $banner->id,
                    'file' => $fileNames[0],
                ];
                $bannerRepo->update($inputData);
            } else {
                foreach ($fileNames as $file) {
                    $inputData = [
                        'banner_id' => $banner->id,
                        'file' => $file,
                    ];
                    $bannerRepo->saveFile($inputData);
                }
                $bannerRepo->update(['id' => $banner->id, 'multiple' => 1]);
            }
        }
        return redirect()
            ->route('admin_banner_edit', ['id' => $banner->id])
            ->with('success', 'File deleted successfully');
        return redirect()
            ->route('admin_banner_list')
            ->with('success', 'Banner added successfully');
    }

    public function view(BannerRepository $bannerRepo, BannerViewRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_banner_list', 'name' => "Banner"],
            ['name' => "View Banner"]
        ];
        $banner = $bannerRepo->get($request->id);
        return view('admin.banner.viewBanner', compact('banner', 'breadcrumbs'));
    }

    public function edit(BannerRepository $bannerRepo, BannerEditRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'admin_dashboard', 'name' => "Dashboard"],
            ['link' => 'admin_banner_list', 'name' => "Banner"],
            ['name' => "Edit Banner"]
        ];
        $banner = $bannerRepo->get($request->id);
        return view('admin.banner.editBanner', compact('banner', 'breadcrumbs'));
    }

    public function removeFile(BannerRepository $bannerRepo, BannerRemoveFileRequest $request)
    {
        $banner = $bannerRepo->get($request->id);
        if ($banner->multiple && $request->has('item_id')) {
            if ($this->_removeBannerFile($bannerRepo, $request->item_id)) {
                $bannerRepo->removeBannerItem($request->item_id);
            }
        } else {
            if ($this->_removeFile($bannerRepo, $request->id)) {
                $bannerRepo->resetFile($request->id);
            }
        }
        return redirect()
            ->route('admin_banner_edit', ['id' => $request->id])
            ->with('success', 'File deleted successfully');
    }

    private function _removeBannerFile($bannerRepo, $itemId)
    {
        $bannerItem = $bannerRepo->getItem($itemId);
        if (Storage::disk('rentel')->delete($bannerItem->file)) {
            return true;
        }
        return false;
    }

    private function _removeFile($bannerRepo, $id)
    {
        $banner = $bannerRepo->get($id);
        if (Storage::disk('rentel')->delete($banner->file)) {
            return true;
        }
        return false;
    }

    public function update(BannerRepository $bannerRepo, BannerUpdateRequest $request)
    {
        $banner = $bannerRepo->get($request->id);
        $inputData = [
            'id' => $request->id,
            'status' => $request->status,
            'name' => $request->name,
        ];
        $bannerRepo->update($inputData);
        $fileNames = [];
        if ($request->hasFile('file')) {
            $filePath = 'banner';
            foreach ($request->file('file') as $image) {
                $fileName = Storage::disk('rentel')->putFile($filePath, $image);
                $inputData = [
                    'banner_id' => $banner->id,
                    'file' => $fileName,
                ];
                $bannerRepo->saveFile($inputData);
            }
        }
        $inputData = [
            'id' => $banner->id,
            'multiple' => ($banner->items->count() > 1) ? 1 : 0,
        ];
        $bannerRepo->update($inputData);
        if ($request->has('title')) {
            foreach ($request->title as $bannerItemid => $title) {
                $bannerItemData = [
                    'id' => $bannerItemid,
                    'title' => $title,
                    'description' => $request->description[$bannerItemid],
                    // 'link' => $request->link[$bannerItemid]
                ];
                $bannerRepo->updateFile($bannerItemData);
            }
        }
        if (!$banner->is_deletable) {
            $inputData = [
                'id' => $request->id,
                'slug' => $banner->slug,
            ];
            $bannerRepo->updateSlug($inputData);
        }
        return redirect()
            ->route('admin_banner_edit', ['id' => $request->id])
            ->with('success', 'File deleted successfully');
        return redirect()
            ->route('admin_banner_list')
            ->with('success', 'Banner updated successfully');
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

    public function delete(BannerRepository $bannerRepo, BannerDeleteRequest $request)
    {
        if ($bannerRepo->delete($request->id)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }
}
