<div class="form-group qChoice" id="qChoice{{ isset($key)? $key : 0 }}" data-index="{{ isset($chkey)? $chkey : 0 }}">
    <label for="choice" class="col-md-3 control-label">Choice </label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="ques[{{ isset($key)? $key : 0 }}][choices][{{ isset($chkey)? $chkey : 0 }}][choice]" value="{{ old('choice') }}" placeholder="Enter Choice" required autofocus>
    </div>

    <div class="form-group text-center col-md-3">
        <input class="onchangenone" id="qCheckbox{{ isset($key)? $key : 0 }}" type="checkbox" name="ques[{{ isset($key)? $key : 0 }}][choices][{{ isset($chkey)? $chkey : 0 }}][correct]"> Correct?
        <a type="button" class="del-choice btn btn-xs btn-info" title="Delete Choice">
            Delete
        </a>
    </div>
</div>