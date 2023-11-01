<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\View\ViewFinderInterface;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $limited=5;

    public function index()
    {
        //$persons=Person::all();
        $persons=Person::latest()->simplePaginate($this->limited);
        return view('person.index',compact('persons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('person.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'firstname'=>'required|unique:people|max:255',
            'lastname'=>'required|unique:people|max:255',
            'email'=>'required|unique:people|max:255',
            'city'=>'required|unique:people|max:255'
        ]);

        $person=new Person();
        $person->firstName=$request->firstname;
        $person->lastName=$request->lastname;
        $person->email=$request->email;
        $person->city=$request->city;
        $person->save();
        return redirect()->route('mainhome')->with('successMsg','person create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person=Person::findOrFail($id);
        return view('person.edit',compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $person=Person::findOrFail($id);
        $person->firstName=$request->firstname;
        $person->lastName=$request->lastname;
        $person->email=$request->email;
        $person->city=$request->city;
        $person->save();
        return redirect()->route('mainhome')->with('successMsg','person edit success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person=Person::findOrFail($id);
        $person->delete();
        return redirect()->route('mainhome')->with('alertMsg','person delete success');
    }
}
