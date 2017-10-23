$(document).ready(function() {
    $token = $('meta[name="csrf-token"]').attr('content');

    $(".btn-primary").click(function () {

        $id = $(this).data('id');
        if($id === 'testget'){
            $type = 'GET';
            $url = 'testget'
        }else if($id === 'testpost'){
            $type = 'POST';
            $url = 'testpost'
        }
        dataTest($type, $url);
    });

});

function dataTest(type, url) {
    var data;
    if(type === 'POST'){
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
    }else if(type === 'GET' ){
        var task_id = document.getElementById('task_id').value;
        data = {
          'task_id': task_id
        };
    }


    $.ajax({
        type: type,
        url: url,
        data: data,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $token
        },
        // success:
    }).done(function (data) {
        $('#task_id').empty();
        var text = '';
        for(var i in data){
            for(var j in data[i]){
                if(j === 'task_id'){
                    text += '<b>' + j + ' = '+ data[i][j] + '</b><br>';
                }else {
                    text += j + ' = '+ data[i][j] + '<br>';
                }
            }
            text += '<br>';
            $( '#task_id' ).append( '<option value="' + data[i].task_id + '">' + data[i].task_id + '</option>' );
        }
        $('.results').html(text);
    });
}

function startAutocomplete() {
    var autocomplete = new google.maps.places.Autocomplete((document.getElementById('loc_name_canonical')), {types: ['geocode']});
}