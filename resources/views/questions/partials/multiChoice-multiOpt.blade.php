<div class="form-group" data-index="{{ isset($key)? $key : 0 }}">
    <label for="question" class="col-md-3 control-label">Question:</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="ques[{{ isset($key)? $key : 0 }}][question]" value="{{ old('question') }}" placeholder="Enter Question" required autofocus>
    </div>
</div>

<div id="qType3{{ isset($key)? $key : 0 }}">

</div>

<div class="form-group text-center">
    <a type="button" class="add-choice3 btn btn-sm btn-info">
        Add Choice
    </a>
</div>

<hr>