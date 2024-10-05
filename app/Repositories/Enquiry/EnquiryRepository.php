<?php

namespace App\Repositories\Enquiry;

use App\Repositories\BaseRepository;
use App\Models\Enquiry;

class EnquiryRepository implements EnquiryRepositoryInterface
{

    public function getForDatatable()
    {
        return Enquiry::select(['*']);
    }

    public function save($inputData)
    {
        $enquiry = new Enquiry();
        $enquiry->first_name = $inputData['first_name'];
        $enquiry->last_name = $inputData['last_name'];
        $enquiry->email = $inputData['email'];
        $enquiry->phone = $inputData['phone'];
        $enquiry->message = $inputData['message'];
        if ($enquiry->save()) {
            return $enquiry;
        }
        return false;
    }

    public function get($id)
    {
        return Enquiry::find($id);
    }

    public function delete(string $id)
    {
        $enquiry = Enquiry::find($id);
        return $enquiry->delete();
    }
}