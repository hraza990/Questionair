@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> <h2>My Exams <small>Start your test now...</small></h2> </div>

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

                                @forelse($questionair->QuestionsCount as $q_count)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><a href="{{ $questionair->userExamStatus ? '#' : url('questionair/'.$questionair->id.'/exam') }}">{{ $questionair->name }}</a></td>
                                        <td>{{ $q_count->Count }}</td>
                                        <td>{{ $questionair->duration }}</td>
                                        <td>
                                            {!! $questionair->resumeable == true ? 'Yes' : 'No' !!}
                                        </td>
                                        <td class="text-center">
                                            @if(isset($questionair->userExamStatus))
                                                @if($questionair->userExamStatus->status == 0)
                                                    <span>Paused <span class="badge">{{ $questionair->userExamStatus->time_left }} Time Left</span></span>

                                                    <form class="form-horizontal" role="form" method="get" action="{{ url('questionair/'.$questionair->id.'/exam') }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="resume" value="resume">
                                                        <button type="submit" class='btn btn-danger btn-xs'>Resume</button>
                                                    </form>
                                                @else
                                                    <a class='btn btn-primary btn-xs' href="#">Status: {!! $questionair->userExamStatus->remarks !!}</a>
                                                    <a class='btn btn-danger btn-xs' href="{{ url('questionair/'.$questionair->id.'/result') }}">Result</a>
                                                @endif
                                            @else
                                                <a class='btn btn-success btn-xs' href="{{ url('questionair/'.$questionair->id.'/exam') }}">Start this Exam</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
