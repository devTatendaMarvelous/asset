<x-master>
<div class="container-fluid py-4">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-left: 4px solid #405189;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="color: #405189 !important;">
                                Total Assets
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAssets }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x" style="color: #3b82f6;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2" style="border-left: 4px solid #0284c7;">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #0284c7 !important;">
                        Blacklisted Assets
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $blacklistedAssets }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-ban fa-2x" style="color: #0ea5e9;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2" style="border-left: 4px solid #2563eb;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #2563eb !important;">
                                Asset Types
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCategories }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x" style="color: #60a5fa;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2" style="border-left: 4px solid #1d4ed8;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: #1d4ed8 !important;">
                                Students
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x" style="color: #3b82f6;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Charts Row -->
<div class="row mb-4">
    <!-- Asset status Chart -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #405189 0%, #3b82f6 100%); color: white;">
                <h6 class="m-0 font-weight-bold text-white">Assets by status</h6>
            </div>
            <div class="card-body">
                <div style="height: 300px; position: relative;">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Asset Category Chart -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #405189 0%, #3b82f6 100%); color: white;">
                <h6 class="m-0 font-weight-bold text-white">Assets by Category</h6>
            </div>
            <div class="card-body">
                <div style="height: 300px; position: relative;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Recent Assets Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #405189 0%, #3b82f6 100%); color: white;">
                    <h6 class="m-0 font-weight-bold text-white">Recent Assets</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #dbeafe;">
                                <tr>
                                    <th>Asset Tag</th>
                                    <th>Brand</th>
                                    <th>Type</th>
                                    <th>Serial</th>
                                    <th>status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentAssets as $asset)
                                    <tr>
                                        <td>#{{ $asset->id }}</td>
                                        <td>{{ $asset->brand }}</td>
                                        <td>{{ $asset->type->name ?? 'N/A' }}</td>
                                        <td>{{ $asset->serial_number ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge badge-{{
                                                $asset->status === 'ASSIGNED' ? 'success' :
                                                ($asset->status === 'LOST' ? 'warning' :
                                                ($asset->status === 'STOLEN' ? 'danger' : 'secondary'))
                                            }} text-dark">
                                                {{ $asset->status??'ll' }}
                                            </span>
                                        </td>
                                        <td>{{ $asset->created_at ? $asset->created_at->format('Y-m-d') : 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No assets found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
{{--@dd( json_encode($assetsByCategory->pluck('count')->toArray()) )--}}
    // status Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_keys($assetsByStatus)) !!},
            datasets: [{
                data: {!! json_encode(array_values($assetsByStatus)) !!},
                backgroundColor: ['#3b82f6', '#60a5fa', '#93c5fd', '#dbeafe', '#405189', '#1d4ed8']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });

    // Category Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'bar',
        data: {
         labels: @json($assetsByCategory->pluck('name')),
            datasets: [{
                label: 'Assets',
                data: @json($assetsByCategory->pluck('count')),
                backgroundColor: '#3b82f6',
                borderColor: '#405189',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

</x-master>
