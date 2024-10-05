<?php

namespace App\Repositories\Banner;

interface BannerRepositoryInterface
{
    public function getForDatatable($data);

    public function bannerSlug();

    public function save(array $input);

    public function saveFile(array $input);

    public function get($id);

    public function getBannerBySlug($slug);

    public function getItem($id);

    public function resetFile(string $id);

    public function update(array $input);

    public function updateFile(array $input);

    public function updateSlug(array $input);

    public function statusUpdate(array $input);

    public function delete(string $id);

    public function removeBannerItem(string $itemId);

    public function deleteItems(string $bannerId);

    public function getSlug($id);
}