@extends('layouts.app')

@section('content')
    <app-wishes></app-wishes>
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

