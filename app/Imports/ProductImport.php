<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Http\Requests\ProductRequest;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //TAMBAHKAN CODE INI
use Session;

// class ProductImport implements ToModel  // tanpa heading
class ProductImport implements ToModel, WithHeadingRow // USE CLASS YANG DIIMPORT
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Import excel tanpa heading kolom sumber
        // return new Product([
        //     'title' => $row[1],
        //     'slug' => Str::slug($row[1]),
        //     'type' => $row[2],
        //     'description' => $row[3],
        //     'price' => $row[4],
        //     'quantity' => $row[5],
        // ]);

        // Import excel dengan ada heading kolom sumber
        return new Product([
            'title' => $row['nama'],
            'slug' => Str::slug($row['nama']),
            'type' => $row['tipe'],
            'description' => $row['deskripsi'],
            'price' => $row['harga'],
            'quantity' => $row['jumlah'],
        ]);

    }
}
