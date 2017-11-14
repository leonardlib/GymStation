@extends('layouts.app')

@section('content')
    <img src="{{ url('../storage/app/public/img/home/portada.jpg') }}" class="img-fluid" alt="">
    <div class="col-md-8 offset-md-2 text-center text-primary" id="slogan-empresa">
        <span>El lugar donde alcanzarás tu meta</span>
    </div>
    <div class="col-md-12" id="clases">
        <div class="col-md-4 offset-md-4 text-primary text-center">
            <h1>Clases</h1>
        </div>
        <div class="card-deck">
            @foreach($clases as $clase)
                @include('layouts.caratulaClase2', ['clase' => $clase])
            @endforeach
        </div>
    </div>
    <div class="col-md-12" id="promociones">
        <div class="col-md-4 offset-md-4 text-primary text-center">
            <h1>Promociones</h1>
        </div>
        <div class="card-deck">
            @foreach($promociones as $promocion)
                @include('layouts.caratulaPromocion', ['promocion' => $promocion])
            @endforeach
        </div>
    </div>
    <script type="text/javascript">
        $('#barra-inicio').parent().addClass('active');
    </script>
@endsection

@section('footer')
    <br/>
    <br/>
    <!--Footer-->
    <div class="col-md-12 text-center text-white bg-primary" id="footer">
        <h6>GymStation © 2017</h6>
    </div>
@endsection
