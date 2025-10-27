@extends('admin.layouts.app')

@section('title', 'Travel Partner Management')

@section('content')
<div class="content-area p-4">
    <!-- Page Header with Stats -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="mb-1">Travel Partner Management</h2>
                <p class="text-muted mb-0">Manage API integrations and partner relationships</p>
            </div>
            <div class="col-md-6">
                <div class="text-end d-none">
                    <button class="btn btn-primary modern-btn" data-bs-toggle="modal" data-bs-target="#addPartnerModal">
                        <i class="bi bi-plus-circle"></i> Add New Partner
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4 d-none">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon icon-blue">
                        <i class="bi bi-building"></i>
                    </div>
                    <div class="ms-3">
                        <div class="small text-muted">Total Partners</div>
                        <div class="h4 mb-0">{{ number_format($stats['total_partners']) }}</div>
                        <div class="small text-success">
                            <i class="bi bi-arrow-up"></i> {{ $stats['new_this_month'] }} new this month
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon icon-green">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="ms-3">
                        <div class="small text-muted">Active Partners</div>
                        <div class="h4 mb-0">{{ number_format($stats['active_partners']) }}</div>
                        <div class="small text-success">
                            <i class="bi bi-arrow-up"></i>
                            {{ round(($stats['active_partners']/$stats['total_partners'])*100, 1) }}% active rate
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon icon-orange">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ms-3">
                        <div class="small text-muted">Monthly Revenue</div>
                        <div class="h4 mb-0">${{ number_format($stats['monthly_revenue']) }}</div>
                        <div class="small text-success">
                            <i class="bi bi-arrow-up"></i>
                            {{ number_format($stats['revenue_growth'] ?? 0, 1) }}% growth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="stats-icon icon-purple">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <div class="ms-3">
                        <div class="small text-muted">Avg Commission</div>
                        <div class="h4 mb-0">{{ number_format($stats['avg_commission'] ?? 0, 1) }}%</div>
                        <div class="small text-info">
                            <i class="bi bi-arrow-right"></i> Industry standard
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Filters -->
        <div class="col-12  d-none">
            <div class="filter-card">
                <form method="GET" action="{{ route('admin.travel-partners.index') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Search Partners</label>
                            <div class="search-container">
                                <i class="bi bi-search"></i>
                                <input type="text" name="search" class="form-control search-input"
                                       placeholder="Search by company name, API type..."
                                       value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Partner Tier</label>
                            <select name="tier" class="form-select">
                                <option value="">All Tiers</option>
                                <option value="standard" {{ request('tier') == 'standard' ? 'selected' : '' }}>Standard</option>
                                <option value="premium" {{ request('tier') == 'premium' ? 'selected' : '' }}>Premium</option>
                                <option value="enterprise" {{ request('tier') == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">API Health</label>
                            <select name="api_health" class="form-select">
                                <option value="">All Health</option>
                                <option value="excellent" {{ request('api_health') == 'excellent' ? 'selected' : '' }}>Excellent (>95%)</option>
                                <option value="good" {{ request('api_health') == 'good' ? 'selected' : '' }}>Good (85-95%)</option>
                                <option value="poor" {{ request('api_health') == 'poor' ? 'selected' : '' }}>Poor (<85%)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary modern-btn">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                                <a href="{{ route('admin.travel-partners.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </a>
                                <button class="btn btn-warning modern-btn">
                                    <i class="bi bi-gear"></i> Bulk Settings
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Partners Table -->
        <div class="col-xl-12">
            <div class="partners-table">
                <div class="table-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Partner List ({{ $partners->total() }})</h5>
                        <div class="d-flex gap-2 d-none">
                            <div class="dropdown export-dropdown">
                                <button class="btn btn-outline-primary modern-btn dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="bi bi-download"></i> Export
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-excel me-2"></i>Export as Excel</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-text me-2"></i>Export as CSV</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-pdf me-2"></i>Export as PDF</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr >
                                <th>
                                    <input type="checkbox" class="form-check-input">
                                </th>
                                <th>Partner Details</th>
                                <!-- <th>Integration Date</th> -->
                                <th class="text-center">Commission</th>
                                <!-- <th>Monthly Revenue</th> -->
                                <!-- <th>Tier</th> -->
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($partners as $partner)
                            <tr>
                                <td><input type="checkbox" class="form-check-input"></td>
                                <td>
                                    <div class="partner-profile">

                                        <style>
                                            .partner-logo {
                                                width: 50px;
                                                height: 50px;
                                                border-radius: 50%;
                                                overflow: hidden;
                                                display: inline-block;
                                                background-color: #f0f0f0;
                                            }
                                            .partner-logo img {
                                                width: 100%;
                                                height: auto;
                                            }
                                        </style>
                                        <div class="partner-logo" style="background: {{ getRandomColor() }};">
                                            <img src="{{ asset('public/assets/images/partners/' .$partner->company_name).'.png' }}" alt="Partner Logo">
                                        </div>

                                        <div class="partner-details">
                                            <div class="partner-name">{{ $partner->company_name }}</div>
                                            <div class="partner-type d-none">{{ $partner->api_type }}</div>
                                            <div class="contract-info d-none">
                                                Contract:
                                                @if($partner->contract_end_date)
                                                    {{ $partner->contract_end_date->diffInDays() <= 30 ? 'Expiring Soon' : 'Till ' . $partner->contract_end_date->format('M Y') }}
                                                @else
                                                    No end date
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="d-none">
                                    <div class="api-details">{{ $partner->integration_date?->format('M d, Y') ?? 'N/A' }}</div>
                                    <div class="integration-date">{{ $partner->integration_age ?? 'N/A' }}</div>
                                </td>
                                <td>
                                    <div class="commission-info">
                                        <div class="commission-rate">{{ $partner->commission_rate }}%</div>
                                        <div class="commission-label">per booking</div>
                                    </div>
                                </td>
                                <td class="d-none">
                                    <div class="revenue-amount">${{ number_format($partner->monthly_revenue) }}</div>
                                    <div class="revenue-growth {{ $partner->revenue_growth >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $partner->revenue_growth_text }}
                                    </div>
                                </td>
                                <td class="d-none">
                                    <span class="partner-tier tier-{{ $partner->partner_tier }}">
                                        {{ ucfirst($partner->partner_tier) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-status status-{{ $partner->status }}">
                                        {{ ucfirst($partner->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons d-flex gap-1">
                                        <!-- <a href="{{ route('admin.travel-partners.show', $partner->id) }}"
                                           class="btn btn-outline-primary btn-sm" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a> -->

                                        <a class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editPartnerModal_{{ $partner->id }}" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <div class="dropdown d-none">
                                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown" title="More">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i>Edit Contract</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-graph-up"></i>View Analytics</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-currency-dollar"></i>Commission Settings</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    @if($partner->status == 'active')
                                                    <a class="dropdown-item text-warning" href="#"
                                                       onclick="event.preventDefault(); document.getElementById('suspend-form-{{ $partner->id }}').submit();">
                                                        <i class="bi bi-pause-circle"></i>Suspend
                                                    </a>
                                                    <form id="suspend-form-{{ $partner->id }}"
                                                          action="{{ route('admin.travel-partners.suspend', $partner->id) }}"
                                                          method="POST" style="display: none;">
                                                        @csrf @method('PATCH')
                                                    </form>
                                                    @else
                                                    <a class="dropdown-item text-success" href="#"
                                                       onclick="event.preventDefault(); document.getElementById('activate-form-{{ $partner->id }}').submit();">
                                                        <i class="bi bi-play-circle"></i>Activate
                                                    </a>
                                                    <form id="activate-form-{{ $partner->id }}"
                                                          action="{{ route('admin.travel-partners.activate', $partner->id) }}"
                                                          method="POST" style="display: none;">
                                                        @csrf @method('PATCH')
                                                    </form>
                                                    @endif
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#"
                                                       onclick="event.preventDefault(); document.getElementById('delete-form-{{ $partner->id }}').submit();">
                                                        <i class="bi bi-trash"></i>Remove
                                                    </a>
                                                    <form id="delete-form-{{ $partner->id }}"
                                                          action="{{ route('admin.travel-partners.destroy', $partner->id) }}"
                                                          method="POST" style="display: none;">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>







<!-- Edit Partner Modal -->
<div class="modal fade" id="editPartnerModal_{{ $partner->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-pencil-square me-2"></i>Edit Partner: {{ $partner->company_name }}
                </h5>
                <button type="button" class="btn-close modern-btn" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('admin.travel-partners.update', $partner->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    id="editPartnerForm_{{ $partner->id }}"
                    class="modern-form">


                @csrf
                    @method('PATCH')

                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-md-12">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-info-circle me-1"></i>Basic Information
                            </h6>

                            <div class="row">

                            <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="company_name" class="form-control"  readonly value="{{ $partner->company_name }}" required>
                            </div>
                            </div>

                                {{--<div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Profile Image</label>
                                <input type="file" name="profile_image" class="form-control">
                                @if($partner->profile_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('public/assets/images/' . $partner->profile_image) }}" alt="Partner Logo">
                                    </div>
                                @endif
                            </div>
                                </div>--}}

                                <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Commission (%)</label>
                                <input type="number" name="commission_rate" class="form-control" id="editCommission" value="12" min="0" max="100" step="0.1">
                            </div>
                                </div>

                                <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="active" {{ $partner->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="pending" {{ $partner->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="suspended" {{ $partner->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                </select>
                            </div>
                                </div>


                            <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Development Mode</label>
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="development_mode" value="0">
                                            <input class="form-check-input" type="checkbox" name="development_mode"
                                                   id="editDevMode" value="1" {{ $partner->development_mode ? 'checked' : '' }}>
                                            <label class="form-check-label" for="editDevMode">
                                                Enable Test Mode
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <!-- <div class="mb-3 d-none">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="company_name" class="form-control" value="{{ $partner->company_name }}" required>
                            </div>

                            <div class="mb-3 d-none">
                                <label class="form-label">API Type</label>
                                <input type="text" name="api_type" class="form-control" value="{{ $partner->api_type }}">
                            </div>

                            <div class="mb-3 d-none">
                                <label class="form-label">Contract End Date</label>
                                <input type="date" name="contract_end_date" class="form-control"
                                       value="{{ $partner->contract_end_date?->format('Y-m-d') }}">
                            </div> -->

                            <!-- <div class="row d-none">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Commission (%)</label>
                                        <input type="number" name="commission_rate" class="form-control"
                                               value="{{ $partner->commission_rate }}" min="0" max="100" step="0.1">
                                    </div>
                                </div>
                                <div class="col-md-6 d-none">
                                    <div class="mb-3">
                                        <label class="form-label">Partner Tier</label>
                                        <select class="form-select" name="partner_tier">
                                            <option value="standard" {{ $partner->partner_tier == 'standard' ? 'selected' : '' }}>Standard</option>
                                            <option value="premium" {{ $partner->partner_tier == 'premium' ? 'selected' : '' }}>Premium</option>
                                            <option value="enterprise" {{ $partner->partner_tier == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="active" {{ $partner->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="pending" {{ $partner->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="suspended" {{ $partner->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                </select>
                            </div> -->
                        </div>

                        <!-- Contact Information -->
                        <!-- <div class="col-md-6 d-none">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-person-lines-fill me-1"></i>Contact Information
                            </h6>

                            <div class="mb-3 d-none">
                                <label class="form-label">Contact Person</label>
                                <input type="text" name="contact_person" class="form-control" value="{{ $partner->contact_person }}">
                            </div>

                            <div class="mb-3 d-none">
                                <label class="form-label">Contact Email</label>
                                <input type="email" name="contact_email" class="form-control" value="{{ $partner->contact_email }}">
                            </div>

                            <div class="mb-3 d-none">
                                <label class="form-label">Contact Phone</label>
                                <input type="text" name="contact_phone" class="form-control" value="{{ $partner->contact_phone }}">
                            </div>

                            <div class="mb-3 d-none">
                                <label class="form-label">Monthly Revenue ($)</label>
                                <input type="number" name="monthly_revenue" class="form-control"
                                       value="{{ $partner->monthly_revenue }}" step="0.01">
                            </div>

                            <div class="mb-3 d-none">
                                <label class="form-label">API Uptime (%)</label>
                                <input type="number" name="api_uptime" class="form-control"
                                       value="{{ $partner->api_uptime }}" min="0" max="100" step="0.1">
                            </div>
                        </div> -->
                    </div>

                    <!-- API Configuration -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-key me-1"></i>API Configuration
                            </h6>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">API Credential 1</label>
                                        <input type="text" name="api_credential_1" class="form-control" value="{{ $partner->api_credential_1 }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">API Credential 2</label>
                                        <input type="text" name="api_credential_2" class="form-control" value="{{ $partner->api_credential_2 }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">API Credential 3</label>
                                        <input type="text" name="api_credential_3" class="form-control" value="{{ $partner->api_credential_3 }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">API Credential 4</label>
                                        <input type="text" name="api_credential_4" class="form-control" value="{{ $partner->api_credential_4 }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">API Credential 5</label>
                                        <input type="text" name="api_credential_5" class="form-control" value="{{ $partner->api_credential_5 }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">API Credential 6</label>
                                        <input type="text" name="api_credential_6" class="form-control" value="{{ $partner->api_credential_6 }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Configuration Options -->
                    <div class="row mt-4 d-none">
                        <div class="col-12">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-gear me-1"></i>Configuration Options
                            </h6>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Development Mode</label>
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="development_mode" value="0">
                                            <input class="form-check-input" type="checkbox" name="development_mode"
                                                   id="editDevMode" value="1" {{ $partner->development_mode ? 'checked' : '' }}>
                                            <label class="form-check-label" for="editDevMode">
                                                Enable Test Mode
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Currency Support</label>
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="currency_support" value="0">
                                            <input class="form-check-input" type="checkbox" name="currency_support"
                                                id="editCurrency" value="1" {{ $partner->currency_support ? 'checked' : '' }}>

                                            <label class="form-check-label" for="editCurrency">
                                                Multi-Currency
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Payment Mode</label>
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="payment_integration" value="0">
                                            <input class="form-check-input" type="checkbox" name="payment_integration"
                                                   id="editPaymentMode" value="1" {{ $partner->payment_integration ? 'checked' : '' }}>
                                            <label class="form-check-label" for="editPaymentMode">
                                                Payment Integration
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">PNR Type</label>
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="custom_pnr_format" value="0">
                                            <input class="form-check-input" type="checkbox" name="custom_pnr_format"
                                                   id="editPNRType" value="1" {{ $partner->custom_pnr_format ? 'checked' : '' }}>
                                            <label class="form-check-label" for="editPNRType">
                                                Custom PNR Format
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Notes -->
                    <div class="row mt-3 d-none">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Admin Notes</label>
                                <textarea class="form-control" name="admin_notes" rows="3">{{ $partner->admin_notes }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modern-btn" data-bs-dismiss="modal">Cancel</button>
                @if($partner->status == 'active')
                    <button type="button" class="btn btn-outline-danger modern-btn"
                            onclick="document.getElementById('suspend-form-{{ $partner->id }}').submit()">
                        Suspend Partner
                    </button>
                @else
                    <button type="button" class="btn btn-outline-success modern-btn"
                            onclick="document.getElementById('activate-form-{{ $partner->id }}').submit()">
                        Activate Partner
                    </button>
                @endif
                <button type="submit" form="editPartnerForm_{{ $partner->id }}" class="btn btn-primary modern-btn">
                    <i class="bi bi-check-lg"></i> Update Partner
                </button>
            </div>
        </div>
    </div>
</div>






                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">No partners found matching your criteria</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Showing {{ $partners->firstItem() }} to {{ $partners->lastItem() }} of {{ $partners->total() }} entries
                        </div>
                        <nav>
                            {{ $partners->withQueryString()->links('pagination::bootstrap-5') }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Partner Tier Badges */
    .partner-tier {
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        text-transform: capitalize;
    }
    .tier-standard { background-color: #6c757d; color: white; }
    .tier-premium { background-color: #ffc107; color: black; }
    .tier-enterprise { background-color: #6610f2; color: white; }

    /* Status Badges */
    .badge-status {
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        text-transform: capitalize;
    }
    .status-active { background-color: #d1fae5; color: #065f46; }
    .status-pending { background-color: #fef3c7; color: #92400e; }
    .status-suspended { background-color: #fee2e2; color: #b91c1c; }

    /* Revenue Growth Colors */
    .text-success { color: #22c55e; }
    .text-danger { color: #ef4444; }

    /* Partner Logo */
    .partner-logo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        margin-right: 12px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Bulk actions checkboxes
        const selectAllCheckbox = document.querySelector('thead .form-check-input');
        const rowCheckboxes = document.querySelectorAll('tbody .form-check-input');

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                rowCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });
        }
    });
</script>
@endpush



    <!-- Edit Partner Modal -->
    <div class="modal fade" id="editPartnerModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square me-2"></i>Edit Partner: <span id="editPartnerName">Amadeus Travel</span>
                    </h5>
                    <button type="button" class="btn-close modern-btn" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editPartnerForm" class="modern-form">
                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">
                                    <i class="bi bi-info-circle me-1"></i>Basic Information
                                </h6>

                                <div class="mb-3">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="editCompanyName" value="Amadeus Travel" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">API Type</label>
                                    <input type="text" class="form-control" id="editApiType" value="Flight Search API">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Contract End Date</label>
                                    <input type="date" class="form-control" id="editContractDate" value="2025-12-31">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Commission (%)</label>
                                            <input type="number" class="form-control" id="editCommission" value="12" min="0" max="100" step="0.1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Partner Tier</label>
                                            <select class="form-select" id="editTier">
                                                <option value="standard">Standard</option>
                                                <option value="premium">Premium</option>
                                                <option value="enterprise" selected>Enterprise</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" id="editStatus">
                                        <option value="active" selected>Active</option>
                                        <option value="pending">Pending</option>
                                        <option value="suspended">Suspended</option>
                                    </select>
                                </div>
                            </div>

                            <!-- API Configuration -->
                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">
                                    <i class="bi bi-key me-1"></i>Module API Credentials
                                </h6>

                                <div class="mb-3">
                                    <label class="form-label">API Credential 1</label>
                                    <input type="text" class="form-control credential-input" id="editCred1" value="amadeus_api_key_123456">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">API Credential 2</label>
                                    <input type="password" class="form-control credential-input" id="editCred2" value="••••••••••••••••">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">API Credential 3</label>
                                    <input type="text" class="form-control credential-input" id="editCred3" value="access_token_789">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">API Credential 4</label>
                                    <input type="text" class="form-control credential-input" id="editCred4" value="https://api.amadeus.com/v1">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">API Credential 5</label>
                                    <input type="text" class="form-control credential-input" id="editCred5" value="webhook_secret_abc123">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">API Credential 6</label>
                                    <input type="text" class="form-control credential-input" id="editCred6" value="additional_param_xyz">
                                </div>
                            </div>
                        </div>

                        <!-- Configuration Options -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="bi bi-gear me-1"></i>Configuration Options
                                </h6>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Development Mode</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="editDevMode">
                                                <label class="form-check-label" for="editDevMode">
                                                    Enable Test Mode
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Currency Support</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="editCurrency" checked>
                                                <label class="form-check-label" for="editCurrency">
                                                    Multi-Currency
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Payment Mode</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="editPaymentMode" checked>
                                                <label class="form-check-label" for="editPaymentMode">
                                                    Payment Integration
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">PNR Type</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="editPNRType" checked>
                                                <label class="form-check-label" for="editPNRType">
                                                    Custom PNR Format
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Admin Notes</label>
                                    <textarea class="form-control" rows="3" id="editNotes">Amadeus configured for production. Test mode enabled for development environment.</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modern-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-outline-danger modern-btn">Suspend Partner</button>
                    <button type="submit" form="editPartnerForm" class="btn btn-primary modern-btn">
                        <i class="bi bi-check-lg"></i> Update Partner
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Partner Requests Modal -->
    <div class="modal fade" id="partnerRequestsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-building-add me-2"></i>Pending Partner Requests
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="request-item">
                        <div class="request-header">
                            <div class="request-company">SkyScanner Business</div>
                            <div class="request-date">2 days ago</div>
                        </div>
                        <div class="request-details">
                            Meta-search API for flight comparison. Proposed commission: 5%
                        </div>
                        <div class="request-actions">
                            <button class="btn btn-success modern-btn btn-sm">
                                <i class="bi bi-check-lg"></i> Approve
                            </button>
                            <button class="btn btn-danger modern-btn btn-sm">
                                <i class="bi bi-x-lg"></i> Reject
                            </button>
                            <button class="btn btn-outline-primary modern-btn btn-sm">
                                <i class="bi bi-eye"></i> Review
                            </button>
                        </div>
                    </div>

                    <div class="request-item">
                        <div class="request-header">
                            <div class="request-company">Sabre Corporation</div>
                            <div class="request-date">5 days ago</div>
                        </div>
                        <div class="request-details">
                            Global distribution system access. Enterprise tier proposal.
                        </div>
                        <div class="request-actions">
                            <button class="btn btn-success modern-btn btn-sm">
                                <i class="bi bi-check-lg"></i> Approve
                            </button>
                            <button class="btn btn-danger modern-btn btn-sm">
                                <i class="bi bi-x-lg"></i> Reject
                            </button>
                            <button class="btn btn-outline-primary modern-btn btn-sm">
                                <i class="bi bi-eye"></i> Review
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modern-btn" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
