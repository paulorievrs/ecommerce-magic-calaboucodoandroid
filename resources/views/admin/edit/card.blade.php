@include('admin.edit.includes.header')
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
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Editar uma carta</h5>

                            <form action="/card/update/{{ $card->id }}" method="POST">

                                @method('PUT')
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" class="form-control" value="{{ $card->name }}" name="name" placeholder="Nome da carta" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" class="form-control" value="{{ $card->english_name }}" name="english_name" placeholder="Nome da carta em inglês (opcional) " />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" class="form-control" value={{ $card->imageLink }} name="imageLink" placeholder="Link da imagem" />
                                    </div>
                                </div>

                                <div class="form-row d-flex flex-row">
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" onkeypress="return onlynumber();" class="form-control" value={{ $card->value }} name="value" placeholder="Valor da carta"/>
                                    </div>
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" min="0" value={{ $card->quantity }} name="quantity" class="form-control" placeholder="Quantidade"/>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 form-group pb-2">
                                        <select class="selectpicker" data-width="100%" name="card_states_id" data-show-subtext="false" data-live-search="false">
                                            <option selected value={{ $card->cardState->id }}>{{ $card->cardState->name }}</option>
                                            @foreach($states as $state)
                                                <option value={{ $state->id }}>{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 form-group pb-2">
                                        <select class="selectpicker" data-width="100%" name="language_id" data-show-subtext="false" data-live-search="true">
                                            <option selected value={{ $card->language->id }}>{{ $card->language->name }}</option>
                                            @foreach($languages as $language)
                                                <option value={{ $language->id }}>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 form-group pb-2">
                                        <select class="selectpicker" data-width="100%" name="version_id" data-show-subtext="false" data-live-search="true">
                                        <option selected value={{ $card->version->id }}>{{ $card->version->name }}</option>
                                        @foreach($versions as $version)
                                                <option value={{ $version->id }}>{{ $version->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="submit" style="width: 1100px" class="btn btn-primary">Alterar uma carta</button>
                                </div>
                            </form>
                            <small>Utilize '.' (ponto) para representar vírgula</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('admin.edit.includes.footer')
@section('limefooter')
@endsection
