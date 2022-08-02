<?php

namespace App\Http\Controllers;

use App\DataTables\CoinsDataTable;
use App\Http\Requests\CoinsRequest;
use App\Models\Coins;
use App\Models\Donator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CoinsController extends Controller
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
    public function index(CoinsDataTable $dataTable)
    {
        if (Gate::allows('read coin')) {
            return $dataTable->render('coins.index');
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
        $users = User::all();
        $donators = Donator::all();
        return view('coins.coin-action', ['coin' => new Coins(), 'users' => $users, 'donators' => $donators]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoinsRequest $request)
    {
        if ($request->validated()) {
            $requestData = $request->all();

            $image = $request->file('proof');

            $imageName = time() . "." . $image->extension();

            $image->move(public_path('images'), $imageName);

            $requestData['proof'] = $imageName;

            Coins::create($requestData);
            return response()->json([
                'status' => 'success',
                'message' => 'Add coin record successfully.',
            ]);
        }
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
    public function edit(Coins $coin)
    {
        $donators = Donator::all();
        $users = User::all();
        return view('coins.coin-action', ['coin' => $coin, 'users' => $users, 'donators' => $donators]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CoinsRequest $request, Coins $coin)
    {
        $image = $coin->proof;
        if (file_exists('images/' . $image)) {
            unlink('images/' . $image);
        }
        $requestData = $request->all();
        $image = $request->file('proof');

        $imageName = time() . "." . $image->extension();

        $image->move(public_path('images'), $imageName);

        $requestData['proof'] = $imageName;

        $coin->amount = $requestData['amount'];
        $coin->coin_date = $requestData['coin_date'];
        $coin->proof = $requestData['proof'];
        $coin->user_id = $requestData['user_id'];
        $coin->donator_id = $requestData['donator_id'];
        $coin->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Coins record updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coins $coin)
    {
        $image = $coin->proof;
        unlink('images/' . $image);
        // $image = Coins::find($coin);
        // unlink(asset($image->proof));
        $coin->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Coin record deleted successfully.',
        ]);
    }
}
