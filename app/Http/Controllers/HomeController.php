<?php

        namespace App\Http\Controllers;

        use App\Models\Asset;
        use App\Models\AssetType;
        use App\Models\User;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\DB;

        class HomeController extends Controller
        {
            public function __construct()
            {
                $this->middleware('auth');
            }

            public function index()
            {
                $totalAssets = Asset::count();
                $totalUsers = User::whereNotNull('reg_number')->count();
                $totalCategories = AssetType::count();

                $assetsByStatus = Asset::select('status', DB::raw('count(*) as count'))
                    ->groupBy('status')
                    ->pluck('count', 'status')
                    ->toArray();

                $assetsByCategory = Asset::join('asset_types', 'assets.type_id', '=', 'asset_types.id')
                    ->select('asset_types.name', DB::raw('count(*) as count'))
                    ->groupBy('asset_types.id', 'asset_types.name')
                    ->limit(5)
                    ->get();

                $recentAssets = Asset::with('type')
                    ->latest()
                    ->limit(5)
                    ->get();
                $blacklistedAssets = Asset::whereIn('status',[ 'LOST','STOLEN'])->count();

                return view('home', compact(
                    'totalAssets',
                    'totalUsers',
                    'totalCategories',
                    'assetsByStatus',
                    'assetsByCategory',
                    'recentAssets',
                    'assetsByStatus',
                    'blacklistedAssets'
                ));
            }
        }
