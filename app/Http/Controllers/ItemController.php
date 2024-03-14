<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //selectのときは必ずgetする
        $items = Item::select("id","name","price","is_selling")->get();

        //inertiaの場合はコンポーネントのパスを指定
        //第二引数に配列を渡し変数名をキーにする。
        //vue側でdefinePropsで変数を受け取る
        return Inertia::render("Items/Index",[
            "items" => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Items/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        // dd($request);

        
        $request->validate([
            "name" => ["required","max:50"],
            "memo"=> ["max:255"],
            "price"=>["required","numeric"]
        ]);

        Item::create([
            "name"=> $request->name,
            "memo" => $request->memo,
            "price" => $request->price
        ]);

        ///ルートの場合はルーティング名を指定しリダイレクト
        return to_route("items.index")
        ->with([
            "message"=>"登録しました",
            "status"=>"success"
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        // dd($item);
        return Inertia::render("Items/Show",[
            "item" =>$item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        
        return Inertia::render("Items/Edit",[
            "item" =>$item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->name = $request->name;
        $item->memo = $request->memo;
        $item->price = $request->price;
        $item->is_selling = $request->is_selling;
        $item->save();

        return to_route("items.index")
        ->with([
            "message"=>"更新しました",
            "status"=>"success"
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return to_route("items.index")
        ->with([
            "message"=>"削除しました",
            "status"=>"danger"
        ]);
    }
}
