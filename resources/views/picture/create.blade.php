<div>

    <form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" accept="image/*"><br>
        @error('file')
            <small>{{ $message }}</small>
        @enderror
        <input type="text" placeholder="titulo de la imagen" name="title">
        <input type="text" value="{{ Auth::user()->id }}" name="user_id">
        <button type="submit">Subir imagen</button>
    </form>

</div>
