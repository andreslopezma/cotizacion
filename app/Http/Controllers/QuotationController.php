<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductsQuotations;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $quotations = Quotation::all();
            return [
                'data' => $quotations->map(function ($quotation) {
                    return [
                        'id' => $quotation->id,
                        'date_quotation' => $quotation->date_quotation,
                        'value_total' => array_sum($quotation->products->map(function ($product) {
                            return $product->pivot->value_total;
                        })->toArray()),
                        'client' => $quotation->user->name
                    ];
                }),
                'process' => true,
            ];
        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage(),
                'process' => true
            ];
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            // Validate the params sent
            $validate = Validator::make(
                $request->all(),
                [
                    'name' => 'required|nullable',
                    'lastname' => 'required|nullable',
                    'address' => 'required|nullable',
                    'date_quotation' => 'required|nullable|date',
                    'products' => 'required|nullable'
                ]
            );

            if ($validate->fails()) {
                throw new \Exception($validate->errors()->first());
            }

            // save the user
            $user = User::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'address' => $request->address
            ]);


            $quotation = Quotation::create([
                'date_quotation' => $request->date_quotation,
                'user_id' => $user->id
            ]);

            foreach ($request->products as $product) {
                // get the product
                $objProduct = Product::find($product['product_id']);
                if (!$objProduct) {
                    throw new \Exception('El producto no existe');
                }

                // save the table pivot between Quotation and Product
                ProductsQuotations::create([
                    'product_id' => $objProduct->id,
                    'quotation_id' => $quotation->id,
                    'quantity' => $product['quantity'],
                    'value_total' => $objProduct->product_price * $product['quantity'],
                    'value_unit' => $objProduct->product_price
                ]);
            }

            // save the quotation
            $quotation->save();

            DB::commit();
            return response()->json([
                'process' => true,
                'message' => 'Se creo con exito la cotizacion'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'process' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
