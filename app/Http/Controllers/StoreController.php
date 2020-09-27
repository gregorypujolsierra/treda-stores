<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class StoreController
 * @package App\Http\Controllers
 */
class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $stores = Store::all();

        return view('stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreRequest $request)
    {
        $opened_since = explode('-', $request->get('opened_since'));
        $opened_since = implode('-', [$opened_since[2], $opened_since[1], $opened_since[0]]);

        $store = new Store(
            [
                'name' => $request->get('name'),
                'opened_since' => $opened_since,
            ]
        );

        $store->save();

        return redirect()->route('stores.index')->with($type = 'success', 'The store was created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|RedirectResponse|Factory|View
     */
    public function edit(int $id)
    {
        $store = Store::find($id);
        $opened_since = explode('-', $store->opened_since);
        $opened_since = implode('-', [$opened_since[2], $opened_since[1], $opened_since[0]]);
//        dd($opened_since);
        return view('stores.edit', compact(['store', 'opened_since']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     *
     * @todo Do not update if no changes
     */
    public function update(StoreRequest $request, $id)
    {
        $name = $request->get('name');
        $opened_since = explode('-', $request->get('opened_since'));
        $opened_since = implode('-', [$opened_since[2], $opened_since[1], $opened_since[0]]);

        $store = Store::find($id);

        if ($store->name != $name) {
            $store->name = $name;
        }
        if ($store->opened_since != $opened_since) {
            $store->opened_since = $opened_since;
        }

        $store->save();

        return redirect()->route('stores.index')->with($type = 'success', 'The store was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $store = Store::find($id);
        $store->delete();

        return redirect()->route('stores.index')->with($type = 'success', 'The store was deleted!');
    }
}
