<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AppCore\Application\UseCases\RegisterProductUseCase;

class ProductController extends Controller
{
    /**
     * display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.Register');
    }

    /**
     * store a newly created resource in storage.
     */
    public function store(Request $request, RegisterProductUseCase $registerProductUseCase)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
            ], [
                'name.required' => 'Name is require',
                'price.required' => 'Price is required',
                'price.numeric' => 'Price must be a number',
                'stock.required' => 'Stock is required',
                'stock.integer' => 'Stock must be an integer',
            ]);

            $registerProductUseCase->execute($request->all());

            return redirect()->route('products.index')
                ->with('success', "Product created successfully!");
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\InvalidArgumentException $e) {
            // domain's exceptions are handled here
            return redirect()->back()
                ->withErrors(['general' => $e->getMessage()])
                ->withInput();
        } catch (\Exception $e) {
            // this is a generic exception
            return redirect()->back()
                ->withErrors(['general' => $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
