<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Session;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'title' => $row[1],
            'slug' => Str::slug($row[1]),
            'type' => $row[2],
            'description' => $row[3],
            'price' => $row[4],
            'quantity' => $row[5],
        ]);

    }
}
