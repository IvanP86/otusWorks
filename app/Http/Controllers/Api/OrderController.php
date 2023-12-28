<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\StoreOrderRequest;
use App\Http\Requests\Api\Order\UpdateOrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ElementOrder;
use App\Models\Element;
use App\Http\Resources\Orders\OrderResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = [];
        $orders = Order::all();
        foreach ($orders as $order) {
            $elements = ElementOrder::where('order_id', $order->id)->get();
            foreach ($elements as $element) {
                $article = Element::where('id', $element->element_id)->withTrashed()->get('article')->first();
                $arrElement = [
                    'article' => $article->article,
                    'count' => $element->count,
                    'price' => $element->price
                ];
                $result[$order->id]['elements'][] = $arrElement;
            }
        }

        return OrderResource::collection($result);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $order = Order::create(['user_id' => $data['user_id']]);
        foreach ($data['elements'] as $element) {
            $element_id = Element::where('article', $element['article'])->first();
            ElementOrder::create([
                'order_id' => $order->id,
                'element_id' => $element_id->id,
                'count' => $element['count'],
                'price' => $element['price']

            ]);
        }
        return $order->id;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = [];
        $order = Order::findOrFail($id);
        $elements = ElementOrder::where('order_id', $order->id)->get();
        foreach ($elements as $element) {
            $article = Element::where('id', $element->element_id)->withTrashed()->get('article')->first();
            $arrElement = [
                'article' => $article->article,
                'count' => $element->count,
                'price' => $element->price
            ];
            $result['elements'][] = $arrElement;
        }
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, string $id)
    {
        $data = $request->validated();
        $order = Order::findOrFail($id);
        if (isset($data['user_id'])) {
            $order->update(["user_id" => $data['user_id']]);
        }
        if ($data['elements']) {
            foreach ($data['elements'] as $element) {
                $elementObject = Element::where('article', $element['article'])->withTrashed()->first();
                $elementOrderObject = ElementOrder::where('order_id', $order->id)->where('element_id', $elementObject->id);
                $elementOrderObject->update(
                    [
                        'count' => $element['count'],
                        'price' => $element['price']
                    ]
                );
            }
        }
        return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return "ok";
    }
}
