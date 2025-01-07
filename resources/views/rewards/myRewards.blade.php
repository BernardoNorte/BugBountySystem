<!-- resources/views/mypayments/index.blade.php -->

@extends('layouts.app')

@section('subtitulo')
    <p>Payments History</p>
@endsection

@section('content')
<div class="container-fluid">

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Report</th>
                    <th>Issued By</th>
                    <th>Issued At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ number_format($payment->amount, 2) }}€</td>
                        <td>{{ $payment->report->title }}
                        <td>{{ $payment->company->name }}</td>
                        <td>{{ $payment->issued_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No payments found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
