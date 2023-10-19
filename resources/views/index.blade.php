@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mt-3">
        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success mb-2">Create Invoice</button>
        </form>
    </div>

    <div class="mt-10">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ref_number</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <th scope="row"><a href="{{ route('invoices.show', $invoice) }}">{{ $invoice->id }}</a></th>
                    <td>{{ $invoice->reference_id }}</td>
                    <td class="badge text-bg-{{ \App\Enums\InvoiceStatus::getBadgeColor($invoice->status) }}">
                        {{ $invoice->status }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
