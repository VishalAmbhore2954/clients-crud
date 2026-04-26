<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Client</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/update_client.css') }}">
</head>
<body>

<div class="container py-4">

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 py-3 mb-4 d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-3 fs-4 text-success"></i>
            <span class="fw-semibold">{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm form-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Update Client</span>

            <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary btn-sm">
                Client List
            </a>
        </div>

        <div class="card-body">

            <form action="{{ route('clients.update', $client->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- Name -->
                    <div class="col-md-6">
                        <label class="form-label">Name <span class="text-danger">*</span></label>

                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $client->name) }}"
                               placeholder="Enter client name">

                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>

                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $client->email) }}"
                               placeholder="Enter email">

                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label class="form-label">Phone <span class="text-danger">*</span></label>

                        <input type="number"
                               name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $client->phone) }}"
                               placeholder="Enter phone">

                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- GSTIN -->
                    <div class="col-md-6">
                        <label class="form-label">GSTIN</label>

                        <input type="text"
                               name="gstin"
                               class="form-control @error('gstin') is-invalid @enderror"
                               value="{{ old('gstin', $client->gstin) }}"
                               placeholder="Enter GSTIN">

                        @error('gstin')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- City -->
                    <div class="col-md-6">
                        <label class="form-label">City <span class="text-danger">*</span></label>

                        <input type="text"
                               name="city"
                               class="form-control @error('city') is-invalid @enderror"
                               value="{{ old('city', $client->city) }}"
                               placeholder="Enter city">

                        @error('city')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label class="form-label">Status <span class="text-danger">*</span></label>

                        <select name="status"
                                class="form-select @error('status') is-invalid @enderror">

                            <option value="">Select Status</option>
                            <option value="Active" {{ old('status', $client->status) == 'Active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="Inactive" {{ old('status', $client->status) == 'Inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-4 d-flex flex-column flex-md-row gap-2">
                    <button type="submit" class="btn btn-primary">
                        Update Client
                    </button>

                    <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>