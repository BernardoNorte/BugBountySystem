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
                    @if(Auth::user()->type == 'C')
                    <th>Issued By</th>
                    @else
                    <th>Issued To</th>
                    @endif
                    <th>Issued At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ number_format($payment->amount, 2) }}€</td>
                        <td>{{ $payment->report->title }}
                        @if(Auth::user()->type == 'C')
                        <td>{{ $payment->company->name }}</td>
                        @else
                        <td>{{ $payment->user->name }}</td>
                        @endif
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
