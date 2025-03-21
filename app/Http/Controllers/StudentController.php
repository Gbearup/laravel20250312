<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Phone;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = DB::table('users')->get();
        // $data = DB::table('students')->get();
        // $data=Student::get();
        // dd($data);

        $data=Student::with('phone')->get();
        // dd($data);


        return view('student.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('student controller create');
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $input = $request->except('_token');
        // dd($input);

        //主表
        $data = new Student;
        // $data->name = $request->name;
        // $data->mobile = $request->mobile;
        $data->name = $input['name'];
        $data->mobile = $input['mobile'];
        $data->save();

        //子表
        $item = new Phone;
        $item->student_id = $data->id;
        $item->phone = $input['phone'];
        $item->save();


        return redirect()->route('students.index');
        // return redirect('/students');
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
        // $url = route('students.edit', ['student' => $id]);
        // dd($url);
        // dd("hello edit $id");

        //get fetchAll
        //first fetch
        $data = Student::where('id',$id)->with('phone')->first();
        // dd($data);

        return view('student.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd("hello update $id");
        $input = $request->except('_token','_method');

        //主表
        $data = Student::where('id',$id)->first();
        $data->name = $input['name'];
        $data->mobile = $input['mobile'];
        $data->save();

        //刪除子表
        Phone::where('student_id',$id)->delete();
        //新增子表
         $item = new Phone;
         $item->student_id = $data->id;
         $item->phone = $input['phone'];
         $item->save();



        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

      //刪除子表
      Phone::where('student_id',$id)->delete();
      //刪除主表
      Student::where('id',$id)->delete();

        // $data = Student::where('id',$id)->first();
        // $data->delete();
        return redirect()->route('students.index');
    }

    public function excel()
    {
        dd('hello student controller excel');
    }

    public function sayHello()
    {
        dd('hello kai');
    }
}
