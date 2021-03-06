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
                <div class="col-md-4">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="mailbox-menu">
                                <ul class="list-unstyled">
                                    <li><a href="/profile" class="active"><i class="material-icons">account_circle</i>Perfil</a></li>
                                    <li><a href="/profile/address"><i class="material-icons">home</i>Endereços</a></li>
                                    <li><a href="/profile/bank"><i class="material-icons">account_balance</i>Contas Bancárias</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card stat-card">
                        <div class="card-body">
                            <h5 class="card-title">Editar seu perfil</h5>

                            <form action="/profile/update" method="POST">
                                @method('PUT')
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <p>Nome completo</p>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Nome completo" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <p>E-mail</p>
                                        <input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="E-mail" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <p>CPF</p>
                                        <input type="text" class="form-control" id="cpf-1" value="{{ $user->cpf }}" disabled />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <p>Data de nascimento</p>
                                        <input type="date" class="form-control" id="cpf-1" name="birth_date" value="{{ $user->birth_date }}"  />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <p>Liga Magic Username</p>
                                        <input type="text" class="form-control" id="cpf-1" name="ligaMagicUsername" value="{{ $user->ligaMagicUsername }}"  />
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit">Alterar dados</button>

                            </form>
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


