
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
            <hr />
            <div class="row">
                <div class="col-md-4">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="post">
                                <div class="post-info">
                                    <h5>{{ $card->name }}</h5>
                                    <h6>{{ $card->english_name }}</h6>
                                </div>
                                <div class="post-body">
                                        <img id="zoom_04" class="pb-2" style="padding: 0px 10px 10px 10px; width: 100%" data-zoom-image="{{ $card->imageLink }}" src="{{ $card->imageLink }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="post">
                                <div class="post-info" style="font-size: 18px;">

                                    <div class="pb-3">
                                        <strong>Valor: </strong><span>R$ {{ number_format($card->value,2,",",".") }}</span>
                                    </div>

                                    <div class="pb-3">
                                        <strong>CMC: </strong><span>{{ $card->CMC }}</span>
                                    </div>

                                    <div class="pb-3">
                                        <strong>Raridade: </strong><span>{{ ucfirst($card->rarity) }}</span>
                                    </div>

                                    <div class="pb-3">
                                        <strong>Versão: </strong><span>{{ strtoupper($card->version->name) }}</span>
                                    </div>

                                    <div class="pb-3">
                                        <strong>Cores: </strong><span>{{ $card->colors === '' ? 'Incolor' : $card->colors }}</span>
                                    </div>

                                    <div class="pb-3">
                                        <strong>Tipo: </strong><span>{{ $card->type->name }}</span>
                                    </div>

                                    <div class="pb-3">
                                        <strong>Estado: </strong><span>{{ $card->cardState->name }}</span>
                                    </div>

                                    <div class="pb-3">
                                        <strong>Idioma: </strong><span>{{ $card->language->name }}</span>
                                    </div>

                                    <div class="pb-3">
                                        <strong>Quantidade: </strong><span>{{ $card->quantity }}</span>
                                    </div>

                                </div>

                                <div class="post-body">
                                    <form action="/cart/create" method="POST">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <input type="hidden" name="card_id" value="{{ $card->id }}"/>

                                            <div class="col-md-10 form-group pb-2">
                                                <input type="text" class="form-control" name="quantity" type="number" min="0" max="{{ $card->quantity }}" placeholder="Quantidade"  />
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <button type="submit" style="width: 100%; height: 90%" class="btn btn-primary">
                                                    <i class="fas fa-cart-plus" style="font-size: 20px"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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


