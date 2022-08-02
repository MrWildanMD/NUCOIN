<?php

namespace App\Http\Controllers;

use App\DataTables\DonatorsDataTable;
use App\Http\Requests\DonatorsRequest;
use App\Models\Donator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DonatorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DonatorsDataTable $dataTable)
    {
        if (Gate::allows('read coin')) {
            return $dataTable->render('donators.index');
        }
        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donators.donator-action', ['donator' => new Donator()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonatorsRequest $request)
    {
        Donator::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Add donator successfully.',
        ]);
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
    public function edit(Donator $donator)
    {
        return view('donators.donator-action', compact('donator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DonatorsRequest $request, Donator $donator)
    {
        $donator->name = $request->name;
        $donator->address = $request->address;
        $donator->phone = $request->phone;
        $donator->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Donator updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donator $donator)
    {
        $donator->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Donator deleted successfully.',
        ]);
    }
}
