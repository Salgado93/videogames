<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Producto<b></b>
        </h2>
    </x-slot>
    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
    @endif
    <div class="py-12">
        <div class="container">
            <div class="row">
            <div class='col-md-8'>
                    <div class="card">
                        <div class="card-header">Editar Producto</div>
                        <div class="card-body">
                            <form action="{{ url('producto/actualizar/'.$productos->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <input type="hidden" name="old_image" value="{{ $productos->producto_imagen }}">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                    <input type="text" name="producto_nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $productos->producto_nombre }}">
                                    @error('producto_nombre')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Imagen</label>
                                    <input type="file" name="producto_imagen" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $productos->producto_imagen }}">
                                    @error('producto_imagen')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Precio</label>
                                    <input type="text" name="producto_precio" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $productos->producto_precio }}">
                                    @error('producto_precio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset($productos->producto_imagen) }}" style="width:300px; height:200px;">
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar Producto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>