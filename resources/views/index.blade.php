@extends('layout')

@section('content')

    <div class="container-fluid">
        <div class="row image-row">
            <div class="col-md-4 col-sm-12 conferencias image-container d-flex flex-column">
                <div class="content-wrapper">
                    <h3 class="text-info text-justified text-aligned"> Conferencias de tu especialidad con los mejores profesionales a escala global. Idiomas: español, inglés, alemán, chino y árabe. </h3>
                </div>
                <img class="img-fluid mt-auto" src="{{ asset('assets/conferencia.jpg') }}">
            </div>
            <div class="col-md-4 col-sm-12 seminarios image-container d-flex flex-column">
                <div class="content-wrapper">
                    <h3 class="text-warning text-justified text-aligned"> Los mejores seminarios de tu especialidad 100% online. Se un profesional imparable. </h3>
                </div>
                <img class="img-fluid mt-auto" src="{{ asset('assets/seminario.jpg') }}">
            </div>
            <div class="col-md-4 col-sm-12 mesa-redonda image-container d-flex flex-column">
                <div class="content-wrapper">
                    <h3 class="text-success text-justified text-aligned"> Participa en alguna mesa redonda de debate presencialmente o desde casa.</h3>
                </div>
                <img class="img-fluid mt-auto" src="{{ asset('assets/mesa-redonda.jpg') }}">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h1 class="text-danger"> <strong>Regístrate ya para poder participar en todos estos eventos que harán que despegues en tu carrera profesional </strong></h1>
            </div>
        </div>
    </div>

    <div class="footer"></div>

    <div class="container-fluid"></div>

@endsection
