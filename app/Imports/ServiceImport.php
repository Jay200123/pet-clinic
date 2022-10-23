<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Service;

class ServiceImport implements ToCollection,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){

            $service = new Service();

            $service->service_description = $row['description'];
            $service->service_cost = $row['cost'];
            $service->serv_img = $row['images'];

            $service->save();

        }
    }
}
