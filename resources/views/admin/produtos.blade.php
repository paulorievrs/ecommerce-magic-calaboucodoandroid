
@include('admin.includes.header')
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Todos os produtos</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Preço</th>
                                        <th scope="col">Quantidade</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Excluir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($produtos as $produto)

                                        <tr>
                                            <td><a href="#">{{ $produto->nome }}</a></td>
                                            <td>{{ $produto->descricao }}</td>
                                            <td>{{ $produto->preco }}</td>
                                            <td>{{ $produto->quantidade }}</td>
                                            <td scope="col" style="cursor: pointer"><a href="/edit-produto/{{ $produto->id }}"><i class="material-icons" style="color: orange;">create</i></a></td>
                                            <td>
                                                <form action="/produto/{{ $produto->id }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button style="background: none"><i class="material-icons" style="color: red;">delete</i></button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $produtos->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lime-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span class="footer-text">2021 © Perfil Optical</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="lime/assets/assets/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="lime/assets/assets/plugins/bootstrap/popper.min.js"></script>
<script src="lime/assets/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="lime/assets/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="lime/assets/assets/plugins/chartjs/chart.min.js"></script>
<script src="lime/assets/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="lime/assets/assets/plugins/toastr/toastr.min.js"></script>
<script src="lime/assets/assets/js/lime.min.js"></script>
<script src="lime/assets/assets/js/pages/dashboard.js"></script>
</body>
</html>
