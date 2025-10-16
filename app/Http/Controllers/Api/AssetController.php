<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    public function details(Request $request)
    {
        $code = explode('@', $request->code ?? '');
        if (!isset($code[0]) || !isset($code[1])) {
            return errorValidationResponseHandler('Invalid asset code');
        }
        $asset = Asset::with('user', 'type')->where('id', $code[0])->where('serial_number', $code[1])->first();
        if ($asset) {

            return successResponseHandler('Asset!!', $asset);
        }
        return notFoundResponseHandler('Asset not exist');
    }

    public function reportFound(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'asset_id' => 'required|exists:assets,id',
            'notes' => 'required|string',
        ], [
            'asset_id.required' => 'Asset is required',
            'asset_id.exists' => 'Asset does not exist',
            'blacklist_id.required' => 'Blacklist ID is required',
            'blacklist_type.required' => 'Blacklist type is required',
            'notes.required' => 'Provide details about the found asset',
        ]);

        if ($validator->fails()) {
            return errorValidationResponseHandler('Validation Error', $validator->errors());
        }
        $asset = Asset::find($request->asset_id);
        $blacklist = $asset->latestBlacklist;
        $assetFound = $asset->founds()->create([
            'blacklist_id' => $blacklist->id,
            'blacklist_type' => $asset->status,
            'notes' => $request->notes ?? null,
            'status' => 'PENDING',
        ]);
        $asset->update(['status' => 'REPORTED_FOUND']);

        return successResponseHandler('Asset found report submitted successfully', $assetFound);
    }

    public function cloak(Request $request)
    {
        $validator = $this->validateData($request);
        if ($validator->status) {
            $data = $request->all();
            $data['user_id'] = auth()->id();
            $vehicle = AssetLog::create($data);
            return successResponseHandler('Asset Logged Successfully', $vehicle);
        } else {
            return errorValidationResponseHandler('Validation Error', $validator->errors);
        }

    }

    function validateData($request)
    {
        $rules = [
            'asset_id' => 'required|exists:assets,id',
            'action' => 'required|in:IN,OUT',
            'details' => 'nullable|string',
        ];
        $customMessages = [
            'asset_id.required' => 'Asset is required',
            'asset_id.exists' => 'Asset does not exist',
            'action.required' => 'Action is required',
            'details.string' => 'Details must be a string',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            $validation = json_decode(json_encode(['status' => false, 'errors' => $validator->errors()]), false);
        } else {
            $validation = json_decode(json_encode(['status' => true]), false);
        }
        return $validation;
    }
}
