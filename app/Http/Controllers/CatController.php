<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = DB::table('users')->get();
        // $data = DB::table('cats')->get();
        $data=Cat::get();
        // dd($data);

        return view('cat.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('cat controller create');
        return view('cat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $input = $request->except('_token');
        // dd($input);

        $data = new Cat;

        // $data->name = $request->name;
        // $data->mobile = $request->mobile;

        $data->name = $input['name'];
        $data->mobile = $input['mobile'];

        $data->save();

        return redirect()->route('cats.index');
        // return redirect('/cats');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $url = route('cats.edit', ['cat' => $id]);
        // dd($url);
        // dd("hello edit $id");

        //get fetchAll
        //first fetch
        $data = Cat::where('id',$id)->first();
        // dd($data);

        return view('cat.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd("hello update $id");
        $input = $request->except('_token','_method');
        $data = Cat::where('id',$id)->first();
        
        $data->name = $input['name'];
        $data->mobile = $input['mobile'];
        $data->save();

        return redirect()->route('cats.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Cat::where('id',$id)->first();
        $data->delete();
        return redirect()->route('cats.index');
    }

    public function excel()
    {
        dd('hello cat controller excel');
    }

    public function sayHello()
    {
        dd('hello kai');
    }
}
