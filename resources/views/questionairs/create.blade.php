@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> <h2>Add Questionair</h2> </div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/questionairs/store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="questionair_name" class="col-md-3 control-label">Questionair Name:</label>
                            <div class="col-md-9">
                                <input id="questionair_name" type="text" class="form-control" name="questionair_name" value="{{ old('questionair_name') }}" placeholder="Enter Questionair Name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="duration" class="col-md-3 control-label">Duration:</label>
                            <div class="col-md-5">
                                <input id="duration" type="number" class="form-control" name="duration" value="{{ old('duration') }}" placeholder="Enter Duration" required autofocus>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" id="duration" name="duration_type" required>
                                    <option value="min" selected="selected">Minutes</option>
                                    <option value="hr">Hours</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="resumeable" class="col-md-3 control-label">Can Resume ?</label>
                            <div class="col-md-2">
                                <input type="radio" value="1" name="resumeable"> Yes
                            </div>
                            <div class="col-md-2">
                                <input type="radio" value="0" name="resumeable"> No
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="published" class="col-md-3 control-label">Is Publish ?</label>
                            <div class="col-md-2">
                                <input type="radio" value="1" name="published"> Yes
                            </div>
                            <div class="col-md-2">
                                <input type="radio" value="0" name="published"> No
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">
                                    Save
                                </button>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
