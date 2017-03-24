<div class="form-group" data-index="{{ isset($key)? $key : 0 }}">
    <label for="question" class="col-md-3 control-label">Question:</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="ques[{{ isset($key)? $key : 0 }}][question]" value="{{ old('question') }}" placeholder="Enter Question" required autofocus>
    </div>
</div>

<div class="form-group">
    <label for="question" class="col-md-3 control-label">Answer:</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="ques[{{ isset($key)? $key : 0 }}][answer]" value="{{ old('answer') }}" placeholder="Enter Answer" required>
    </div>
</div>

<hr>