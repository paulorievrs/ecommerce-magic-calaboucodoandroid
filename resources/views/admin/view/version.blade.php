
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
                            <h5 class="card-title">Todos as versões</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Abreviação</th>
                                        <th scope="col">Imagem</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Excluir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($versions as $version)

                                        <tr>
                                            <td>{{ $version->name }}</td>
                                            <td>{{ $version->abbreviation }}</td>
                                            <td>
                                                <a
                                                    href="{{ $version->imageLink ? $version->imageLink : ''}}"
                                                    target="{{ $version->imageLink ? '_blank' : '_parent' }}">
                                                    {{ $version->imageLink ? $version->imageLink : 'Sem imagem' }}
                                                </a>
                                            </td>
                                            <td scope="col" style="cursor: pointer"><a href="version/edit/{{ $version->id }}"><i class="material-icons" style="color: orange;">create</i></a></td>
                                            <td>
                                                <form action="version/delete/{{ $version->id }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button style="background: none"><i class="material-icons" style="color: red;">delete</i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $versions->links() }}
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
