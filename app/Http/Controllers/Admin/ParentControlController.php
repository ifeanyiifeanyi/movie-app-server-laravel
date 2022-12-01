<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentControl;
use Illuminate\Http\Request;

class ParentControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentControls = ParentControl::latest()->get();
        return view('admin.parentControl.index', compact('parentControls'));
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
            'name' => 'required|unique:genres|max:100|string|min:3',
        ]);
        $pc = new ParentControl();
        $pc->name = $request->name;
        $pc->save();
        return redirect()->route('parentcontrol')->with('status', 'Parent Control Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parentControls = ParentControl::latest()->get();
        $parentControl = ParentControl::find($id);
        return view('admin.parentControl.index', compact('parentControls', 'parentControl'));
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
        $request->validate([
            'name' => 'required|unique:genres|max:100|string|min:3',
        ]);
        $pc = ParentControl::find($id);
        $pc->name = $request->name;
        $pc->update();
        return redirect()->route('parentcontrol')->with('status', 'Parent Control Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ParentControl::find($id)->delete();
        return redirect()->route('parentcontrol')->with('status', 'Parent Control Deleted!');

    }
}
