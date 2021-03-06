
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
                @foreach($cards as $card)
                    <div class="col-md-4">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="post">
                                    <div class="post-info">
                                        <h5>{{ $card->name }} - R$ {{ number_format($card->value,2,",",".")}}</h5>
                                        <h6>{{ $card->english_name }}</h6>
                                    </div>
                                    <div class="post-body">
                                        <a href="/card/{{ $card->name }}"><img style="padding: 0px 10px 10px 10px;" src="{{ $card->imageLink }}" class="post-image" /></a>
                                    </div>

                                    <div>
                                        <div class="post-actions">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a href="#"><i class="fas fa-boxes"></i>Quantidade: {{ $card->quantity }}</a>
                                                </li>

                                                <li>
                                                    <a href="#" class="like-btn"><i class="fas fa-cart-plus"></i>Carrinho</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center align-content-center">
                    {{ $cards->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

@include('store.includes.footer')
@section('limefooter')
@endsection


