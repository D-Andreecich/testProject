$(function () {
    $('#datetimepicker1').datetimepicker({
        format: "YYYY-MM-DD HH:mm:ss",
    });
});

$(function () {
    $('#datetimepicker2').datetimepicker({
        format: "YYYY-MM-DD HH:mm:ss",
    });
});

$(document).ready(function () {
    $result = {};
    $idBank = null;
    $token = $('meta[name="csrf-token"]').attr('content');

    getResults();

    $("form").submit(function (event) {
        event.preventDefault();
    });

    $("#addGo").click(function () {
        dataTest();
    });

    $("#editGo").click(function () {
        editBanks($idBank);
    });

    $("#task_id_select").click(function () {
        $("#task_id_input").val($(this).val());
    });
});


function dataTest() {
    let address_bank = document.getElementById('address_bank').value;
    let name_personal = document.getElementById('name_personal').value;
    let rating_bank = +document.getElementById('rating_bank').value;
    let rating_atm = +document.getElementById('rating_atm').value;
    let rating_pb24 = +document.getElementById('rating_pb24').value;
    let startWork = document.getElementById('startWork').value;
    let endWork = document.getElementById('endWork').value;

    let data = {
        'address_bank': address_bank,
        'name_personal': name_personal,
        'rating_bank': rating_bank,
        'rating_atm': rating_atm,
        'rating_pb24': rating_pb24,
        'startWork': startWork,
        'endWork': endWork,
    };

    $.ajax({
        type: 'POST',
        url: 'addBanks',
        data: data,
        headers: {
            'X-CSRF-TOKEN': $token
        }
    }).done(function (data) {
        $('#results').html('status : ' + data);
        if (data) {
            $("#trigger").removeClass("panel-success");
            $("#trigger").removeClass("panel-danger");

            $("#trigger").addClass("panel-primary");
            getResults();
            clearInput();
        } else {
            $("#trigger").removeClass("panel-success");
            $("#trigger").removeClass("panel-primary");
            $("#trigger").addClass("panel-danger");
        }
    });
}

function editBanks(id) {
    let address_bank = document.getElementById('address_bank').value;
    let name_personal = document.getElementById('name_personal').value;
    let rating_bank = +document.getElementById('rating_bank').value;
    let rating_atm = +document.getElementById('rating_atm').value;
    let rating_pb24 = +document.getElementById('rating_pb24').value;
    let startWork = document.getElementById('startWork').value;
    let endWork = document.getElementById('endWork').value;

    let data = {
        'id': id,
        'address_bank': address_bank,
        'name_personal': name_personal,
        'rating_bank': rating_bank,
        'rating_atm': rating_atm,
        'rating_pb24': rating_pb24,
        'startWork': startWork,
        'endWork': endWork,
    };

    $.ajax({
        type: 'POST',
        url: 'editBanks',
        data: data,
        headers: {
            "Content-Type":"application/json",
            'X-CSRF-TOKEN': $token
        }
    }).done(function (data) {
        $('#results').html('status : ' + data);
        if (data) {
            $("#trigger").removeClass("panel-success");
            $("#trigger").removeClass("panel-danger");

            $("#trigger").addClass("panel-primary");
            getResults();
            $('#addGo').css('display', 'inline');
            $('#editGo').css('display', 'none');
            clearInput();
        } else {
            $("#trigger").removeClass("panel-success");
            $("#trigger").removeClass("panel-primary");
            $("#trigger").addClass("panel-danger");
        }
    });
}

function clearInput() {
    document.getElementById('address_bank').value = '';
    document.getElementById('name_personal').value = '';
    document.getElementById('rating_bank').value = '';
    document.getElementById('rating_atm').value = '';
    document.getElementById('rating_pb24').value = '';
    document.getElementById('startWork').value = '';
    document.getElementById('endWork').value = '';
}

function getResults() {

    $.ajax({
        type: 'POST',
        url: 'getBanks',
        dataType: 'json',
        headers: {
            "Content-Type":"application/json",
            'X-CSRF-TOKEN': $token
        },
    }).done(function (data) {
        $result = data;
        if (data.length != '0') {
            $('#task_id_select').empty();
            let thead = '<thead><tr>';
            let tbody = '<tbody>';
            for (let i in data) {
                tbody += '<tr>';
                for (let j in data[i]) {
                    if (i == 0) {
                        thead += '<th id="' + j + '_id' + '" class="btn-default" style="white-space:nowrap;">' + '<i class="glyphicon glyphicon-sort-by-attributes"></i> ' + j + '</th>';
                    }
                    tbody += '<th>' + data[i][j] + '</th>';
                }
                tbody += '<th>' +
                    '<button type="button" id="editBank" onclick="editBank(this.value)" value="' + data[i].id + '" class="btn btn-default" aria-label="Left Align">' +
                    '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>' +
                    '</button>' +
                    '<button type="button" id="delBank" onclick="dellBank(this.value)" value="' + data[i].id + '" class="btn btn-default" aria-label="Left Align">' +
                    '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>' +
                    '</button>' +
                    '</th>';
                tbody += '</tr>';
                $('#task_id_select').append('<option value="' + data[i].task_id + '">' + data[i].task_id + '</option>');
            }
            thead += '<th class="btn-default" style="white-space:nowrap;"></th>';

            thead += '</tr></thead>';
            tbody += '</tbody>';

            $('.table').html(thead + tbody);
        }
        $("table").tablesorter();
    });
}
function dellBank(id) {
    $.ajax({
        type: 'POST',
        url: 'delBanks',
        data: {'id': id},
        headers: {
            'X-CSRF-TOKEN': $token
        },
    }).done(function (data) {
        $('#results').html('status : ' + data);
        if (data) {
            $("#trigger").removeClass("panel-success");
            $("#trigger").removeClass("panel-danger");

            $("#trigger").addClass("panel-primary");
            getResults();
            clearInput();
        } else {
            $("#trigger").removeClass("panel-success");
            $("#trigger").removeClass("panel-primary");
            $("#trigger").addClass("panel-danger");
        }
    });
}

function editBank(id) {
    $idBank = id;
    let data = $.grep($result, function (e) {
        return e.id == id;
    })[0];
    document.getElementById('address_bank').value = data.address_bank;
    document.getElementById('name_personal').value = data.name_personal;
    document.getElementById('rating_bank').value = data.rating_bank;
    document.getElementById('rating_atm').value = data.rating_atm;
    document.getElementById('rating_pb24').value = data.rating_pb24;
    document.getElementById('startWork').value = data.startWork;
    document.getElementById('endWork').value = data.endWork;
    $('#addGo').css('display', 'none');
    $('#editGo').css('display', 'inline');
}

function startAutocomplete() {
    let autocomplete = new google.maps.places.Autocomplete((document.getElementById('loc_name_canonical')), {types: ['geocode']});
}

function changeClass(id) {
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