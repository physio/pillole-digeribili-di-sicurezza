@extends('layouts.app')

@section('header')
pippo pluto paperino
@endsection

@section('content')
    <style>
        .push-top {
            margin-top: 50px;
        }
    </style>
    <div class="push-top">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <table class="table">
            <thead>
            <tr class="table-warning">
                <td>ID</td>
                <td>Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Password</td>
                <td class="text-center">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($identityCards as $identityCard)
                <tr>
                    <td>{{$identityCard->id}}</td>
                    <td>{{$identityCard->name}}</td>
                    <td>{{$identityCard->email}}</td>
                    <td>{{$identityCard->phone}}</td>
                    <td>{{$identityCard->password}}</td>
                    <td class="text-center">
                        <a href="{{ route('identityCard.edit', $identityCard->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                        <form action="{{ route('identityCard.destroy', $identityCard->id)}}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
@endsection