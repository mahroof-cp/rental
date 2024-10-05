<?php

namespace App\Repositories\Cms;

interface CmsRepositoryInterface
{
    public function getCmsData($slug);

    public function getForDatatable($data);

    public function save(array $input);

    public function get($id);

    public function getAll();

    public function resetFile(string $id, string $field);

    public function update(array $input);

    public function statusUpdate(array $input);

    public function delete(string $id);

    public function searchCmsCategory($term, $not);
}