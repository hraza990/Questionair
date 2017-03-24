@foreach($questions as $key => $question) @php $key = $key+1; @endphp
    <div id="formID{{ isset($key)? $key : 0 }}" class="row qdrop" data-index="{{ isset($key)? $key : 0 }}">
        <div class="form-group col-md-12">
            <div class="col-md-3">
                <label for="type" class="control-label">Q#{!! $key !!} Question Type:</label>
            </div>
            <div class="col-md-6">
                <select id="selectID{{ isset($key)? $key : 0 }}" class="form-control quesType"  name="ques[{{ isset($key)? $key : 0 }}][type]" disabled="disabled"  required>
                    <option value="" selected disabled>Select Question Type</option>
                    <option {!! $question->type == 1 ? 'selected="selected"' : '' !!} value="1">Text</option>
                    <option {!! $question->type == 2 ? 'selected="selected"' : '' !!} value="2">Multiple Choice (Single Option)</option>
                    <option {!! $question->type == 3 ? 'selected="selected"' : '' !!} value="3">Multiple Choice (Multiple Option)</option>
                </select>
            </div>
            <div class="col-md-3">
                {{--Delete Question Type Dropdown--}}
                <button type="button" class="delete-ques btn btn-danger pull-right">
                    Delete Question
                </button>
            </div>
        </div>

        {{--Each Question--}}
        <div class="form-group" data-index="{{ isset($key)? $key : 0 }}">
            <label for="question" class="col-md-3 control-label">Question:</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="ques[{{ isset($key)? $key : 0 }}][question]" value="{{ $question->question }}" placeholder="Enter Question" required>
            </div>
        </div>

        @foreach($question->QChoices as $chkey => $qchoice) @php $chkey = $chkey+1; @endphp
            @if($question->type == 1)

                <input name="ques[{{ isset($key)? $key : 0 }}][type]" type="hidden" value="1">

                <div class="form-group">
                    <label for="question" class="col-md-3 control-label">Answer:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="ques[{{ isset($key)? $key : 0 }}][answer]" value="{{ $qchoice->text }}" placeholder="Enter Answer" required>
                    </div>
                </div>

                <hr>
            @elseif($question->type == 2)

                <div id="qType2{{ isset($key)? $key : 0 }}">

                    <input name="ques[{{ isset($key)? $key : 0 }}][type]" type="hidden" value="2">

                    <div class="form-group qChoice" id="qChoice{{ isset($key)? $key : 0 }}{{ isset($chkey)? $chkey : 0 }}" data-index="{{ isset($chkey)? $chkey : 0 }}">
                        <label for="choice" class="col-md-3 control-label">Choice </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="ques[{{ isset($key)? $key : 0 }}][choices][{{ isset($chkey)? $chkey : 0 }}][choice]" value="{{ $qchoice->text }}" placeholder="Enter Choice" required>
                        </div>

                        <div class="form-group text-center col-md-3">
                            <input class="onchange" {!! $qchoice->correct == 1 ? 'checked="checked"' : '' !!} id="qCheckbox{{ isset($key)? $key : 0 }}{{ isset($chkey)? $chkey : 0 }}" type="checkbox" name="ques[{{ isset($key)? $key : 0 }}][choices][{{ isset($chkey)? $chkey : 0 }}][correct]"> Correct?
                            <a type="button" class="del-choice btn btn-xs btn-info" title="Delete Choice">
                                Delete
                            </a>
                        </div>
                    </div>

                </div>

                @if ($loop->last)
                    <div class="form-group text-center">
                        <a type="button" class="add-choice2 btn btn-sm btn-info">
                            Add Choice
                        </a>
                    </div>

                    <hr>
                @endif

            @elseif($question->type == 3)


                <div id="qType3{{ isset($key)? $key : 0 }}">

                    <input name="ques[{{ isset($key)? $key : 0 }}][type]" type="hidden" value="3">

                    <div class="form-group qChoice" id="qChoice{{ isset($key)? $key : 0 }}{{ isset($chkey)? $chkey : 0 }}" data-index="{{ isset($chkey)? $chkey : 0 }}">
                        <label for="choice" class="col-md-3 control-label">Choice </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="ques[{{ isset($key)? $key : 0 }}][choices][{{ isset($chkey)? $chkey : 0 }}][choice]" value="{{ $qchoice->text }}" placeholder="Enter Choice" required>
                        </div>

                        <div class="form-group text-center col-md-3">
                            <input class="onchangenone" {!! $qchoice->correct == 1 ? 'checked="checked"' : '' !!} id="qCheckbox{{ isset($key)? $key : 0 }}{{ isset($chkey)? $chkey : 0 }}" type="checkbox" name="ques[{{ isset($key)? $key : 0 }}][choices][{{ isset($chkey)? $chkey : 0 }}][correct]"> Correct?
                            <a type="button" class="del-choice btn btn-xs btn-info" title="Delete Choice">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>

                @if ($loop->last)
                    <div class="form-group text-center">
                        <a type="button" class="add-choice3 btn btn-sm btn-info">
                            Add Choice
                        </a>
                    </div>

                    <hr>
                @endif
            @endif
        @endforeach

        @php unset($chkey); @endphp

    </div>
@endforeach