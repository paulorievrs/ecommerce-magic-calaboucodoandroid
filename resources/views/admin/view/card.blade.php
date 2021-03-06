
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
                        <div class="alert alert-primary" role="alert">
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Todos as cartas</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Quantidade</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Excluir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cards as $card)

                                        <tr>
                                            <td>{{ $card->name }}</td>
                                            <td>R$ {{ $card->value }}</td>
                                            <td>{{ $card->quantity }}</td>
{{--                                            <td>{{ isset($card->cardState->name) ? $card->cardState->name : '' }}</td>--}}
{{--                                            <td>{{ $card->language->name }}</td>--}}
                                            <td scope="col" style="cursor: pointer"><a href="./edit/{{ $card->id }}"><i class="material-icons" style="color: orange;">create</i></a></td>
                                            <td>
                                                <form action="./delete/{{ $card->id }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button style="background: none"><i class="material-icons" style="color: red;">delete</i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $cards->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@include('admin.edit.includes.footer')
@section('footer')
@endsection
