<script>

    // One Question Displayed by default
    $(document).ready(function(){
        addNewQ();
    });

    // Include Question type Dropdown
    var QRow = `@include('questions.partials.ques-type')`;
    var indexQ = $(QRow).data('index');

    // Add Question
    function addNewQ() {

        var newIndex = $('.container').find('.row').last().data('index') + 1;

        newIndex = isNaN(newIndex) ? (indexQ + 1) : newIndex;

            QRow = QRow.replace('id="formID' + indexQ + '"', 'id="formID' + newIndex + '"');
            QRow = QRow.replace('data-index="' + indexQ + '"', 'data-index="' + newIndex + '"');
            QRow = QRow.replace('ques[' + indexQ + '][type]', 'ques[' + newIndex + '][type]');
            QRow = QRow.replace('id="selectID' + indexQ + '"', 'id="selectID' + newIndex + '"');

        //set new index
        indexQ = newIndex;

        console.log(indexQ);

        $(QRow).appendTo("#AddQtypeHere");
    }

    // Delete Question
    function deleteQ() {
        var current = $(this).parent().parent().parent();

        var qtypedel = current.find('data-index');

        qtypedel.val(-+qtypedel.val());

        current.empty();

        return false;
    }

    $(document).on("click", "#AddQType", addNewQ);
    $(document).on("click", ".delete-ques", deleteQ);

    $(document).on("change", ".quesType", function()
    {
        // Current Select Box
        var selectQ = $(this).parent().parent().parent();
        var indexQ = selectQ.data('index');
        var selectedOpt = selectQ.find('option:selected').val();

        // Once Question Type Selected lets Disable the Dropdown
        var selectBox = $(this).parent().children().eq(0);
        var selectBoxId = selectBox.attr("id");
        $('#'+selectBoxId).prop('disabled', true);

        console.log(selectBoxId);

        // if text Qustion type selected
        if (selectedOpt == 1) {
            var textQ1 = `@include('questions.partials.text')`;
            var indexQ1 = $(textQ1).data('index');

                textQ1 = textQ1.replace('ques[' + indexQ1 + '][question]', 'ques[' + indexQ + '][question]');
                textQ1 = textQ1.replace('ques[' + indexQ1 + '][answer]', 'ques[' + indexQ + '][answer]');


            $('<input name="ques[' + indexQ + '][type]" type="hidden" value="1">').appendTo('#formID'+indexQ);
            console.log(textQ1);
            $(textQ1).appendTo('#formID'+indexQ);
        }
        // if multiChoice-singleOpt selected
        if (selectedOpt == 2) {
            var textQ2 = `@include('questions.partials.multiChoice-singleOpt')`;
            var indexQ2 = $(textQ2).data('index');

                textQ2 = textQ2.replace('ques[' + indexQ2 + '][question]', 'ques[' + indexQ + '][question]');
                textQ2 = textQ2.replace('id="qType2' + indexQ2 + '"', 'id="qType2' + indexQ + '"');

            $('<input name="ques[' + indexQ + '][type]" type="hidden" value="2">').appendTo('#formID'+indexQ);
            console.log(textQ2);
            $(textQ2).appendTo('#formID'+indexQ);
        }
        // if multiChoice-multiOpt selected
        if (selectedOpt == 3) {
            var textQ3 = `@include('questions.partials.multiChoice-multiOpt')`;
            var indexQ3 = $(textQ3).data('index');


                textQ3 = textQ3.replace('ques[' + indexQ3 + '][question]', 'ques[' + indexQ + '][question]');
                textQ3 = textQ3.replace('id="qType3' + indexQ3 + '"', 'id="qType3' + indexQ + '"');

            $('<input name="ques[' + indexQ + '][type]" type="hidden" value="3">').appendTo('#formID'+indexQ);
            console.log(textQ3);
            $(textQ3).appendTo('#formID'+indexQ);
        }

    });

    // Add Choice in multiChoice-singleOpt
    $(document).on("click", ".add-choice2", function()
    {
        // index of Current Question
        var currentQindex = $(this).parent().parent();
        var Qindex = currentQindex.data('index');

        // Add New Choice Input Row
        var choice = `@include('questions.partials.choice')`;
        var choiceIndex = $(choice).data('index');

        // New Index for New Choice
        var newch = $('.qChoice').last().data('index') + 1;
        newch = isNaN(newch) ? (choiceIndex + 1) : newch;

            choice = choice.replace('id="qChoice' + choiceIndex + '"', 'id="qChoice' + Qindex+newch + '"');
            choice = choice.replace('data-index="' + choiceIndex + '"', 'data-index="' + newch + '"');
            choice = choice.replace('class="onchangenone"', 'class="onchange"');
            choice = choice.replace('id="qCheckbox' + choiceIndex + '"', 'id="qCheckbox' + Qindex+newch + '"');
            choice = choice.replace('ques[' + choiceIndex + '][choices][' + choiceIndex + '][choice]', 'ques[' + Qindex + '][choices][' + newch + '][choice]');
            choice = choice.replace('ques[' + choiceIndex + '][choices][' + choiceIndex + '][correct]', 'ques[' + Qindex + '][choices][' + newch + '][correct]');

        console.log(choice);

        $(choice).appendTo('#qType2'+Qindex);

    });

    // Add Choice in multiChoice-multiOpt
    $(document).on("click", ".add-choice3", function()
    {
        // Index of Current Question
        var currentQindex = $(this).parent().parent();
        var Qindex = currentQindex.data('index');

        // Add New Choice Input Row
        var choice = `@include('questions.partials.choice')`;
        var choiceIndex = $(choice).data('index');

        // New Index for New Choice
        var newch = $('.qChoice').last().data('index') + 1;
        newch = isNaN(newch) ? (choiceIndex + 1) : newch;

            choice = choice.replace('id="qChoice' + choiceIndex + '"', 'id="qChoice' + Qindex+newch + '"');
            choice = choice.replace('data-index="' + choiceIndex + '"', 'data-index="' + newch + '"');
            choice = choice.replace('id="qCheckbox' + choiceIndex + '"', 'id="qCheckbox' + Qindex+newch + '"');
            choice = choice.replace('class="onchange"', 'class="onchangenone"');
            choice = choice.replace('ques[' + choiceIndex + '][choices][' + choiceIndex + '][choice]', 'ques[' + Qindex + '][choices][' + newch + '][choice]');
            choice = choice.replace('ques[' + choiceIndex + '][choices][' + choiceIndex + '][correct]', 'ques[' + Qindex + '][choices][' + newch + '][correct]');

        console.log(choice);

        $(choice).appendTo('#qType3'+Qindex);

    });

    // Delete Choice Choice
    $(document).on("click", ".del-choice", function()
    {
        //Current Choice
        var currentChoice = $(this).parent().parent();
        var currentChoiceDel = currentChoice.data('index');

        // Current Question
        var currentQ = $(this).parent().parent().parent().parent();
        var currentQid = currentQ.attr('data-index');

        //Current Choice Delete
        $('#qChoice'+currentQid+currentChoiceDel).remove();

        console.log(currentChoiceDel);

        return false;
    });

    $(document).on("change", ".onchange", function()
    {
        //Current Choice
        var current = $(this).parent().children().eq(0);
        var currentCheckBox = $(current).attr("id");

        // Current Question
        var currentQ = $(this).parent().parent().parent().parent();
        var currentQid = currentQ.attr('data-index');

        // Uncheck All Choices of the current Question
        var i = 1;
        do {
            $('#qCheckbox'+currentQid+i).prop('checked', false);
            i++;
        }
        while (i < 10);

        // Check Current Choice
        $('#'+currentCheckBox).prop('checked', true);

        console.log(currentCheckBox);

        return false;
    });

</script>


