@extends('layouts.app')

@section('content')
    <table>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{$ticket->id}}</td>
                <td>{{$ticket->title}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

