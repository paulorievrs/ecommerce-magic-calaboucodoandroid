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
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Criar uma carta</h5>

                            <form action="/card/create" method="POST">

                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" class="form-control" name="name" placeholder="Nome da carta" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" class="form-control" name="english_name" placeholder="Nome da carta em inglês (opcional) " />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" class="form-control" name="imageLink" placeholder="Link da imagem" />
                                    </div>
                                </div>

                                <div class="form-row d-flex flex-row">
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" onkeypress="return onlynumber();" class="form-control" name="value" placeholder="Valor da carta"/>
                                    </div>
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" min="0" name="quantity" class="form-control" placeholder="Quantidade"/>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 form-group pb-2">
                                        <select class="selectpicker" data-width="100%" name="card_states_id" data-show-subtext="false" data-live-search="false">
                                            @foreach($states as $state)
                                                <option value={{ $state->id }}>{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 form-group pb-2">
                                        <select class="selectpicker" data-width="100%" name="language_id" data-show-subtext="false" data-live-search="true">
                                            @foreach($languages as $language)
                                                <option value={{ $language->id }}>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-12 form-group pb-2">
                                        <select class="selectpicker" data-width="100%" name="version_id" data-show-subtext="false" data-live-search="true">
                                            @foreach($versions as $version)
                                                <option value={{ $version->id }}>{{ $version->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="submit" style="width: 1100px" class="btn btn-primary">Criar uma carta</button>
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
