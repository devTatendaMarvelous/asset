@extends('layouts.app')

@section('content')
    <h1>Category Details</h1>
    <p>Name: {{ $category->name }}</p>
    <a href="{{ route('categories.edit', $category) }}">Edit</a>
    <a href="{{ route('categories.index') }}">Back to list</a>
@endsection