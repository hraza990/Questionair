@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> <h2>My Exams <small>Start your test now...</small></h2> </div>

                <div class="panel-body">
                    <table class="table table-striped custab">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>#Question</th>
                                <th>Answer/Choices</th>
                                <th>You Answer</th>
                                <th class="text-center">Right/Wrong</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $key => $question)


                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                {!! $question->type == 1 ? 'Text' : '' !!}
                                                {!! $question->type == 2 ? 'Multiple Choice (Single Option)' : '' !!}
                                                {!! $question->type == 3 ? 'Multiple Choice (Multiple Option)' : '' !!}
                                            </td>
                                            <td>{{ $question->question }}</td>

                                            <td>
                                                @foreach($question->QChoices as $chkey => $choice)
                                                    @if($question->type == 1)
                                                        @foreach($choice->examChoices as $chExmkey => $choiceAns)
                                                            {{ $choice->text }}
                                                        @endforeach
                                                    @endif
                                                    @if($question->type == 2)
                                                        @if($choice->correct == 1)
                                                            [{!! $chkey+1 !!}] <span class="text-success">{{ $choice->text }}</span><br>
                                                        @else
                                                            [{!! $chkey+1 !!}] <span class="text-danger">{{ $choice->text }}</span><br>
                                                        @endif
                                                    @endif
                                                    @if($question->type == 3)
                                                        @if($choice->correct == 1)
                                                            [{!! $chkey+1 !!}] <span class="text-success">{{ $choice->text }}</span><br>
                                                        @else
                                                            [{!! $chkey+1 !!}] <span class="text-danger">{{ $choice->text }}</span><br>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>

                                            <td>
                                                @foreach($question->QChoices as $chkey => $choice)
                                                    @if(isset($choice->examChoices))
                                                        @if($question->type == 1)
                                                            @foreach($choice->examChoices as $chExmkey => $choiceAns)
                                                                {{ $choiceAns->text_answer }}
                                                            @endforeach
                                                        @endif
                                                        @if($question->type == 2)
                                                            @foreach($choice->examChoices as $chExmkey => $choiceAns)
                                                                @if($choiceAns->exmChoice->correct == 1)
                                                                    [{!! $chkey+1 !!}] <span class="text-success">{{ $choiceAns->exmChoice->text }}</span><br>
                                                                @else
                                                                    [{!! $chkey+1 !!}] <span class="text-danger">{{ $choiceAns->exmChoice->text }}</span><br>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @if($question->type == 3)
                                                            @foreach($choice->examChoices as $chExmkey => $choiceAns)
                                                                @if($choiceAns->exmChoice->correct == 1)
                                                                    [{!! $chkey+1 !!}] <span class="text-success">{{ $choiceAns->exmChoice->text }}</span><br>
                                                                @else
                                                                    [{!! $chkey+1 !!}] <span class="text-danger">{{ $choiceAns->exmChoice->text }}</span><br>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>

                                            <td>
                                                @foreach($question->QChoices as $chkey => $choice)
                                                    @if(isset($choice->examChoices))
                                                        @if($question->type == 1)
                                                            @foreach($choice->examChoices as $chExmkey => $choiceAns)
                                                                {{ strcasecmp($choice->text, $choiceAns->text_answer) == 0  ? 'Right' : 'Wrong' }}
                                                            @endforeach
                                                        @endif
                                                        @if($question->type == 2)
                                                            @foreach($choice->examChoices as $chExmkey => $choiceAns)
                                                                {{ $choice->id == $choiceAns->choice_id ? 'Right' : 'Wrong' }}
                                                            @endforeach
                                                        @endif
                                                        @if($question->type == 3)
                                                            @foreach($choice->examChoices as $chExmkey => $choiceAns)
                                                                [{!! $chkey+1 !!}] {{ $choice->id == $choiceAns->choice_id ? 'Right' : 'Wrong' }}<br>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endforeach
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
