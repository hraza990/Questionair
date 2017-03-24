@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading"> <h2>{!! $questionair->name !!} [ Questions:

                        @forelse($questionair->QuestionsCount as $q_count)
                            {{ $q_count->Count }}
                        @empty
                            0
                        @endforelse ]

                        <small> Duration: {!! $questionair->duration !!}</small></h2> </div>

                <div>
                    @forelse($questions as $que => $question)
                        <h3 class="text-center text-danger">Q#{!! $que+1 !!} {!! $question->question !!}
                            <small>[Type:
                                @if($question->type == 1)
                                    Text
                                @elseif($question->type == 2)
                                    Multiple Choice (Single Option)
                                @elseif($question->type == 3)
                                    Multiple Choice (Multiple Option)
                                @endif
                            ]</small>
                        </h3>
                        <ul class="list-unstyled">
                            {{--{!! dd($question) !!}--}}
                            @foreach($question->QChoices as $key => $choice)
                            <li class="text-center">
                                <h4 class="text-primary">#{!! $key+1 !!} {!! $choice->text !!}
                                <small>{!! $choice->correct == 1 ? '<span class="fa fa-angle-double-right text-danger"></span> Correct' : '' !!}</small>
                                </h4>
                            </li>
                            @endforeach
                            <hr>
                        </ul>
                    @empty
                        <h4>Not Found...!!</h4>
                    @endforelse
                </div>
            </div>
            <div class="text-center">
                {{ $questions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
