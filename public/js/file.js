function bs_input_file() {
    $(".input-file").before(
        function () {
            if (!$(this).prev().hasClass('input-ghost')) {
                var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                element.attr("name", $(this).attr("name"));
                element.attr("accept", ".txt");
                element.change(function () {
                    element.next(element).find('input').val((element.val()).split('\\').pop());
                });
                $(this).find("button.btn-choose").click(function () {
                    element.click();
                });
                $(this).find("button.btn-reset").click(function () {
                    element.val(null);
                    $(this).parents(".input-file").find('input').val('');
                });
                $(this).find('input').css("cursor", "pointer");
                $(this).find('input').mousedown(function () {
                    $(this).parents('.input-file').prev().click();
                    return false;
                });
                return element;
            }
        }
    );
}
$(document).ready(function () {
    $("#fileDown").submit(function (event) {
        event.preventDefault();
        // if(!($('#forValid').val())) return false;

        $token = $('meta[name="csrf-token"]').attr('content');
        let formData = new FormData(event.currentTarget);
        $.ajax({
            url: 'fileAdd',
            method: 'POST',
            dataType: 'json',
            contentType: false,
            processData: false,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $token
            },
        }).done(function (data) {
            // console.log(data);
            if (data.number) {
                $('#results').html(data.number + ' = ' + data.result);
                $("#trigger").removeClass("panel-success");
                $("#trigger").removeClass("panel-danger");

                $("#trigger").addClass("panel-primary");
                getResults();
                $('#addGo').css('display', 'inline');
                $('#editGo').css('display', 'none');
            } else {
                $('#results').html('Нет цифр в данном файле');
                $("#trigger").removeClass("panel-success");
                $("#trigger").removeClass("panel-primary");
                $("#trigger").addClass("panel-danger");
            }
        }).fail(function (data) {
            // console.log(data);
            $('#results').html(data.responseText);
            $("#trigger").removeClass("panel-success");
            $("#trigger").removeClass("panel-primary");
            $("#trigger").addClass("panel-danger");
        })
    });
});
$(function () {
    bs_input_file();
});