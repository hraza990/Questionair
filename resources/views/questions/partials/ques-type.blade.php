<div id="formID{{ isset($key)? $key : 0 }}" class="row qdrop" data-index="{{ isset($key)? $key : 0 }}">
    <div class="form-group col-md-12">
        <div class="col-md-3">
            <label for="type" class="control-label">Question Type:</label>
        </div>
        <div class="col-md-6">
            <select id="selectID{{ isset($key)? $key : 0 }}" class="form-control quesType"  name="ques[{{ isset($key)? $key : 0 }}][type]" autofocus required>
                <option value="" selected disabled>Select Question Type</option>
                <option value="1">Text</option>
                <option value="2">Multiple Choice (Single Option)</option>
                <option value="3">Multiple Choice (Multiple Option)</option>
            </select>
        </div>
        <div class="col-md-3">
            {{--Delete Question Type Dropdown--}}
            <button type="button" class="delete-ques btn btn-danger pull-right">
                Delete Question
            </button>
        </div>
    </div>
</div>
