<?php

namespace App\Services;

use App\Models\Products;
use App\Models\Warehouses;
use Illuminate\Http\Request;

class getInfoService
{
    protected $warehouses = [];
    protected $flashWarehouse = [];

    public function info(Request $request)
    {
        $result = [];
        $wareHouses = Warehouses::with('material')->get();
        foreach ($request->validated()['product'] as $code => $product_count){
            $flash = [];
            $product = Products::where('code', $code)->with('product_material')->first();
            $flash['product_name'] = $product->name;
            $flash['product_qty'] = $product_count;

            foreach ($product->product_material as $key=>$product_material) {
                $this->flashWarehouse[$product_material->material->id] = 0;
                $last = count($wareHouses);
                foreach ($wareHouses as $keyH=>$wareHouse) {
                    if($wareHouse->material->id==$product_material->material->id) {

                        $qty = (int) ($product_material->quantity * $product_count < $wareHouse->remainder ? $product_material->quantity * $product_count : $wareHouse->remainder) - $this->flashWarehouse[$wareHouse->material->id];

                        $flash['product_materials'][$key][] = [
                            'warehouse_id'  => $wareHouse->id,
                            'material_name' => $product_material->material->name,
                            'qty'           => $qty,
                            'price' => $wareHouse->price,
                        ];

                        $this->flashWarehouse[$wareHouse->material->id] = $qty;

                        if( $keyH==$last-1 ) {
                            if(($needQty = $product_material->quantity * $product_count - $this->flashWarehouse[$wareHouse->material->id])!==0){
                                $flash['product_materials'][$key][]=[
                                    'warehouse_id'  => null,
                                    'material_name' => $product_material->material->name,
                                    'qty'           => $needQty,
                                    'price' => $wareHouse->price,
                                ];
                            }
                        }

                        if($qty==$wareHouse->remainder){
                            unset($wareHouses[$keyH]);
                        }else{
                            $wareHouse->remainder = $wareHouse->remainder - $this->flashWarehouse[$wareHouse->material->id];
                        }
                    }
                }
            }

            $result[]=$flash;
        }
        return $result;
    }
}
