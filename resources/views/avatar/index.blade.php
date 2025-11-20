@extends('layouts.app')

@section('inline-css')
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
@endsection

@section('main')
    <div class="dashboard-layout">

        <!-- Contenido principal -->
        <main class="main-content">
            <div class="container-fluid">

                <input type="text" hidden value=" {{ session('usuario.id') }} " name="user_di" id="user_id">
                <div class=" mt-4 px-3">
                    <div class="row g-4 justify-content-center">

                        <div class="col-md-4 col-sm-6">
                            <div class="banquea-card text-center">
                                <div>
                                    <img src="https://cdn-icons-png.flaticon.com/256/9284/9284039.png" alt=""
                                        style="width: 150px; height: 150px;">
                                </div>
                                <h5 class="fw-bold mb-2 text-success">avatar 1</h5>
                                <a class="boton escoger-avatar">Escoger este</a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="banquea-card text-center">
                                <div>
                                    <img src="https://cdn-icons-png.flaticon.com/256/4497/4497898.png" alt=""
                                        style="width: 150px; height: 150px;">
                                </div>
                                <h5 class="fw-bold mb-2 text-success">avatar 2</h5>
                                <a class="boton escoger-avatar">Escoger este</a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="banquea-card text-center">
                                <div>
                                    <img src="https://cdn-icons-png.flaticon.com/512/4497/4497758.png" alt=""
                                        style="width: 150px; height: 150px;">
                                </div>
                                <h5 class="fw-bold mb-2 text-success">avatar 3</h5>
                                <a class="boton escoger-avatar">Escoger este</a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="banquea-card text-center">
                                <div>
                                    <img src="https://cdn-icons-png.flaticon.com/512/8662/8662388.png" alt=""
                                        style="width: 150px; height: 150px;">
                                </div>
                                <h5 class="fw-bold mb-2 text-success">avatar 4</h5>
                                <a class="boton escoger-avatar">Escoger este</a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="banquea-card text-center">
                                <div>
                                    <img src="https://cdn-icons-png.flaticon.com/512/9284/9284057.png" alt=""
                                        style="width: 150px; height: 150px;">
                                </div>
                                <h5 class="fw-bold mb-2 text-success">avatar 5</h5>
                                <a class="boton escoger-avatar">Escoger este</a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6">
                            <div class="banquea-card text-center">
                                <div>
                                    <img src="https://cdn-icons-png.flaticon.com/512/6686/6686986.png" alt=""
                                        style="width: 150px; height: 150px;">
                                </div>
                                <h5 class="fw-bold mb-2 text-success">avatar 6</h5>
                                <a class="boton escoger-avatar">Escoger este</a>
                            </div>
                        </div>
                    </div>

                    <!-- Donde mostrarás la URL elegida -->
                    <div class="mt-3 text-center">
                        <p><strong>URL seleccionada:</strong></p>
                        <input type="text" id="avatarSeleccionado" class="form-control text-center" readonly>
                    </div>

                    <script src="{{ asset('js/avatar.js') }}"></script>
                </div>
            </div>
        </main>
    </div>
@endsection
