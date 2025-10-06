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
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);

        $types = AssetType::all();
       return view('assets.edit', compact('asset','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssetRequest $request, $id)
    {
        $asset = Asset::findOrFail($id);
        $validated = $request->validated();
        $asset->update($validated);
        toast('Asset updated successfully.', 'success');
        return redirect()->route('gadgets.index');

    }

    public function downloadQr(Asset $asset)
    {
    // Generate a random directory name
    $time = random_int(10000, 99999);
    $tempDir = storage_path('app/public/asset_card');
    $tempDir2 = storage_path("app/public/asset_card{$time}");

    // Ensure both directories exist
    if (!file_exists($tempDir)) {
        mkdir($tempDir, 0755, true);
    }
    if (!file_exists($tempDir2)) {
        mkdir($tempDir2, 0755, true);
    }

    // Write SVG file
    $svgPath = $tempDir . '/' . $asset->serial_number . '.svg';
    file_put_contents($svgPath, cardTemplate($asset));

    // Prepare PNG path
    $pngPath = $tempDir2 . '/' . pathinfo($asset->serial_number, PATHINFO_FILENAME) . '.png';

    // Convert SVG to PNG using rsvg-convert
    exec("rsvg-convert -f png -o " . escapeshellarg($pngPath) . " " . escapeshellarg($svgPath));
    // Check if PNG file was created successfully
        if (file_exists($pngPath)) {
            return response()->download($pngPath);
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
