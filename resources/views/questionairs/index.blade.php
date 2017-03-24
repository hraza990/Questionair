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
                                <th>#ID</th>
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
                                    <td>{{ $questionair->id }}</td>
                                    <td><a href="{{ url('view/questionair/'.$questionair->id) }}">{{ $questionair->name }}</a></td>
                                    <td>
                                        @forelse($questionair->QuestionsCount as $q_count)
                                            {{ $q_count->Count }}
                                        @empty
                                            0
                                        @endforelse
                                        | <a class='btn btn-primary btn-xs' href="{{ url('questionair/'.$questionair->id.'/questions') }}">Add Questions</a>
                                    </td>
                                    <td>{{ $questionair->duration }}</td>
                                    <td>
                                        {!! $questionair->resumeable == true ? 'Yes' : 'No' !!}
                                    </td>

                                    <td class="text-center">
                                        <a class='btn btn-success btn-xs' href="{{ url('view/questionair/'.$questionair->id) }}">View</a>
                                        <a class='btn btn-primary btn-xs' href="{{ url('/questionairs/'.$questionair->id.'/edit') }}">Edit</a>
                                        <a href="{{ url('/questionairs/'.$questionair->id.'/delete') }}" class="btn btn-danger btn-xs">Del</a>
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
