$(document).ready(function () {
    $token = $('meta[name="csrf-token"]').attr('content');

    getResults();

    $(".btn-primary").click(function () {

        $id = $(this).data('id');
        if ($id === 'testget') {
            $type = 'GET';
            $url = 'testget'
        } else if ($id === 'testpost') {
            $type = 'POST';
            $url = 'testpost'
        }
        dataTest($type, $url);
    });

    $("#task_id_select").click(function () {
        $("#task_id_input").val($(this).val());
    });


});


function dataTest(type, url) {
    var data;
    if (type === 'POST') {
        var site = document.getElementById('site').value;
        var se_name = document.getElementById('se_name').value;
        var se_language = document.getElementById('se_language').value;
        var VRegExp = new RegExp(/,\s/g);
        var loc_name_canonical = document.getElementById('loc_name_canonical').value.replace(VRegExp, ',');
        var key = document.getElementById('key').value;
        data = {
            'site': site,
            'se_name': se_name,
            'se_language': se_language,
            'loc_name_canonical': loc_name_canonical,
            'key': key
        };
    } else if (type === 'GET') {
        var task_id = document.getElementById('task_id_input').value;
        if (task_id === '' && document.getElementById('task_id_select').value !== '') {
            task_id = document.getElementById('task_id_select').value;
            $("#task_id_input").val($("#task_id_select").val());
        } else if (document.getElementById('task_id_select').value === '') {
            $('#results').html('status : ' + 'error [ task_id ]');
            $("#trigger").removeClass("panel-success");
            $("#trigger").removeClass("panel-primary");
            $("#trigger").addClass("panel-danger");
            return false
        }
        data = {
            'task_id': task_id
        };
    }

    $.ajax({
        type: type,
        url: url,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $token
        },
    }).done(function (data) {
        $('#results').html('status : ' + data);
        if (data.split(' ')['0'] === 'ok') {
            $("#trigger").removeClass("panel-success");
            $("#trigger").removeClass("panel-danger");

            $("#trigger").addClass("panel-primary");

            getResults();
        } else {
            $("#trigger").removeClass("panel-success");
            $("#trigger").removeClass("panel-primary");
            $("#trigger").addClass("panel-danger");
        }
    });
}

function getResults() {

    $.ajax({
        type: 'POST',
        url: 'result',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $token
        },
    }).done(function (data) {
        if (data.length != '0') {
            $('#task_id_select').empty();
            var thead = '<thead><tr>';
            var tbody = '<tbody>';
            for (var i in data) {
                tbody += '<tr>';
                for (var j in data[i]) {
                    if (i == 0) {
                        thead += '<th id="' + j + '" class="btn-default" style="white-space:nowrap;">' + '<i class="glyphicon glyphicon-sort-by-attributes"></i> ' + j + '</th>';
                    }
                    tbody += '<th>' + data[i][j] + '</th>';
                }
                tbody += '</tr>';
                $('#task_id_select').append('<option value="' + data[i].task_id + '">' + data[i].task_id + '</option>');

            }
            thead += '</tr></thead>';
            tbody += '</tbody>';

            $('.table').html(thead + tbody);
        }
        $("table").tablesorter();
    });
}

function startAutocomplete() {
    var autocomplete = new google.maps.places.Autocomplete((document.getElementById('loc_name_canonical')), {types: ['geocode']});
}


// $(document).on('click', 'th', function () {
function changeClass(id){
    $tempId = id.attr("id");
    $id = '#' + $tempId;
    if ($($id).children('i').attr("class") === 'glyphicon glyphicon-sort-by-attributes') {
        $($id).children('i').removeClass("glyphicon-sort-by-attributes");
        $('th').children('i').removeClass("glyphicon-sort-by-attributes-alt");
        $('th').children('i').addClass("glyphicon-sort-by-attributes");
        $($id).children('i').addClass("glyphicon-sort-by-attributes-alt");
    } else {
        $($id).children('i').removeClass("glyphicon-sort-by-attributes-alt");
        $('th').children('i').removeClass("glyphicon-sort-by-attributes-alt");
        $('th').children('i').addClass("glyphicon-sort-by-attributes");
        $($id).children('i').addClass("glyphicon-sort-by-attributes");
    }
}