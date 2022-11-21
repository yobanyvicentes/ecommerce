<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use Illuminate\Http\Request;

/**
 * Class OrderProductController
 * @package App\Http\Controllers
 */
class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderProducts = OrderProduct::paginate();

        return view('order-product.index', compact('orderProducts'))
            ->with('i', (request()->input('page', 1) - 1) * $orderProducts->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orderProduct = new OrderProduct();
        return view('order-product.create', compact('orderProduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(OrderProduct::$rules);

        $orderProduct = OrderProduct::create($request->all());

        return redirect()->route('order-products.index')
            ->with('success', 'OrderProduct created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderProduct = OrderProduct::find($id);

        return view('order-product.show', compact('orderProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderProduct = OrderProduct::find($id);

        return view('order-product.edit', compact('orderProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  OrderProduct $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderProduct $orderProduct)
    {
        request()->validate(OrderProduct::$rules);

        $orderProduct->update($request->all());

        return redirect()->route('order-products.index')
            ->with('success', 'OrderProduct updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $orderProduct = OrderProduct::find($id)->delete();

        return redirect()->route('order-products.index')
            ->with('success', 'OrderProduct deleted successfully');
    }
}
