<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Customer;
use App\Models\Pet;

class PetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {

        foreach($rows as $row){

            try{
                $customer = Customer::where('fname', $row['owner'])->firstOrFail();
            }
            catch(ModelNotFoundException $ex){

                $customer = new Customer();
                $customer->fname = $row['owner'];
                $customer->save();
            }

            $pet = new Pet();
            $pet->description = $row['description'];
            $pet->pet_name = $row['name'];
            $pet->breed = $row['breed'];
            $pet->age = $row['age'];
            $pet->gender = $row['gender'];
            $pet->pet_img = $row['images'];
            $pet->customer_id = $customer->id;

            $pet->customer()->associate($customer);
            $pet->save();
        }
    }
}
