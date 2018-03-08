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
            <div id="results" class="panel-heading">Статус: Очікування дій</div>
        </div>

        <div class="panel-body">
            <form method="POST" id="formTabl">
                <div class="form-group">
                    <label for="address_bank" class="col-md-4 control-label">Адреса:</label>

                    <div class="col-md-6">
                        <input id="address_bank" type="text" class="form-control" name="address_bank"
                               value=""
                               placeholder="London,England,United Kingdom"
                               onfocus="startAutocomplete()" required>
                    </div>

                </div>


                <div class="form-group">
                    <label for="name_personal" class="col-md-4 control-label">Ім'я персоналу:</label>

                    <div class="col-md-6">
                        <div>
                            <input id="name_personal" type="text" name="name_personal" class="form-control"
                                   value="" placeholder="Прізвище ім'я по батькові" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="rating_bank" class="col-md-4 control-label">Обслуговування в банку:</label>

                    <div class="col-md-6">
                        <div class="form-control">
                            <input id="rating_bank" name="rating_bank" type="hidden" class="rating" value="0"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="rating_atm" class="col-md-4 control-label">Обслуговування в банкоматі:</label>

                    <div class="col-md-6">
                        <div class="form-control">
                            <input id="rating_atm" name="rating_atm" type="hidden" class="rating" value="0"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="rating_pb24" class="col-md-4 control-label">Обслуговування в Приват24:</label>

                    <div class="col-md-6">
                        <div class="form-control">
                            <input id="rating_pb24" name="rating_pb24" type="hidden" class="rating" value="0"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="startWork" class="col-md-4 control-label">Час початку обслуговування:</label>

                    <div class="col-md-6">

                        <div id="datetimepicker1" class="input-append date input-group">
                            <input id="startWork" type="text" class="form-control" placeholder="2018-01-01 00:00:00" required/>
                            <span class="input-group-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="endWork" class="col-md-4 control-label">Час закінчення обслуговування:</label>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker2'>
                                <input id="endWork" type='text' class="form-control" placeholder="2018-01-01 00:00:00" required/>
                                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                            <button id="editGo" type="submit" class="btn btn-primary" style="display: none">Редагувати відгук</button>
                            <button id="addGo" type="submit" class="btn btn-primary" style="display: inline">Додати відгук</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA7XJG_r0qNPxw0hIWZH6O2JX-m_mnqBo&libraries=places&language=ua&region=UA"
            async defer></script>
@endsection
