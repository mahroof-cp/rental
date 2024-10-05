<?php

namespace App\Repositories\Cms;

use App\Models\CmsCategory;
use App\Repositories\BaseRepository;
use App\Models\CmsPage;
use App\Models\CmsPageLocale;

class CmsRepository implements CmsRepositoryInterface
{
    public function getCmsData($slug)
    {
        $cms = CmsPage::where('slug', $slug)->first();
        return $cms;
    }

    public function getForDatatable($data)
    {
        return CmsPage::select([app(CmsPage::class)->getTable() . '.*']);
    }

    public function save(array $input)
    {
        if ($cms = CmsPage::create($input)) {
            return $cms;
        }
        return false;
    }

    public function get($id)
    {
        $cms = CmsPage::find($id);
        return $cms;
    }

    public function getAll()
    {
        return CmsPage::where('status', 1)->get();
    }

    public function resetFile(string $id, string $field)
    {
        $cms = CmsPage::find($id);
        $cms->$field = '';
        return $cms->save();
    }

    public function update(array $input)
    {
        $cms = CmsPage::find($input['id']);
        if (!$cms->is_deletable) {
            $cmsSlug = $cms->slug;
        }
        if ($cms->update($input)) {
            if (!$cms->is_deletable) {
                $cms->slug = $cmsSlug;
                $cms->save();
            }
            return $cms;
        }
        return false;
    }

    public function statusUpdate(array $input)
    {
        $cms = CmsPage::find($input['id']);
        $input['status'] = $cms->status ? 0 : 1;
        if ($cms->update($input)) {
            return $cms;
        }
        return false;
    }

    public function delete(string $id)
    {
        $cms = CmsPage::find($id);
        return $cms->delete();
    }

    public function searchCmsCategory($term, $not)
    {
        $category = CmsCategory::where('name', 'like', "%{$term}%");
        if ($not) {
            $category = $category->where('id', '!=', $not);
        }
        return $category->get();
    }
}