@extends('layouts.admin')

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Date Create</td>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{$ticket->id}}</td>
                <td><a href="{{route('admin.ticket.edit', $ticket->id)}}">{{$ticket->title}}</a></td>
                <td>{{$ticket->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if($tickets->total() > $tickets->count())
        <div class="mt-3">
            {{$tickets->links()}}
        </div>
    @endif
@endsection
