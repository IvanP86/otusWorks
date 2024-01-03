<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\StoreOrderRequest;
use App\Http\Requests\Api\Order\UpdateOrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ElementOrder;
use App\Models\Element;
use App\Http\Resources\Orders\OrderResource;


/**
 * 
 * @OA\Post(
 *     path = "/api/orders",
 *     summary = "create",
 *     tags = {"Order"},
 *     security = {{ "bearerAuth" : {} }},
 * 
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf = {
 *                 @OA\Schema(
 *                     @OA\Property(property = "user_id", type = "integer", example = 1),
 *                     @OA\Property(property = "elements", type = "array", @OA\Items(
 *                         @OA\Property(property = "article", type = "string", example = "85055"),
 *                         @OA\Property(property = "count", type = "integer", example = "2"),
 *                         @OA\Property(property = "price", type = "integer", example = "11000"),
 *                     )),
 * 
 *                 )
 *             }
 * 
 *         )
 *     ),
 * 
 *     @OA\Response(
 *         response = 200,
 *         description = "ok",
 *         @OA\JsonContent(
 *             @OA\Property(property = "id", type = "integer", example = 79),
 *         ),
 *     ),
 * 
 * ),
 * 
 * @OA\Get(
 *     path = "/api/orders",
 *     summary = "orders",
 *     tags = {"Order"},
 *     security = {{ "bearerAuth" : {} }}, 
 *     @OA\Response(
 *         response = 200,
 *         description = "ok",
 *         @OA\JsonContent(
 *             @OA\Property(property = "data", type = "array", @OA\Items(
 *                 @OA\Property(property = "order", type = "integer", example = "1"),
 *                 @OA\Property(property = "elements", type = "array", @OA\Items(
 *                         @OA\Property(property = "article", type = "string", example = "85055"),
 *                         @OA\Property(property = "count", type = "integer", example = "2"),
 *                         @OA\Property(property = "price", type = "integer", example = "11000"), 
 *                 )),
 *             )),
 *         ),
 *     ),
 * 
 * ),
 * 
 * @OA\Get(
 *     path = "/api/orders/{order}",
 *     summary = "order",
 *     tags = {"Order"},
 *     security = {{ "bearerAuth" : {} }}, 
 *     @OA\Parameter(
 *         description = "Order Id",
 *         in = "path",
 *         name = "order",
 *         required = true,
 *         example = 1
 *     ),
 * 
 *     @OA\Response(
 *         response = 200,
 *         description = "ok",
 *         @OA\JsonContent(
 *             @OA\Property(property = "data", type = "array", @OA\Items(
 *                 @OA\Property(property = "elements", type = "array", @OA\Items(
 *                         @OA\Property(property = "article", type = "string", example = "85055"),
 *                         @OA\Property(property = "count", type = "integer", example = "2"),
 *                         @OA\Property(property = "price", type = "integer", example = "11000"), 
 *                 )),
 *             )),
 *         ),
 *     ),
 * 
 * ),
 * 
 * @OA\Patch(
 *     path = "/api/orders/{order}",
 *     summary = "Update order",
 *     tags = {"Order"},
 *     security = {{ "bearerAuth" : {} }}, 
 *     @OA\Parameter(
 *         description = "Order Id",
 *         in = "path",
 *         name = "order",
 *         required = true,
 *         example = 1
 *     ),
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf = {
 *                 @OA\Schema(
 *                     @OA\Property(property = "user_id", type = "integer", example = 1),
 *                     @OA\Property(property = "elements", type = "array", @OA\Items(
 *                         @OA\Property(property = "article", type = "string", example = "85055"),
 *                         @OA\Property(property = "count", type = "integer", example = "2"),
 *                         @OA\Property(property = "price", type = "integer", example = "11000"),
 *                     )),
 * 
 *                 )
 *             }
 * 
 *         )
 *     ),*  
 *     @OA\Response(
 *         response = 200,
 *         description = "ok",
 *         @OA\JsonContent(
 *                 @OA\Property(property = "message", type = "string", example = "ok")
 *         ),
 *     ),
 * 
 * ),
 * 
 * @OA\Delete(
 *     path = "/api/orders/{order}",
 *     summary = "delete order",
 *     tags = {"Order"},
 *     security = {{ "bearerAuth" : {} }}, 
 *     @OA\Parameter(
 *         description = "Order Id",
 *         in = "path",
 *         name = "order",
 *         required = true,
 *         example = 1
 *     ),
 * 
 *     @OA\Response(
 *         response = 200,
 *         description = "ok",
 *         @OA\JsonContent(
 *                 @OA\Property(property = "elements", type = "array", @OA\Items(
 *                         @OA\Property(property = "article", type = "string", example = "85055"),
 *                         @OA\Property(property = "count", type = "integer", example = "2"),
 *                         @OA\Property(property = "price", type = "integer", example = "11000"), 
 *                 )),
 *         ),
 *     ),
 * 
 * ),
 */
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
                $arrElement[] = [
                    'article' => $article->article,
                    'count' => $element->count,
                    'price' => $element->price
                ];
            }
            $result[] = [
                'order' =>  $order->id,
                'elements' => $arrElement,
            ];
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
            $elementFromDarabase = Element::where('article', $element['article'])->first();
            if ($elementFromDarabase === null) return "Такого артикула нет в базе";
            if ($element['count'] > $elementFromDarabase->count) {
                $element['count'] = $elementFromDarabase->count;
            }
            ElementOrder::create([
                'order_id' => $order->id,
                'element_id' => $elementFromDarabase->id,
                'count' => $element['count'],
                'price' => $element['price']

            ]);
        }
        return ['id' => $order->id];
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
            $elementFromDarabase = Element::where('id', $element->element_id)->withTrashed()->get()->first();
            $arrElement = [
                'article' => $elementFromDarabase->article,
                'count' => $element->count,
                'price' => $element->price
            ];
            $result['elements'][] = $arrElement;
        }
        return new OrderResource($result);
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
                $elementFromDarabase = Element::where('article', $element['article'])->withTrashed()->first();
                if ($elementFromDarabase === null) return "Такого артикула нет в базе";
                if ($element['count'] > $elementFromDarabase->count) {
                    $element['count'] = $elementFromDarabase->count;
                }
                $elementOrderObject = ElementOrder::where('order_id', $order->id)->where('element_id', $elementFromDarabase->id);
                $elementOrderObject->update(
                    [
                        'count' => $element['count'],
                        'price' => $element['price']
                    ]
                );
            }
        }
        return response()->json([
            "message" => 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json([
            "message" => 'ok'
        ]);
    }
}
