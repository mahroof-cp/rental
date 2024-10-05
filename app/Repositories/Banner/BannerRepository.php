<?php

namespace App\Repositories\Banner;

use App\Repositories\BaseRepository;
use App\Models\Banner;
use App\Models\BannerItem;
use Illuminate\Database\Eloquent\Builder;

class BannerRepository implements BannerRepositoryInterface
{
    public function getForDatatable($data)
    {
        $banner = Banner::select(['id', 'name', 'status'])
            ->where(function (Builder $query) use ($data) {
                if ($data['status'] != "") {
                    $query->where('status', '=', $data['status']);
                }
            });
        return $banner;
    }

    public function bannerSlug()
    {
        $banner_id = Banner::max('id');
        if ($banner_id == null) {
            return 0;
        } else {
            $banner_data = Banner::find($banner_id);
            return $banner_data->slug;
        }
    }

    public function save(array $input)
    {
        if ($banner =  Banner::create($input)) {
            return $banner;
        }
        return false;
    }

    public function saveFile(array $input)
    {
        if ($bannerItem =  BannerItem::create($input)) {
            return $bannerItem;
        }
        return false;
    }

    public function get($id)
    {
        return Banner::find($id);
    }

    public function getBannerBySlug($slug)
    {
        return Banner::where('slug', $slug)->first();
    }

    public function getItem($id)
    {
        return BannerItem::find($id);
    }

    public function resetFile(string $id)
    {
        $banner = Banner::find($id);
        $banner->file = '';
        return $banner->save();
    }

    public function update(array $input)
    {
        $banner = Banner::find($input['id']);
        if (!$banner->is_deletable) {
            $bannerSlug = $banner->slug;
        }
        unset($input['id']);
        if ($banner->update($input)) {
            if (!$banner->is_deletable) {
                $banner->slug = $bannerSlug;
                $banner->save();
            }
            return $banner;
        }
        return false;
    }

    public function updateFile(array $input)
    {
        $bannerItem = BannerItem::find($input['id']);
        if ($bannerItem->update($input)) {
            return $bannerItem;
        }
        return false;
    }

    public function updateSlug(array $input)
    {
        $banner = Banner::find($input['id']);
        $banner->slug = $input['slug'];
        $banner->save();
        return $banner;
    }

    public function statusUpdate(array $input)
    {
        $banner = Banner::find($input['id']);
        $input['status'] = $banner->status ? 0 : 1;
        if ($banner->update($input)) {
            return $banner;
        }
        return false;
    }

    public function delete(string $id)
    {
        $banner = Banner::find($id);
        return $banner->delete();
    }

    public function removeBannerItem(string $itemId)
    {
        $bannerItem = BannerItem::find($itemId);
        return $bannerItem->forceDelete();
    }

    public function deleteItems(string $bannerId)
    {
        return BannerItem::where('banner_id', $bannerId)->forceDelete();
    }

    public function getSlug($id)
    {
        $banner = Banner::find($id);
        return $banner->slug;
    }
}