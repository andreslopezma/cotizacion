<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductsQuotations;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;
use function PHPUnit\Framework\throwException;

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
                        'date_quotation' => $quotation->date_quotation,
                        'quantity' => $quotation->quantity,
                        'value_total' => $quotation->value_total,
                        'value_unit' => $quotation->value_unit,
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
                    'product_id' => 'required|nullable|numeric',
                    'quantity' => 'required|nullable|numeric'
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

            // get the product
            $product = Product::find($request->product_id);
            if (!$product) {
                throw new \Exception('El producto no existe');
            }

            // save the quotation
            $quotation = Quotation::create([
                'date_quotation' => $request->date_quotation,
                'quantity' => $request->quantity,
                'user_id' => $user->id,
                'value_total' => $product->product_price * $request->quantity,
                'value_unit' => $product->product_price
            ]);


            // save the table pivot between Quotation and Product
            ProductsQuotations::create([
                'product_id' => $product->id,
                'quotation_id' => $quotation->id
            ]);

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
