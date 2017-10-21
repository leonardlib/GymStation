@extends('layouts.app')

@section('content')
    <img src="{{ url('../storage/app/public/img/home/portada.jpg') }}" class="img-fluid" alt="">
    <div class="col-md-8 offset-md-2 text-center text-primary" id="slogan-empresa">
        <span>El lugar donde alcanzarás tu meta</span>
    </div>
    <div class="col-md-12" id="promociones">
        <div class="col-md-4 offset-md-4 text-primary text-center">
            <h1>Promociones</h1>
        </div>
        <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="{{ url('../storage/app/public/img/promociones/promo_1.jpg') }}" alt="">
                <div class="card-body">
                    <h4 class="card-title">Promoción</h4>
                    <p class="card-text">Detalles promoción</p>
                    <a href="#" class="btn btn-primary">Obtener código</a>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="{{ url('../storage/app/public/img/promociones/promo_2.jpg') }}" alt="">
                <div class="card-body">
                    <h4 class="card-title">Promoción</h4>
                    <p class="card-text">Detalles promoción</p>
                    <a href="#" class="btn btn-primary">Obtener código</a>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="{{ url('../storage/app/public/img/promociones/promo_3.jpg') }}" alt="">
                <div class="card-body">
                    <h4 class="card-title">Promoción</h4>
                    <p class="card-text">Detalles promoción</p>
                    <a href="#" class="btn btn-primary">Obtener código</a>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="{{ url('../storage/app/public/img/promociones/promo_4.jpg') }}" alt="">
                <div class="card-body">
                    <h4 class="card-title">Promoción</h4>
                    <p class="card-text">Detalles promoción</p>
                    <a href="#" class="btn btn-primary">Obtener código</a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#barra-inicio').parent().addClass('active');
    </script>
@endsection
