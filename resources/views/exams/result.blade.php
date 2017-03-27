@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> <h2>My Exams Result</h2> </div>

                <div class="panel-body">
                    <table class="table table-striped custab">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>#Question</th>
                                <th>Answer/Choices</th>
                                <th>You Answer</th>
                                <th>Right/Wrong</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questionair->Questions as $key => $question)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        {!! $question->type == 1 ? 'Text' : '' !!}
                                        {!! $question->type == 2 ? 'MultiChoice SingleOpt' : '' !!}
                                        {!! $question->type == 3 ? 'MultiChoice MultiOpt' : '' !!}
                                    </td>
                                    <td>{{ $question->question }}</td>

                                    <td>
                                        @if(isset($question->QChoices))
                                            @foreach($question->QChoices as $chkey => $choice)
                                                @if($question->type == 1)
                                                    @foreach($choice->examChoices as $chExmkey => $choiceAns)
                                                        {{ $choice->text }}
                                                    @endforeach
                                                @endif
                                                @if($question->type == 2 OR $question->type == 3)
                                                    @if($choice->correct == 1)
                                                        <i class="fa fa-check text-primary" aria-hidden="true"></i> [{!! $chkey+1 !!}] <span class="text-primary">{{ $choice->text }}</span><br>
                                                    @else
                                                        <i class="fa fa-close text-danger" aria-hidden="true"></i> [{!! $chkey+1 !!}] <span class="text-danger">{{ $choice->text }}</span><br>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        @if(isset($question->QChoices))
                                            @foreach($question->QChoices as $chkey => $choice)
                                                @if(isset($choice->examChoices))
                                                    @foreach($choice->examChoices as $chExmkey => $choiceAns)
                                                        @if($question->type == 1)
                                                            {{ $choiceAns->text_answer }}
                                                        @endif
                                                        @if($question->type == 2 OR $question->type == 3)
                                                            @if($choiceAns->exmChoice->correct == 1)
                                                                <i class="fa fa-check text-primary" aria-hidden="true"></i> [{!! $chkey+1 !!}] <span class="text-primary">{{ $choiceAns->exmChoice->text }}</span><br>
                                                            @else
                                                                <i class="fa fa-close text-danger" aria-hidden="true"></i> [{!! $chkey+1 !!}] <span class="text-danger">{{ $choiceAns->exmChoice->text }}</span><br>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        @foreach($question->QChoices as $chkey => $choice)
                                            @if(isset($choice->examChoices))
                                                @foreach($choice->examChoices as $chExmkey => $choiceAns)
                                                    @if($question->type == 1)
                                                        {{ strcasecmp($choice->text, $choiceAns->text_answer) == 0  ? 'Right' : 'Wrong' }}
                                                    @elseif($question->type == 2 OR $question->type == 3)
                                                        {{ $choice->correct == 1 ? 'Right' : 'Wrong' }}<br>
                                                    @endif
                                                @endforeach
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
