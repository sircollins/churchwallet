@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="col-md-4 col-12 offset-lg-2 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title col-md">Add Region</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" action="{{route('region.store')}}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">


                                        <div class="form-group has-icon-left">

                                            <label for="first-name-icon">Region Name</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control"
                                                       placeholder="Input Region" id="first-name-icon" name="name">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-bag"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-outline-success me-1 mb-1">Save Region</button>

                                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection
