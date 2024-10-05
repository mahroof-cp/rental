<?php

namespace App\Repositories\Services;

use App\Repositories\BaseRepository;
use App\Models\Service;
use App\Models\OfficeHour;
use App\Models\ServiceFacility;
use App\Models\ServicesItem;
use Illuminate\Database\Eloquent\Builder;

class ServicesRepository implements ServicesRepositoryInterface
{
    public function getForDatatable($data)
    {
        $services = Service::select(['id', 'name', 'status'])
            ->where(function (Builder $query) use ($data) {
                if ($data['status'] != "") {
                    $query->where('status', '=', $data['status']);
                }
            });
        return $services;
    }

    public function getForFacilityDatatable($data)
    {
        $services = ServiceFacility::select(['id', 'title_en', 'status'])
            ->where(function (Builder $query) use ($data) {
                if ($data['status'] != "") {
                    $query->where('status', '=', $data['status']);
                }
                if ($data['service_id'] != "") {
                    $query->where('service_id', '=', $data['service_id']);
                }
            });
        return $services;
    }

    public function servicesSlug()
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
        if ($services =  Service::create($input)) {
            return $services;
        }
        return false;
    }

    public function savehoursfacility(array $input)
    {
        if ($hours =  OfficeHours::create($input)) {
            return $hours;
        }
        return false;
    }

    public function savefacility(array $input)
    {
        if ($servicesfacility =  ServiceFacility::create($input)) {
            return $servicesfacility;
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
        return Service::find($id);
    }

    public function getfacility($id)
    {
        return ServiceFacility::find($id);
    }

    public function getServicesBySlug($slug)
    {
        return Service::where('slug', $slug)->first();
    }

    public function getItem($id)
    {
        return ServiceItem::find($id);
    }

    public function resetFile(string $id)
    {
        $Services = Service::find($id);
        $Services->image = '';
        return $Services->save();
    }

    public function update(array $input)
    {
        $services = Service::find($input['id']);
        unset($input['id']);
        if ($services->update($input)) {
            return $services;
        }
        return false;
    }

    public function updatefacility(array $input)
    {
        $facility = ServiceFacility::find($input['id']);
        unset($input['id']);
        if ($facility->update($input)) {
            return $facility;
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
        $services = Service::find($id);
        return $services->delete();
    }

    public function deletefacility(string $id)
    {
        $services = ServiceFacility::find($id);
        return $services->delete();
    }


    public function getSlug($id)
    {
        $banner =Service::find($id);
        return $banner->slug;
    }
}
