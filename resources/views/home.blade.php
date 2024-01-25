<x-app-layout>
    <header>
        <h1></span class="main-color">ᓚᘏᗢ</span> Social || Gallery</h1>
    </header>
    <section id="home">
        <div class="menu">
            <h1>Hi, <span class="main-color">{{ Auth::user()->name }}</span></h1>
            <div class="main-photo">
                <img src="/storage/{{ Auth::user()->profile_photo_path }}" alt="">
            </div>
            <div class="options">
                <a href="{{ route('profile.show') }}" class="btn-opt">Profile Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-opt">Log Out</button>
                </form>
            </div>
            <form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="image-upload" class="upload-image">Select Picture</label>
                <input type="file" name="image" id="image-upload" accept="image/*" hidden><br>
                @error('file')
                    <small>{{ $message }}</small>
                @enderror
                {{-- <div>
                    <img id="picture_preview" src="" class="mb-3">
                </div> --}}
                <input type="text" value="{{ Auth::user()->id }}" name="user_id" hidden>
                <div class="title-save">
                    <input type="text" placeholder="titulo de la imagen" name="title">
                    <button type="submit">Save</button>
                </div>
            </form>
            @foreach ($myPictures as $picture)
                <div class="my-pictures">
                    <div class="d-flex-b">
                        <div class="content">
                            <h2>{{ $picture->title }}</h2>
                        </div>
                        <form action="{{ route('image.destroy', $picture) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="main-color">Delete</button>
                        </form>
                    </div>
                    <div class="image">
                        <img src="/pictures/{{ $picture->image }}" alt="">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="posts">
            @foreach ($pictures as $picture)
                <div class="publication">
                    <div class="header">
                        <div>
                            <div class="user-img">
                                <div>
                                    <img src="/storage/{{ $picture->user->profile_photo_path }}" alt="">
                                </div>
                            </div>
                            <small>{{ $picture->user->name }}</small>
                        </div>
                        <i data-feather="trash-2"></i>
                    </div>
                    <div class="content">
                        <h2>{{ $picture->title }}</h2>
                    </div>
                    <div class="image-comment">
                        <div class="image">
                            <img src="/pictures/{{ $picture->image }}" alt="">
                        </div>
                        <div class="comments">
                            <div class="comments-list">
                                <h3>Commets</h3>
                                @if (count($picture->comments) > 0)

                                    @foreach ($picture->comments as $comment)
                                        <div class="thecomment">
                                            <div class="user-img">
                                                <div>
                                                    <img src="/storage/{{ $comment->autor->profile_photo_path }}" alt="">
                                                </div>
                                            </div>
                                            <p class="content-c"><b>{{ $comment->autor->name }} </b>{{ $comment->content }}</p>
                                        </div>
                                    @endforeach

                                @else

                                    <div class="no-comment">
                                        <div>
                                            <img src="/img/sadcat.png" alt="No comments">
                                        </div>
                                        No comments Yet!!
                                    </div>

                                @endif

                            </div>
                            <form action="{{ route('comment.store') }}" method="POST" class="comment-form">
                                @csrf
                                <input type="text" name="comment" placeholder="  ^_^   Add a comment...">
                                <input type="text" hidden name="picture_id" value="{{ $picture->id }}">
                                <button type="submit" class="post-btn">Post</button>
                            </form>
                        </div>
                    </div>

                    <div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>

@section('js')

    <script>
        document.getElementById("image-upload").addEventListener('change', cambiarImagenPortada);

        function cambiarImagenPortada(event) {
            alert('hola');

            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture_preview").setAttribute('src', event.target.result)
            };

            reader.readAsDataURL(file);
        }
    </script>

@stop
