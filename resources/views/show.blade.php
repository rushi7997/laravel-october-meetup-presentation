@extends('layouts.app')

@section('content')
    <div class="card w-100">
        <div class="card-body">

            <div class="mx-auto text-center">
                <h3 class="card-title">Ref: {{ $invoice->reference_id }}</h3>
                <h4>
                    <span class="badge text-bg-{{ \App\Enums\InvoiceStatus::getBadgeColor($invoice->status) }}">
                        {{ $invoice->status }}
                    </span>
                </h4>
            </div>

            <div class="grid text-center w-100">
                <div class="row row-cols-2 g-5">
                    <form class="col" action="{{ route('invoice.finalize', $invoice) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-primary"
                                @if(!$invoice->canApply('finalize')) disabled @endif
                        >
                            Finalize
                        </button>
                    </form>

                    <form class="col" action="{{ route('invoice.paid', $invoice) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-success"
                                @if(!$invoice->canApply('pay')) disabled @endif
                        >
                            Pay
                        </button>
                    </form>

                    <form class="col" action="{{ route('invoice.cancel', $invoice) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-danger"
                                @if(!$invoice->canApply('cancel')) disabled @endif
                        >
                            Cancel
                        </button>
                    </form>

                    <form class="col" action="{{ route('invoice.void', $invoice) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-info"
                                @if(!$invoice->canApply('void')) disabled @endif
                        >
                            Void
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
