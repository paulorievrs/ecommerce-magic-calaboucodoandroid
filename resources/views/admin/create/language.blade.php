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
                            <h5 class="card-title">Criar um idioma</h5>

                            <form action="/language/create" method="POST">

                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" class="form-control" name="name" placeholder="Nome do Idioma" />
                                    </div>
                                    <div class="col-md-6 form-group pb-2">
                                        <input type="text" class="form-control" name="abbreviation" placeholder="Abreviação do idioma" />
                                    </div>
                                </div>


                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="submit" style="width: 1100px" class="btn btn-primary">Criar um idioma</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('admin.edit.includes.footer')
@section('limefooter')
@endsection
