@extends('layout.table')

@section('title', 'Contact')
@section('content')
<div class="container">
    <h1>Contacts</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>{{ $contact->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No contacts found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection