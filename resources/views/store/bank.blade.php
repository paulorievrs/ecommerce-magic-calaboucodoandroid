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
                                    <li><a href="/profile"><i class="material-icons">account_circle</i>Perfil</a></li>
                                    <li><a href="/profile/address"><i class="material-icons">home</i>Endereços</a></li>
                                    <li><a href="/profile/bank" class="active"><i class="material-icons">account_balance</i>Contas Bancárias</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card stat-card">
                        <div class="card-body">
                            <h5 class="card-title">Minhas contas bancárias</h5>
                            @if(sizeof($banks) === 0)
                                <h1>Nenhuma conta bancária registrada</h1>
                            @endif
                            <div class="row">
                                @php $i = 1; @endphp
                                @foreach($banks as $bank)

                                <div class="col-md-12">
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-content-between">
                                                <span>Conta {{ $i++ }}</span>
                                                <form id="delete-{{ $bank->id }}" method="POST" action="/bank/delete/{{ $bank->id }}">
                                                    @method('delete')
                                                    @csrf
                                                    <a href="#" onclick="document.getElementById('delete-{{ $bank->id }}').submit();" style="color: #ff0000;"><i style="font-size: 20px" class="material-icons">delete</i></a>
                                                </form>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <strong>Código: </strong><span>{{ $bank->bank_code }}</span>
                                            </div>

                                            <div>
                                                <strong>Banco: </strong><span>{{ $bank->bank_name }}</span>
                                            </div>

                                            <div>
                                                <strong>Agência: </strong><span>{{ $bank->agency }}</span>
                                            </div>

                                            <div>
                                                <strong>Conta: </strong><span>{{ $bank->account }}</span>
                                            </div>

                                            <div>
                                                <strong>CPF: </strong><span>{{ mask($bank->bank_cpf, '###.###.###-##')}}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="card stat-card">
                        <div class="card-body">
                            <h5 class="card-title">Adicionar uma conta bancária (máximo de 3)</h5>

                            <form action="/bank/create" method="POST">

                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" onkeypress="onlynumber()" class="form-control" name="bank_code"  placeholder="Código do banco" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" class="form-control" name="bank_name"  placeholder="Nome do banco" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" onkeypress="onlynumber()" class="form-control" name="agency"  placeholder="Agência" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" onkeypress="onlynumber()" class="form-control" name="account"  placeholder="Conta" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" onkeypress="mCPF()" value="{{ mask(Auth::user()->cpf, '###.###.###-##')}}" class="form-control" name="bank_cpf" placeholder="CPF" />
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit">Inserir conta bancária</button>
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
