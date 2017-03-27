@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading"> <h2>{!! $questionair->name !!} [ Questions:

                {{ count($questionair->Questions) > 0 ? count($questionair->Questions) : 0 }}

                <small> Duration: {!! $questionair->duration !!}</small></h2> </div>

                <div>
                    @forelse($questionair->questions as $que => $question)
                        <h3 class="text-danger">Q#{!! $que+1 !!} {!! $question->question !!}
                            <small>[Type:
                                {!! $question->type == 1 ? 'Text' : '' !!}
                                {!! $question->type == 2 ? 'Multiple Choice (Single Option)' : '' !!}
                                {!! $question->type == 3 ? 'Multiple Choice (Multiple Option)' : '' !!}
                            ]</small>
                        </h3>
                        <ul class="list-unstyled">
                            {{--{!! dd($question) !!}--}}
                            @foreach($question->QChoices as $key => $choice)
                                <li>
                                    <h4 class="text-primary">#{!! $key+1 !!} {!! $choice->text !!}
                                    <small>{!! $choice->correct == 1 ? '<span class="fa fa-angle-double-right text-danger"></span> Correct' : '' !!}</small>
                                    </h4>
                                </li>
                            @endforeach
                            <hr>
                        </ul>
                    @empty
                        <h4>Question Not Found...!!</h4>
                        <h5>If you are an Admin please add questions here.</h5>
                        <a class='btn btn-primary btn-xs' href="{{ route('questionair.questions.create', $questionair->id) }}">Add Questions</a><br>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
