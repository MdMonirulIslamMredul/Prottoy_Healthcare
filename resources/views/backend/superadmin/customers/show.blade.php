@extends ('backend.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="mb-4">
            <h2>Customer Details</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.customers.index') }}">Customers</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </nav>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">{{ $customer->name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Email:</label>
                        <p>{{ $customer->email }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Phone:</label>
                        <p>{{ $customer->phone }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Address:</label>
                        <p>{{ $customer->address ?? 'N/A' }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">District:</label>
                            <p>{{ $customer->district->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">Upazila:</label>
                            <p>{{ $customer->upzila->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">Union:</label>
                            <p>{{ $customer->union->name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5 class="mb-3">Package Purchases</h5>

                        @if($customer->packagePurchases->isNotEmpty())
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Package</th>
                                            <th>PHO</th>
                                            <th>Purchase Date</th>
                                            <th>Total Price</th>
                                            <th>Paid</th>
                                            <th>Due</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customer->packagePurchases as $purchase)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $purchase->package->name ?? 'N/A' }}</td>
                                                <td>{{ $purchase->pho->name ?? 'N/A' }}</td>
                                                <td>{{ $purchase->purchase_date?->format('d M Y') ?? 'N/A' }}</td>
                                                <td>{{ number_format($purchase->total_price, 2) }}</td>
                                                <td>{{ number_format($purchase->paid_amount, 2) }}</td>
                                                <td>{{ number_format($purchase->due_amount, 2) }}</td>
                                                <td>{{ ucfirst(str_replace('_', ' ', $purchase->payment_status ?? 'unknown')) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Total Purchases</strong>
                                        <p class="mb-0">{{ $customer->package_purchases_count }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Total Spent</strong>
                                        <p class="mb-0">{{ number_format($customer->package_purchases_sum_total_price ?? 0, 2) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Total Paid</strong>
                                        <p class="mb-0">{{ number_format($customer->package_purchases_sum_paid_amount ?? 0, 2) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="border rounded p-3 bg-light">
                                        <strong>Total Due</strong>
                                        <p class="mb-0">{{ number_format($customer->package_purchases_sum_due_amount ?? 0, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning mb-0">
                                This customer has not purchased any packages yet.
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('superadmin.customers.index') }}" class="btn btn-secondary">Back</a>
                        <a href="{{ route('superadmin.customers.edit', $customer->id) }}" class="btn btn-primary">Edit
                            Customer</a>
                    </div>
                </div>

            </div>
        </div>
    @endsection
