<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Upload Vatidion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <h1 class='text-center'></h1>
    <div class='container'>
        <div class='row'>
            <div class="col-sm-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class='text-center'>Form Upload Vatidion</h1>
                <form method="POST" action="{{ route('form.upload.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class='form-group'>
                        {!! Form::label('title', 'Tiêu đề:') !!}
                        {!! Form::text('title', '', ['placeholder' => 'Tiêu đề', 'class' => 'form-control']) !!}
                        @error('title')
                        <small class='form-text text-danger'>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class='form-group mb-2'>
                        {!! Form::label('content', 'Nội dung:') !!}
                        {!! Form::textarea('content', '', ['class' => 'form-control', 'id' => 'myTextarea']) !!}
                        @error('content')
                        <small class='form-text text-danger'>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class='form-group mb-2'>
                        <input type="file" name="file" id="file" class='form-control-file m-2' onChange="mainThamUrl(this)">
                        <img src="" id="mainThmb">
                    </div>
            </div>
            <div class='form-group'>
                {!! Form::submit('Thêm mới', ['name' => 'sm-add', 'class' => 'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        function mainThamUrl(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#mainThmb').attr('src',e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>
