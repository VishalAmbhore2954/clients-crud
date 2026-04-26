<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Management System</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/client_list.css') }}">
</head>
<body>

<div class="container py-3">

    <!-- Top Header -->
    <div class="row align-items-center mb-3">
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-primary p-3 rounded-4 shadow-sm">
                    <i class="bi bi-people text-white fs-4"></i>
                </div>
                <div>
                    <h2 class="page-title mb-1">Clients Directory</h2>
                </div>
            </div>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0">
            <a href="{{ route('clients.create') }}" class="btn btn-primary btn-add-client">
                <i class="bi bi-plus-lg me-2"></i>Add New Client
            </a>
        </div>
    </div>

    <!-- Search Section -->
    <div class="filter-section mb-4">
        <div class="row g-3 align-items-stretch">

    <!-- SEARCH -->
    <div class="col-12 col-lg-6">
        <form method="GET" action="{{ route('clients.index') }}" class="h-100">
            <div class="input-group h-100">
                <span class="input-group-text bg-transparent border-end-0 text-muted ps-3">
                    <i class="bi bi-search"></i>
                </span>

                <input 
                    type="text" 
                    name="search" 
                    class="form-control form-control-custom border-start-0" 
                    placeholder="Search client name, email" 
                    value="{{ request('search') }}"
                >

                <button class="btn btn-dark px-4 ms-2 rounded-3 fw-bold" type="submit">
                    Search
                </button>

                @if(request('search'))
                    <a href="{{ route('clients.index') }}" class="btn btn-light border px-3 ms-2 rounded-3">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- STATUS -->
    <div class="col-12 col-md-6 col-lg-3">
        <form action="{{ route('clients.index') }}" method="GET" class="h-100">
            <div class="input-group h-100">
                <span class="input-group-text bg-transparent border-end-0 text-muted">
                    <i class="bi bi-funnel"></i>
                </span>

                <select name="status" id="status"
                        class="form-select form-select-custom border-start-0"
                        onchange="this.form.submit()">
                    <option value="">Status</option>
                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>
                        Active Members
                    </option>
                    <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>
                        Inactive Members
                    </option>
                </select>
            </div>
        </form>
    </div>

    <!-- CITY -->
    <div class="col-12 col-md-6 col-lg-3">
        <form action="{{ route('clients.index') }}" method="GET" class="h-100">
            <div class="input-group h-100">
                <span class="input-group-text bg-transparent border-end-0 text-muted">
                    <i class="bi bi-geo-alt"></i>
                </span>

                <select name="city" id="city"
                        class="form-select form-select-custom border-start-0"
                        onchange="this.form.submit()">
                    <option value="">Select City</option>

                    @foreach($cities as $city)
                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                            {{ $city }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

</div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 py-3 mb-4 d-flex align-items-center animate__animated animate__fadeIn">
            <i class="bi bi-check-circle-fill me-3 fs-4 text-success"></i>
            <span class="fw-semibold">{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Table View (Desktop) -->
    <div class="table-card desktop-table">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client Details</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>GSTIN Number</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                    <tr>
                        <td class="text-muted fw-bold">#{{ $client->id }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="fw-bold small">{{ $client->name }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="text-muted small">{{ $client->phone }}</div>
                        </td>
                        <td>
                            <div class="fw-medium">{{ $client->email }}</div>
                        </td>
                        <td><span class="badge bg-light text-secondary border px-2 py-1">{{ $client->gstin }}</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <i class="bi bi-geo-alt text-muted"></i>
                                {{ $client->city }}
                            </div>
                        </td>
                        <td>
                            <span class="status-pill {{ $client->status === 'Active' ? 'status-active' : 'status-inactive' }}">
                                {{ $client->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('clients.edit', $client->id)}}" class="btn-action btn-edit" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Confirm deletion?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-inbox text-muted fs-1 d-block mb-3"></i>
                            <span class="text-muted fw-medium">No clients found matching your search.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Card View (Mobile) -->
    <div class="mobile-cards mt-4">
        @forelse($clients as $client)
        <div class="mobile-card">
            <div class="mobile-header">
                <div class="avatar-circle">{{ strtoupper(substr($client->name, 0, 1)) }}</div>
                <div class="flex-grow-1">
                    <div class="fw-bold">{{ $client->name }}</div>
                    <div class="text-muted small">#{{ $client->id }}</div>
                </div>
                <span class="status-pill {{ $client->status === 'Active' ? 'status-active' : 'status-inactive' }}">
                    {{ $client->status }}
                </span>
            </div>

            <div class="mobile-data-row">
                <span class="mobile-label">Email</span>
                <span class="mobile-value">{{ $client->email }}</span>
            </div>
            <div class="mobile-data-row">
                <span class="mobile-label">Phone</span>
                <span class="mobile-value">{{ $client->phone }}</span>
            </div>
            <div class="mobile-data-row">
                <span class="mobile-label">GSTIN</span>
                <span class="mobile-value text-uppercase fw-bold">{{ $client->gstin }}</span>
            </div>
            <div class="mobile-data-row">
                <span class="mobile-label">City</span>
                <span class="mobile-value">{{ $client->city }}</span>
            </div>
            
            <div class="row g-2 mt-4">
                <div class="col-6">
                    <a href="{{ route('clients.edit', $client->id)}}" class="btn btn-outline-primary w-100 rounded-3 py-2 fw-bold">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                </div>
                <div class="col-6">
                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-3 py-2 fw-bold">
                            <i class="bi bi-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
            <div class="text-center py-5 bg-white rounded-4 border">No clients found.</div>
        @endforelse
    </div>

    <!-- Circular Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $clients->links('pagination::bootstrap-5') }}
    </div>

</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>