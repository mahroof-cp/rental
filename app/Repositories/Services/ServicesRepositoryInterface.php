<?php

namespace App\Repositories\Services;

interface ServicesRepositoryInterface
{
    public function getForDatatable($data);

    public function servicesSlug();

    public function save(array $input);

    public function saveFile(array $input);

    public function get($id);

    public function getServicesBySlug($slug);

    public function getItem($id);

    public function resetFile(string $id);

    public function update(array $input);

    public function updateFile(array $input);

    public function updateSlug(array $input);

    public function statusUpdate(array $input);

    public function delete(string $id);

    public function getSlug($id);

    public function getfacility($id);

    public function updatefacility(array $input);

    public function deletefacility(string $id);
}