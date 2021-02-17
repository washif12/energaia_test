<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
               'product'=>'A',
               'quantity'=>'20',
                'ordered'=>'0'
            ],
            [
                'product'=>'B',
                'quantity'=>'20',
                 'ordered'=>'0'
             ],
             [
                'product'=>'D',
                'quantity'=>'20',
                 'ordered'=>'0'
             ],
             [
                 'product'=>'E',
                 'quantity'=>'20',
                  'ordered'=>'0'
              ],
              [
                'product'=>'F',
                'quantity'=>'20',
                 'ordered'=>'0'
             ],
             [
                 'product'=>'G',
                 'quantity'=>'20',
                  'ordered'=>'0'
              ]
        ];
  
        foreach ($products as $key => $value) {
            supplier::create($value);
        }
    }
}
