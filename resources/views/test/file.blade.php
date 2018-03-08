@extends('layout.app')
@section('content')
    <div class="container text-center">
        <div class="panel-body">
            <div class="col-md-12">
                <div id="trigger" class="panel panel-success">
                    <div id="results" class="panel-heading">Завантажте текстовий файл</div>
                </div>
                <div class="text-center col-md-offset-3 col-md-6">
                    <form id="fileDown" method="POST" action="#" enctype="multipart/form-data">
                        <!-- COMPONENT START -->
                        <div class="form-group">
                            <div class="input-group input-file" name="fileText">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">Вибрати</button>
                                </span>
                                <input type="text" id="forValid" class="form-control" placeholder='Выбрать файл...'/>
                                <span class="input-group-btn">
                                     <button class="btn btn-warning btn-reset" type="button">Скинути</button>
                                </span>
                            </div>
                        </div>
                        <!-- COMPONENT END -->
                        <div class="form-group">
                            <button id="goFile" type="submit" class="btn btn-primary">Завантажити</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
