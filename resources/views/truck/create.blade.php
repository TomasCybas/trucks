@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    {{--TODO: add backend validation error messages--}}

                    <div class="card-body">
                        <form action="{{route('truck.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="brand">Gamintojas</label>
                                <input type="text" name="brand" id="brand" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="model">Modelis</label>
                                <input type="text" name="model" id="model" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="reg_number">Registracijos Nr.</label>
                                <input type="text" name="reg_number" id="reg_number" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">Pridėti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



