@extends('layouts.app')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #EEEEEE;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container-ajust{
            display: flex;
            justify-content: center;
            align-items: center;
            width: auto;
            height: 90vh;
            background-color: #FFFFFF;
        }

        .container {
            display: flex;
            flex-direction: row-reverse;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 643px;
            height: 375px;

        }

        .signup-container {
            padding: 20px;
            text-align: center;
            width: 334px;
        }

        img {}

        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            height: 35px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-control {
            height: 40px;
            width: 293px;
            font-size: 16px;
        }
    </style>
    <div class="container-ajust">
        <div class="container">
            <img src="{{ asset('img/ruangan.jpg') }}"
                style="width: 310px; height: 376px; object-fit: cover; border-radius: 70px  10px 10px 70px;">
            <div class="signup-container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Register New User</div>

                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('users.store') }}">
                                    @csrf
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4 col-form-label text-md-right">Role</label>
                                        <div class="col-md-6">
                                            <select name="role" class="form-control" required>
                                                <option value="">Pilih Role</option>
                                                <option value="staf">Staf</option>
                                                <option value="kepala_eksekutif">Kepala Eksekutif</option>
                                                <option value="kadep">Kadep</option>
                                                <option value="kabag">kabag</option>
                                                <option value="direktur">direktur</option>
                                                <option value="deputi">deputi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-4 col-form-label text-md-right">Name</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-md-4 col-form-label text-md-right">Password</label>
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary"
                                                style=" width: 100%; padding: 10px; background: #2575fc; color: white; border: none; border-radius: 5px; cursor: pointer;font-size: 16px; margin-top: 20px;">
                                                Register
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
@endsection