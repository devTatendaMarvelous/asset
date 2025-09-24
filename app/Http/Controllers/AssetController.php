<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Models\Asset;
use App\Models\AssetType;
use App\Models\User;
use App\Traits\Core;

class AssetController extends Controller
{
    use Core;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::with('user', 'type')->paginate(10);
        return view('assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'Student');
        })->get();
        $types = AssetType::all();
        return view('assets.create', compact('students', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssetRequest $request)
    {
        $validated = $request->validated();
        $asset = Asset::create($validated);
        $this->generateQr($asset->id, $asset->serial_number);
        toast('Asset created successfully.', 'success');
        return redirect()->route('gadgets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {$asset= $asset->first();
        $asset->load('user','type');

        return view('assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        $types = AssetType::all();
       return view('assets.edit', compact('asset','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        //
    }

    public function downloadQr(Asset $asset)
    {
        $filePath = storage_path('app/public/assets/qr_' . $asset->serial_number . '.png');

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            toast('QR code not found.', 'error');
            return redirect()->back();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        //
    }
}
