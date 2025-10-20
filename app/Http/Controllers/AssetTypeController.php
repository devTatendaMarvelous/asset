<?php

     namespace App\Http\Controllers;

     use App\Http\Requests\AssetTypeRequest;
     use App\Models\AssetType;
     use Illuminate\Http\Request;

     class AssetTypeController extends Controller
     {
         public function index()
         {
             $types = AssetType::orderBy('name')->get();
             return view('asset_types.index', compact('types'));
         }

         public function create()
         {
             return view('asset_types.create');

         }
         public function show(AssetType $assetType)
         {
             return view('asset_types.show', compact('assetType'));
         }

         public function store(AssetTypeRequest $request)
         {
              AssetType::create($request->validated());
             toast('Asset type created.', 'success');
             return redirect()->route('asset-types.index')->with('success', 'Asset type created.');
         }

         public function edit(AssetType $assetType){
                return view('asset_types.edit', compact('assetType'));
         }

         public function update(AssetTypeRequest $request, AssetType $assetType)
         {
             $assetType->update($request->validated());
             return redirect()->route('asset-types.show', $assetType)->with('success', 'Asset type updated.');
         }

         public function destroy(AssetType $assetType)
         {
             $assetType->delete();
             return redirect()->route('asset-types.index')->with('success', 'Asset type deleted.');
         }

         // optional: restore soft-deleted asset type
         public function restore($id)
         {
             $type = AssetType::withTrashed()->findOrFail($id);
             if ($type->trashed()) {
                 $type->restore();
                 return redirect()->route('asset-types.show', $type)->with('success', 'Asset type restored.');
             }
             return redirect()->route('asset-types.index')->with('error', 'Not deleted.');
         }

     }
