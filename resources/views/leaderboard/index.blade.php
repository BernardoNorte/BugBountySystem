@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Leaderboard - Top 20 Reporters</h1>

    @if($users->isEmpty())
        <p>No reports have been submitted yet.</p>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Researcher</th>
                    <th>Reports Submitted</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->user->name }}</td>
                        <td>{{ $user->reports_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
