@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> <h2>Questionairs <small class="pull-right"><a href="{{ url('/questionairs/create') }}">Create</a></small></h2> </div>

                <div class="panel-body">
                    <table class="table table-striped custab">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>#Questions</th>
                                <th>Duration</th>
                                <th>Resumeable</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questionairs as $key => $questionair)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><a href="{{ route('questionairs.show', $questionair->id ) }}">{{ $questionair->name }}</a></td>
                                    <td>
                                        <span class="badge badge-success badge-xs">
                                            {{ count($questionair->Questions) > 0 ? count($questionair->Questions) : 0 }}
                                        </span>
                                        | <a class='btn btn-primary btn-xs' href="{{ route('questionair.questions.create', $questionair->id) }}">Add Questions</a>
                                    </td>
                                    <td>{{ $questionair->duration }}</td>
                                    <td>
                                        {!! $questionair->resumeable == true ? 'Yes' : 'No' !!}
                                    </td>

                                    <td class="text-center">
                                        <a class='btn btn-success btn-xs' href="{{ route('questionairs.show', $questionair->id ) }}">View</a>
                                        <a class='btn btn-primary btn-xs' href="{{ route('questionairs.edit', $questionair->id) }}">Edit</a>

                                        <form method="post" action="{{ route('questionairs.destroy', $questionair->id) }}">
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
