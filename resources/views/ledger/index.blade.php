@extends('layouts.master')

@section('content')
<!-- Stylesheets -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .layout {
        display: flex;
        min-height: 100vh;
    }

    .main-content {
        flex: 1;
        background-color: #ffffff;
        padding: 20px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .ledger-card {
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .ledger-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .ledger-table thead th {
        background-color: #f9fafb;
        font-weight: 600;
        font-size: 14px;
        color: #4b5563;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e5e7eb;
        text-align: center;
    }

    .ledger-table tbody td {
        padding: 0.5rem 1rem;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
        text-align: center;
    }

    .ledger-table tbody tr:hover {
        background-color: #f3f4f6;
    }

    .page-header {
        background: #ffffff;
        padding: 1rem 0;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .form-control,
    .form-select {
        font-size: 14px;
    }

    /* Make sure dropdown appears above table */
    .table-responsive {
        overflow: visible !important;
    }

    /* Ensure the dropdown can stack above siblings */
    .card-body {
        position: relative;
        z-index: 1;
    }

    /* Optional: make dropdown part of the flow inside the cell */
    .dropdown-menu {
        position: static !important;
        transform: none !important;
    }


    .badge {
        font-size: 13px;
        font-weight: 500;
    }
</style>

<div class="layout">

    <!-- Main Content -->
    <main class="main-content">

        <!-- Page Header -->
        <div class="page-header">
            <h2 class="title" style="font-weight:bold;">Ledger</h2>
            <div>
                <!-- Toast -->
                <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
                    @if(session('success'))
                    <div id="deleteToast" class="toast align-items-center text-white bg-success border-0" role="alert"
                        aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                </div>

                <button class="btn btn-outline-primary me-2" id="toggleFiltersBtn">
                    <i class="fas fa-filter me-1"></i>Filters
                </button>
                <a href="{{ route('ledger.create') }}" class="btn btn-primary me-2">
                    <i class="fas fa-plus me-1"></i>Add New
                </a>
                <button class="btn btn-outline-secondary" id="printPdfBtn">
                    <i class="fas fa-print me-1"></i>Print
                </button>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="ledger-card card mb-3" id="filtersSection" style="display: none;">
            <div class="card-body">
                <form method="GET" action="{{ route('ledger.index') }}">
                    <div class="row g-3">
                        {{-- <div class="col-md-3">
                            <label class="form-label">Account</label>
                            <select name="account" class="form-select">
                                <option value="">All Accounts</option>
                                <option value="cash">Cash Account</option>
                                <option value="bank">Bank Account</option>
                            </select>
                        </div> --}}
                        <div class="col-md-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                <option value="sale" {{ old('type', request('type'))=='sale' ? 'selected' : '' }}>Sale
                                </option>
                                <option value="purchase" {{ old('type', request('type'))=='purchase' ? 'selected' : ''
                                    }}>Purchase</option>
                                <option value="payment" {{ old('type', request('type'))=='payment' ? 'selected' : '' }}>
                                    Payment</option>
                                <option value="receipt" {{ old('type', request('type'))=='receipt' ? 'selected' : '' }}>
                                    Receipt</option>
                                <option value="journal" {{ old('type', request('type'))=='journal' ? 'selected' : '' }}>
                                    Journal</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">From Date</label>
                            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">To Date</label>
                            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-1"></i>Search
                            </button>
                        </div>
                    </div>
                    {{-- <div class="row mt-2">
                        <div class="col-12 d-flex">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="from_zero" {{ request('from_zero')
                                    ? 'checked' : '' }} id="fromZero">
                                <label class="form-check-label" for="fromZero">From Zero</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="view_hisab" id="viewHisab">
                                <label class="form-check-label" for="viewHisab">View Only Hisab</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="view_xrf" id="viewXRF">
                                <label class="form-check-label" for="viewXRF">View Only XRF</label>
                            </div>
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>

        <!-- Ledger Table -->
        <div class="card flex-grow-1">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table ledger-table table-hover">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Date</th>
                                <th>Particulars</th>
                                <th>Type</th>
                                <th>Gr. Wt.</th>
                                <th>Less</th>
                                <th>Net Wt.</th>
                                <th>Tunch</th>
                                <th>Wastage</th>
                                <th>Gold Fine</th>
                                <th>Silver Fine</th>
                                <th>Amount</th>
                                <th>Reference No.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ledgers as $ledger)
                            <tr>
                                <td>
                                    <div class="dropdown position-static">
                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ledger.edit', $ledger->id) }}">Edit</a></li>
                                            <li>
                                                <form action="{{ route('ledger.destroy', $ledger->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </form>
                                            </li>
                                            <li><a class="dropdown-item print-record" href="javascript:void(0);">Print</a></li>

                                        </ul>
                                    </div>

                                <td>{{ \Carbon\Carbon::parse($ledger->date)->format('d-m-Y') }}</td>
                                <td>{{ $ledger->particulars }}</td>
                                <td>{{ $ledger->type }}</td>
                                <td>{{ $ledger->gross_weight }}</td>
                                <td>{{ $ledger->less_weight }}</td>
                                <td>{{ $ledger->net_weight }}</td>
                                <td>{{ $ledger->tunch }}%</td>
                                <td>{{ $ledger->wastage }}%</td>
                                <td>{{ $ledger->gold_fine }}</td>
                                <td>{{ $ledger->silver_fine }}</td>
                                <td class="fw-bold">{{ $ledger->amount }}</td>
                                <td>{{ $ledger->reference_no }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13" class="text-center">No ledger entries found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jsPDF and html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggleFiltersBtn');
        const filters = document.getElementById('filtersSection');
        
        toggleBtn.addEventListener('click', function() {
            filters.style.display = filters.style.display === 'none' ? 'block' : 'none';
            this.classList.toggle('btn-primary');
            this.classList.toggle('btn-outline-primary');
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".btn-outline-secondary").addEventListener("click", function () {
        printLedger();
    });
});

function printLedger() {
    // Clone the table to avoid modifying the original
    let tableClone = document.querySelector(".ledger-table").cloneNode(true);

    // Remove the "Action" column (first column) from header
    tableClone.querySelectorAll("thead th:first-child").forEach(th => th.remove());

    // Remove the "Action" column from each row
    tableClone.querySelectorAll("tbody tr").forEach(tr => {
        tr.querySelector("td:first-child").remove();
    });

    // Open print window
    let printWindow = window.open("", "_blank");
    printWindow.document.write(`
        <html>
        <head>
            <title>Ledger Print</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                }
                h2 {
                    text-align: center;
                    margin-bottom: 20px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    font-size: 14px;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 6px;
                    text-align: center;
                }
                th {
                    background: #eee;
                    font-weight: bold;
                }
                tr:hover {
                    background: none; /* Remove hover effect for print */
                }
            </style>
        </head>
        <body>
            <h2>Ledger Report</h2>
            ${tableClone.outerHTML}
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}

document.addEventListener('DOMContentLoaded', function () {
    var toastEl = document.getElementById('deleteToast');
    if (toastEl) {
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    }
});
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".print-record").forEach(function(btn) {
        btn.addEventListener("click", function() {
            let row = this.closest("tr");
            if (!row) return;

            let data = {
                date: row.children[1].innerText,
                particulars: row.children[2].innerText,
                type: row.children[3].innerText,
                gross_weight: row.children[4].innerText,
                less_weight: row.children[5].innerText,
                net_weight: row.children[6].innerText,
                tunch: row.children[7].innerText,
                wastage: row.children[8].innerText,
                gold_fine: row.children[9].innerText,
                silver_fine: row.children[10].innerText,
                amount: row.children[11].innerText,
                reference_no: row.children[12].innerText
            };

            let invoiceHTML = `
                <html>
                <head>
                    <title>Ledger</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
                        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0,0,0,0.15); }
                        h1 { text-align: center; margin-bottom: 20px; }
                        .invoice-details { width: 100%; margin-bottom: 20px; }
                        .invoice-details td { padding: 5px; }
                        .invoice-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        .invoice-table th, .invoice-table td { border: 1px solid #000; padding: 8px; text-align: center; }
                        .invoice-table th { background-color: #f0f0f0; }
                        .total { font-weight: bold; }
                        .footer { margin-top: 40px; text-align: right; font-size: 14px; }
                    </style>
                </head>
                <body>
                    <div class="invoice-box">
                        <h1>Ledger</h1>
                        <table class="invoice-details">
                            <tr>
                                <td><strong>Date:</strong> ${data.date}</td>
                                <td><strong>Reference No:</strong> ${data.reference_no}</td>
                            </tr>
                            <tr>
                                <td><strong>Particulars:</strong> ${data.particulars}</td>
                                <td><strong>Type:</strong> ${data.type}</td>
                            </tr>
                        </table>

                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <th>Gross Wt.</th>
                                    <th>Less</th>
                                    <th>Net Wt.</th>
                                    <th>Tunch</th>
                                    <th>Wastage</th>
                                    <th>Gold Fine</th>
                                    <th>Silver Fine</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${data.gross_weight}</td>
                                    <td>${data.less_weight}</td>
                                    <td>${data.net_weight}</td>
                                    <td>${data.tunch}</td>
                                    <td>${data.wastage}</td>
                                    <td>${data.gold_fine}</td>
                                    <td>${data.silver_fine}</td>
                                    <td class="total">${data.amount}</td>
                                </tr>
                            </tbody>
                        </table>                       
                    </div>
                </body>
                </html>
            `;
            let printWindow = window.open("", "_blank");
            printWindow.document.write(invoiceHTML);
            printWindow.document.close();
            printWindow.print();
        });
    });
});
</script>
@endsection