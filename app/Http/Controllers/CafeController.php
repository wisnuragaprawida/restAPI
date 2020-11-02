<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Cafe_menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CafeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cafe = Cafe::all();
        return response()->json(

            [
                "message" => "success",
                "data"    => $cafe,

            ]
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cafeById($id)
    {
        $cafe = Cafe::find($id);
        $cafe->cafeMenu;
        return response()->json(

            [
                "message" => "success",
                "data"    => $cafe,

            ]
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responses
     */
    public function search($params)
    {
        $cafe = DB::table('cafes')
            ->where('id', $params)
            ->orwhere('name', 'like', '%' . $params . '%')
            ->orwhere('location', 'like', '%' . $params . '%')
            ->get();

        if (count($cafe) > 0) {

            return response()->json(

                [

                    "message" => "success",
                    "data"    => $cafe
                ]
            );
        } else {
            return response()->json(

                [

                    "message" => "Cafe Not found",
                    "status_code"    => 404
                ]

            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cafe.uploadCafe');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'status' => 'required',
            'map' => 'required',
            'cafeImage' => 'required|mimes:jpeg,png,jpg,gif,svg|max:4096',


        ]);

        $imageName = 'cafeImage' . '-' . time() . '.' .  $request->cafeImage->extension();

        $request->cafeImage->move(public_path('images'), $imageName);


        $cafe = new Cafe;

        $cafe->name = $request->name;
        $cafe->description = $request->description;
        $cafe->location = $request->location;
        $cafe->status = $request->status;
        $cafe->map = $request->map;
        $cafe->cafeImage = '/images' . '/' . $imageName;
        $cafe->save();

        return redirect('/cafe/show');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cafe  $cafe
     * @return \Illuminate\Http\Response
     */
    public function show(Cafe $cafe)
    {
        $cafes = Cafe::paginate(4);
        return view('cafe.cafes', compact('cafes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cafe  $cafe
     * @return \Illuminate\Http\Response
     */
    public function edit(Cafe $cafe, $id)
    {
        $cafes = cafe::find($id);
        return view('cafe.edit', compact('cafes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cafe  $cafe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cafe $cafe, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'status' => 'required',
            'map' => 'required',
            'cafeImage' => 'mimes:jpeg,png,jpg,gif,svg|max:4096',


        ]);

        $imageName = null;
        if ($request->cafeImage) {
            $imageName = 'cafeImage' . '-' . time() . '.' .  $request->cafeImage->extension();

            $request->cafeImage->move(public_path('images'), $imageName);
        }

        $cafe = Cafe::find($id);

        $cafe->name = $request->name;
        $cafe->description = $request->description;
        $cafe->location = $request->location;
        $cafe->status = $request->status;
        $cafe->map = $request->map;
        if ($imageName) {

            $cafe->cafeImage = '/images' . '/' . $imageName;
        } else {
            $cafe->cafeImage = $cafe->cafeImage;
        }
        $cafe->save();

        return redirect('/cafe/info/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cafe  $cafe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cafe $cafe, $id)
    {
        Cafe::find($id)->delete();
        DB::table('Cafe_menus')->where('cafe_id', $id)->delete();

        return redirect('/cafe/show');
    }


    // cafe Menu

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMenu($id)
    {
        $Id = $id;
        return view('cafe.uploadMenu', compact('Id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMenu(Request $request, $id)
    {

        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'menuImage' => 'required|mimes:jpeg,png,jpg,gif,svg|max:4096',


        ]);

        $imageName = 'MenuImage' . '-' . time() . '.' .  $request->menuImage->extension();

        $request->menuImage->move(public_path('images'), $imageName);


        $menu = new Cafe_menu;

        $menu->category = $request->category;
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->amount = $request->amount;
        $menu->menuImage = '/images' . '/' . $imageName;
        $menu->cafe_id = $id;
        $menu->save();

        return redirect('/cafe/info/' . $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cafe  $cafe
     * @return \Illuminate\Http\Response
     */
    public function showInfo(Cafe $cafe, $id)
    {
        $cafes = Cafe::find($id);
        $cafes->cafeMenu;

        return view('cafe.cafesInfo', compact('cafes'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cafe_menu  $cafe
     * @return \Illuminate\Http\Response
     */
    public function editMenu(Cafe_menu $cafe_menu, $id)
    {
        $menu = Cafe_menu::find($id);
        return view('cafe.menuEdit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cafe_menu  $cafe_menu
     * @return \Illuminate\Http\Response
     */
    public function updateMenu(Request $request, Cafe_menu $cafe_menu, $id)
    {

        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'menuImage' => 'mimes:jpeg,png,jpg,gif,svg|max:4096',


        ]);

        $imageName = null;
        if ($request->menuImage) {
            $imageName = 'menuImage' . '-' . time() . '.' .  $request->menuImage->extension();

            $request->menuImage->move(public_path('images'), $imageName);
        }



        $Cafe_menus = Cafe_menu::find($id);

        $Cafe_menus->category = $request->category;
        $Cafe_menus->name = $request->name;
        $Cafe_menus->description = $request->description;
        $Cafe_menus->amount = $request->amount;
        if ($imageName) {
            $Cafe_menus->menuImage = '/images' . '/' . $imageName;
        } else {
            $Cafe_menus->menuImage = $Cafe_menus->menuImage;
        }
        $Cafe_menus->save();

        return redirect('/cafe/info/' . $Cafe_menus->cafe_id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cafe_menu  $cafe
     * @return \Illuminate\Http\Response
     */
    public function destroyMenu(Cafe_menu $cafe_menu, $id)
    {
        $menu = Cafe_menu::find($id);
        Cafe_menu::find($id)->delete();
        return redirect('/cafe/info/' . $menu->cafe_id);
    }
}
