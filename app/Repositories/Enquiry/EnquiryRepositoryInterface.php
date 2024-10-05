<?php

namespace App\Repositories\Enquiry;

interface EnquiryRepositoryInterface
{
    public function getForDatatable();

    public function save($inputData);

    public function get(string $id);

    public function delete(string $id);
}
