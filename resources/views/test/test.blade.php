@extends('layout.app')
@section('content')
    <div class="container text-center">

        <div class="table-responsive ">
            <!-- Table -->
            <table id="tablesort" class="table tablesorter">

            </table>

            <!-- Default panel contents -->
        </div>

        <div id="trigger" class="panel panel-success">
            <div id="results" class="panel-heading">Совет: Для удобства начните с первой проверки ("Test post")</div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="site" class="col-md-4 control-label">Site:</label>

                <div class="col-md-6">
                    <input id="site" type="text" class="form-control" name="site" value="ranksonic.com" required
                           autofocus>
                </div>
            </div>


            <div class="form-group">
                <label for="se_name" class="col-md-4 control-label">Search engine domain:</label>

                <div class="col-md-6">
                    <input id="se_name" type="text" class="form-control" name="se_name" value="google.co.uk" required>
                </div>
            </div>

            <div class="form-group">
                <label for="se_language" class="col-md-4 control-label">Search engine language:</label>

                <div class="col-md-6">
                    <select id="se_language" name="se_language" class="selectpicker form-control" required>
                        <option></option>
                        <option selected>English</option>
                        <option>Russian</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="loc_name_canonical" class="col-md-4 control-label">Full name of search engine
                    location:</label>

                <div class="col-md-6">
                    <input id="loc_name_canonical" type="text" class="form-control" name="loc_name_canonical"
                           value="London,England,United Kingdom"
                           onfocus="startAutocomplete()" required>
                </div>
            </div>

            <div class="form-group">
                <label for="key" class="col-md-4 control-label">Keyword:</label>

                <div class="col-md-6">
                    <input id="key" type="text" class="form-control" name="key" value="online rank checker" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button data-id="testpost" type="button" class="btn btn-primary">Test post</button>
                </div>
                <br>
                <br>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="task_id_input" class="col-md-4 control-label">task_id:</label>
                <div class="col-md-6">
                    <input  id="task_id_input" type="text" name="task_id" class="form-control" placeholder="Введите значение или выбирите из списка ниже" required>
                    <select id="task_id_select" class="selectpicker form-control">
                        <option></option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-4">
                <button data-id="testget" type="button" class="btn btn-primary">Test get</button>
            </div>
        </div>
    </div>



    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQGiP-8aFcyPivJHoP1NIi2VKYd4I8BLQ&libraries=places"
            async defer></script>
@endsection
