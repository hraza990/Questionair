@extends('layouts.app')

@section('style')
    <style>
        #clockDiv{
            font-size: 30px;
            font-family: Verdana;
            font-weight: 700;
            display: block;
            text-align: right;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        Exam {!! $questionair->name !!} <small class="text-danger">  - Total #Q.
                        [ {{ count($questionair->Questions) > 0 ? count($questionair->Questions) : 0 }} ]
                        Duration: [ {!! $questionair->duration !!} ]</small>
                    </h2>
                    <span id="clockDiv" class="text-danger"></span>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" id="testForm" role="form" method="POST" action="{{ url('questionair/'.$id.'/exam') }}">
                        {{ csrf_field() }}

                        @if($questionair->resumeable == 1)
                            <button type="submit" id="pauseBtn" name="pause" value="pause" class="btn btn-danger btn-md pull-right">
                                <i class="fa fa-pause" aria-hidden="true"></i> Pause
                            </button>
                        @endif

                        {{--Test Time on Pause--}}
                        <input type="hidden" id="testTime" name="testtime" value="">

                        @if(count($questionair->Questions) > 0)
                            @foreach($questionair->Questions as $key => $question) @php $key = $key+1; @endphp
                                <div>
                                    <div class="col-md-12">
                                        {!! $question->type == 1 ? 'Q. Type: Text - Write you answer.' : '' !!}
                                        {!! $question->type == 2 ? 'Q. Type: Multiple Choice (Single Option) - Select any one Option from the choices' : '' !!}
                                        {!! $question->type == 3 ? 'Q. Type: Multiple Choice (Multiple Option) - You can select multiple Option from the choices' : '' !!}
                                    </div>

                                    {{--Question Type--}}
                                    <input type="hidden" name="ques[{{ isset($key)? $key : 0 }}][type]" value="{!! $question->type !!}">
                                    {{--Question ID--}}
                                    <input type="hidden" name="ques[{{ isset($key)? $key : 0 }}][question_id]" value="{{ $question->id }}">

                                    {{--Each Question--}}
                                    <div class="col-md-12">
                                        <h2 class="text-primary">Q#.{{ isset($key)? $key : 0 }} {{ $question->question }}</h2>
                                    </div>

                                    @foreach($question->QChoices as $chkey => $qchoice) @php $chkey = $chkey+1; @endphp
                                        <div class="form-group">
                                            <label for="question" class="col-md-2 control-label">{{ $question->type == 1 ? 'Answer:' : '#'.$chkey }}</label>
                                            <div class="col-md-10">
                                                @if($question->type == 1)
                                                    <input type="text" class="form-control" name="ques[{{ isset($key)? $key : 0 }}][text_answer]" value="{{ isset($qchoice->examChoices[0]) ? $qchoice->examChoices[0]->text_answer : '' }}" placeholder="Enter Answer">
                                                    <input type="hidden" name="ques[{{ isset($key)? $key : 0 }}][choice_id]" value="{!! $qchoice->id !!}">
                                                @elseif($question->type == 2)
                                                    @if(count($qchoice->examChoices))
                                                        @foreach($qchoice->examChoices as $choikey => $selected)
                                                            <input type="radio" {!! $selected->choice_id == $qchoice->id ? 'checked="checked"' : '' !!} name="ques[{{ isset($key)? $key : 0 }}][choice_id]" value="{!! $qchoice->id !!}">{!! $qchoice->text !!}<br>
                                                        @endforeach
                                                    @else
                                                        <input type="radio" name="ques[{{ isset($key)? $key : 0 }}][choice_id]" value="{!! $qchoice->id !!}">{!! $qchoice->text !!}<br>
                                                    @endif
                                                @elseif($question->type == 3)
                                                    @if(count($qchoice->examChoices))
                                                        @foreach($qchoice->examChoices as $choikey => $selected)
                                                            <input type="checkbox" {!! $selected->choice_id == $qchoice->id ? 'checked="checked"' : '' !!} name="ques[{{ isset($key)? $key : 0 }}][choices][{{ isset($chkey)? $chkey : 0 }}][choice_id]" value="{!! $qchoice->id !!}">{!! $qchoice->text !!}<br>
                                                        @endforeach
                                                    @else
                                                        <input type="checkbox" name="ques[{{ isset($key)? $key : 0 }}][choices][{{ isset($chkey)? $chkey : 0 }}][choice_id]" value="{!! $qchoice->id !!}">{!! $qchoice->text !!}<br>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    <hr>

                                </div>
                            @endforeach
                        @endif

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" value="submited" class="btn btn-primary pull-right">
                                    Submit Exam
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

@section('script')
    <script src="/js/jquery.countdown.min.js"></script>
    <div id="getting-started"></div>
    <script type="text/javascript">
        $("span#clockDiv").countdown("{{ $duration }}", function(event) {
            $(this).text(
                    event.strftime('%H:%M:%S') //%Y %m %d %H:%M:%S
            );
        });

        $('#pauseBtn').click(function() {
            $("#testTime").countdown("{{ $duration }}", function(event) {
                $(this).val(
                        event.strftime('%H:%M:%S')
                );
            });
            $('#testForm').submit();
        });
    </script>
@endsection
