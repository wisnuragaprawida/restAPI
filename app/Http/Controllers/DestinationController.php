<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destination = Destination::all();
        return response()->json(

            [
                "message" => "success",
                "data"    => $destination
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
        $destination = DB::table('destinations')
            ->where('id', $params)
            ->orwhere('name', 'like', '%' . $params . '%')
            ->orwhere('location', 'like', '%' . $params . '%')
            ->get();

        if (count($destination) > 0) {

            return response()->json(

                [

                    "message" => "success",
                    "data"    => $destination
                ]
            );
        } else {
            return response()->json(

                [

                    "message" => "Destination Not found",
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
        return view('formUploadDestination');
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
            'destinationImage' => 'required|mimes:jpeg,png,jpg,gif,svg|max:4096',


        ]);

        $imageName = $request->name . '-' . time() . '.' .  $request->destinationImage->extension();

        $request->destinationImage->move(public_path('images'), $imageName);


        $destination = new destination;

        $destination->name = $request->name;
        $destination->description = $request->description;
        $destination->location = $request->location;
        $destination->status = $request->status;
        $destination->map = $request->map;
        $destination->destinationImage = '/images' . '/' . $imageName;
        $destination->save();

        return redirect('/destination/show');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        $destinations = destination::paginate(4);
        return view('destinations', compact('destinations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit(Destination $destination, $id)
    {
        $destinations = destination::find($id);
        return view('destinationEdit', compact('destinations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'status' => 'required',
            'map' => 'required',
            'destinationImage' => 'mimes:jpeg,png,jpg,gif,svg|max:4096',


        ]);

        $imageName = null;
        if ($request->destinationImage) {
            $imageName = $request->name . '-' . time() . '.' .  $request->destinationImage->extension();

            $request->destinationImage->move(public_path('images'), $imageName);
        }

        $destination = destination::find($id);

        $destination->name = $request->name;
        $destination->description = $request->description;
        $destination->location = $request->location;
        $destination->status = $request->status;
        $destination->map = $request->map;
        if ($imageName) {

            $destination->destinationImage = '/images' . '/' . $imageName;
        } else {
            $destination->destinationImage = $destination->destinationImage;
        }
        $destination->save();

        return redirect('/destination/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination, $id)
    {
        destination::find($id)->delete();
        return redirect('/destination/show');
    }
}
