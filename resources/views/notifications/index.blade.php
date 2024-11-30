<!-- Dalam notifications.index.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>All Notifications</h1>
        <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item">
                    <span>{{ $notification->message }}</span>
                    <span class="badge {{ $notification->read ? 'bg-success' : 'bg-danger' }}">
                        {{ $notification->read ? 'Read' : 'Unread' }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
