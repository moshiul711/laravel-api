<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<section class="post-form py-2 border-bottom border-info">
    <div class="container py-2 ">
        <div class="row">
            <div class="col-12">
                <form class="form-group" action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="title" placeholder="Post Title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="description" placeholder="Post Description"></textarea>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="formFile" name="images[]" multiple>
                    </div>
                    <button type="submit" class="w-100 btn btn-primary">Post</button>
                </form>
            </div>
        </div>
    </div>
</section>


<section id="posts" class="py-5">
    <div class="container">
        <div class="row border">
            @foreach($posts as $post)
                <div class="col-12  my-2 py-2">
                    <div class="row">
                        <div class="col-9">
                            <h4>
                                {{ $post->user->name.' ' }} Posted This...
                            </h4>
                        </div>

                        @if(Auth::user()->id == $post->user_id)
                            <div class="col-3">
                                <p class="btn btn-danger float-end">Delete</p>
                            </div>
                        @endif
                    </div>

                    <b>{{ $post->title }}</b>
                    <p>{{ $post->description }}</p>
                    <div class="row py-1" style="text-align: center">
                        @foreach($post->postImage as $image)
                            <div class="col-2">
                                <img src="{{ asset($image->image) }}" class="img img-responsive w-100"  alt="">
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <span class="px-2 list-item-none">
                            <a class="text" href="{{ route('post.like',$post->id) }}">
                                        <i class="fa-solid fa-thumbs-up"></i>
                            </a>
                            ({{ count($post->likeCount) }})
                        </span>

                        <span>
                            <i class="fa-regular fa-message"></i> (({{ count($post->comment) }}))
                        </span>

                    </div>

                    <div class="py-2 px-5">
                        <form action="{{ route('post.comment',$post->id) }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="comment" class="form-control" placeholder="Write Comment...">
                                <button class="btn btn-primary" type="submit" id="button-addon2">Post</button>
                            </div>
                        </form>
                        @foreach($post->comment as $item)
                        <p class="ps-5 border"><b>{{ $item->user->name.'     ' }}</b>  {{ $item->comment }}</p>
                            @endforeach
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@if(Session::get('message'))
    <script>
        Command: toastr["success"]("{{ Session::get('message') }}")
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
@endif
</html>

