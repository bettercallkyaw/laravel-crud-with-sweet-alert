@extends('layouts.main')

@section('title','edit person')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <h1 class="text-center">Please Enter All fields</h1>
            <form action="{{ route('person.update',$person->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="firstname">FirstName</label>
                    <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                    value="{{ $person->firstName }}">
                    @error('firstname')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                            </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lastname">LastName</label>
                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                    value="{{ $person->lastName }}">
                    @error('lastname')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                            </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ $person->email }}">
                    @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                            </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                    value="{{ $person->city }}">
                    @error('city')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                            </span>
                    @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
</div>
@endsection