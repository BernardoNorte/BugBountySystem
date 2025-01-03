@extends('layout')
@section('header-title', 'Listing of programs')
@section('main')
<p>
    <a href=""></a>
</p>
<table>
    <thead>
        <tr>
            <th>Criado por</ /th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Recompensa</th>
            <th>Criado a</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($programs as $program)
        <tr>
            <td>{{ $program->created_by }}</td>
            <td>{{ $program->name }}</td>
            <td>{{ $program->description }}</td>
            <td>{{ $program->rewards_info }}</td>
            <td>{{ $program->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection