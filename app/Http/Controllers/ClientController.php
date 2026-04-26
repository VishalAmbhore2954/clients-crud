<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest\StoreClientRequest;
use App\Http\Requests\ClientRequest\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // City filter
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        $clients = $query->paginate(10)->withQueryString();

        $cities = Client::select('city')->distinct()->pluck('city');

        return view('clients_list', compact('clients', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_client');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $data = Client::create($request->validated());

        if($data){
            $request->session()->flash('success','Client added succesfully');
        }

        return view('create_client');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('update_client', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());

         return redirect()
            ->route('clients.index')
            ->with('success', 'Client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $data = $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function search(Request $request)
    {
        $clients = Client::where('name', 'like', '%'.$request->search.'%')->orWhere('email', 'like', '%'.$request->search.'%')->paginate(10);

        $cities = Client::select('city')->distinct()->pluck('city');

        return view('clients_list', compact('cities','clients'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(Request $request)
    {
        $query = Client::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $clients = $query->paginate(10);
        $cities = Client::distinct()->pluck('city');

        return view('clients_list', compact('clients', 'cities'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cities(Request $request)
    {
        $query = Client::query();

        if ($request->city) {
            $query->where('city', $request->city);
        }

        $clients = $query->paginate(10);
        $cities = Client::distinct()->pluck('city');

        return view('clients_list', compact('clients', 'cities'));
    }

}
