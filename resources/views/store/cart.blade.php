@include('store.includes.header')
@section('limeheader')
@endsection

<div class="lime-container">

    <div class="lime-body">
        <div class="container">
            @if(session('response') !== null)
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-primary" role="alert">
                            {{ session('response') }}
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error') !== null)
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif
            <hr />
            <div class="row">
                <div class="col-md-12">
                    <div class="card stat-card">
                        <div class="card-body">
                            <h5 class="card-title">Meu carrinho - Valor total: R$ {{ number_format($valorTotal,2,",",".")}}</h5>
                            @if(sizeof($carts) === 0)
                                <h1>Vazio.</h1>
                            @endif
                            <div class="row">
                                @foreach($carts as $cart)

                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between align-content-between">
                                                    <span>{{ $cart->card->name }}</span>
                                                    <form id="delete-{{ $cart->id }}" method="POST" action="/cart/delete/{{ $cart->id }}">
                                                        @method('delete')
                                                        @csrf
                                                        <a href="#" onclick="document.getElementById('delete-{{ $cart->id }}').submit();" style="color: #ff0000;"><i style="font-size: 20px" class="material-icons">delete</i></a>
                                                    </form>
                                                </div>

                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <img style="width: 100%"  src="{{ $cart->card->imageLink }}" alt="{{ $cart->card->name }}"/>
                                                    </div>
                                                    <div class="col-md-10" style="font-size: 18px">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="pb-2">
                                                                    <strong>Quantidade: </strong>{{ $cart->quantity }}
                                                                </div>
                                                                <div class="pb-2">
                                                                    <strong>Total: </strong>R$ {{ number_format($cart->card->value * $cart->quantity,2,",",".") }}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('store.includes.footer')
@section('limefooter')
@endsection

@php
    function mask($val, $mask) {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++) {
            if($mask[$i] == '#') {
                if(isset($val[$k])) $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i])) $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }
@endphp
