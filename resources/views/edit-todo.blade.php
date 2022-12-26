<!doctype html>
<html lang="en">

<head>
    <title>Todo-list</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    {{-- Capturing the errors and success messages. --}}
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <div class="text-center mt-5">
        <h2>Edit Todo</h2>
    </div>
    {{-- We are loading the title using $todo->title  --}}
    <form method="POST" action="{{ route('todos.update', ['todo' => $todo->id]) }}">
        @csrf
        {{-- Use the PUT method we can pass POST as the method and in body of form add method_field('PUT')
    which will allow us to use PUT method. --}}
        {{ method_field('PUT') }}

        <div class="row justify-content-center mt-5">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title"
                        value="{{ $todo->title }}">
                </div>

                {{-- Status with select field in which have conditional rendering that if $todo->is_completed is 1
            then select the select option Complete as selected and if the $todo->is_completed is 0
            then select the select option Not Complete. --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_completed" id="" class="form-control">
                        <option value="1" @if ($todo->is_completed == 1) selected @endif>Complete</option>
                        <option value="0" @if ($todo->is_completed == 0) selected @endif>Not Completed</option>
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
