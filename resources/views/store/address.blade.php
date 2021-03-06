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
                                    <li><a href="/profile/address" class="active"><i class="material-icons">home</i>Endereços</a></li>
                                    <li><a href="/profile/bank"><i class="material-icons">account_balance</i>Contas Bancárias</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card stat-card">
                        <div class="card-body">
                            <h5 class="card-title">Meus endereços</h5>
                            @if(sizeof($addresses) === 0)
                                <h1>Nenhum endereço registrado</h1>
                            @endif
                            <div class="row">
                                @php $i = 1; @endphp
                                @foreach($addresses as $address)

                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-content-between">
                                                <span>Endereço {{ $i++ }}</span>
                                                <form id="delete-{{ $address->id }}" method="POST" action="/address/delete/{{ $address->id }}">
                                                    @method('delete')
                                                    @csrf
                                                    <a href="#" onclick="document.getElementById('delete-{{ $address->id }}').submit();" style="color: #ff0000;"><i style="font-size: 20px" class="material-icons">delete</i></a>
                                                </form>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <p>{{ $address->address }}</p>
                                            </div>
                                            <div>
                                                <p> - {{ $address->district }}</p>
                                            </div>
                                            <div>
                                                <p> - {{ $address->city }} ({{ $address->state }})</p>
                                            </div>
                                            <div>
                                                <p> - {{ $address->postal_code }}</p>
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
                            <h5 class="card-title">Adicionar um endereço (máximo de 3)</h5>

                            <form action="/address/create" method="POST">

                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" onkeypress="onlynumber()" id="cep" onblur="fillCep()" class="form-control" name="postal_code"  placeholder="CEP" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group pb-2">
                                        <input type="text" class="form-control" id="logradouro" name="address"  placeholder="Rua/Avenida" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" class="form-control" id="bairro" name="district"  placeholder="Bairro" />
                                    </div>
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" onkeypress="onlynumber()" class="form-control" name="number" placeholder="Número" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" class="form-control" name="city" id="cidade" placeholder="Cidade" />
                                    </div>
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" class="form-control" name="state" id="estado" placeholder="Estado" />
                                    </div>
                                </div>



                                <button class="btn btn-success" type="submit">Inserir endereço</button>
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

<script>
    function fillCep() {

        const cep = document.getElementById('cep').value.trim();

        const Http = new XMLHttpRequest();
        const url='https://viacep.com.br/ws/' + cep + '/json/'
        Http.open("GET", url);
        Http.send();

        Http.onreadystatechange = (e) => {
            const response = JSON.parse(Http.responseText);

            response ?  document.getElementById('logradouro').value = response.logradouro : '';
            response ? document.getElementById('bairro').value = response.bairro : '';
            response ? document.getElementById('cidade').value = response.localidade : '';
            response ? document.getElementById('estado').value = response.uf : '';

        }
    }
</script>


