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
    <style>
        .btn-toolbar {
            display: inline-block;
            margin: 10px auto;
            /* margin-top: 10px;
            margin-right: auto;
            margin-bottom: 10px;
            margin-left: auto; */
        }
    </style>

</head>

<body>
    {{-- Here is the explanation for the code:
    1. We use the @if directive to check if the session has a success key.
    2. If it has, we display the success message in an alert box.
    3. If the session does not have a success key, we check if the errors bag has any error messages.
    4. If it has, we loop through the error messages and display them in an alert box.  --}}
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
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
        </div>
    </div>

    {{-- Added the text field and a button in the form.
    Form method set to POST and action url to {{route('todos.store')}}. --}}
    <div class="text-center mt-5">
        <h2>Add Todo</h2>
        {{-- Added a CSRF token to the form to prevent Cross-Site Request Forgery attacks. --}}
        <form class="row g-3 justify-content-center" method="POST" action="{{ route('todos.store') }}">
            @csrf
            <div class="col-6">
                <input type="text" class="form-control" name="title" placeholder="Title">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </div>
        </form>
    </div>

    <div class="text-center">
        <h2>All Todos</h2>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Looping through each todos using foreach PHP function. --}}
                        @foreach ($todos as $index => $todo)
                            <tr>
                                {{-- Incrementing the counter itself by using $index + 1. --}}
                                <th>{{ $index + 1 }}</th>
                                {{-- Loading the title of the todo item by $todo->title. --}}
                                <td>{{ $todo->title }}</td>
                                <td>{{ $todo->created_at }}</td>
                                <td>
                                    {{-- If $todo->is_completed is 1 then show complete and if its 0 then show not complete. --}}
                                    @if ($todo->is_completed)
                                        <div class="badge bg-success">Completed</div>
                                    @else
                                        <div class="badge bg-warning">Not Completed</div>
                                    @endif
                                </td>
                                <td>
                                    {{-- To able to call the edit function passing the todo id which we want to edit. --}}
                                    <a href="{{ route('todos.edit', ['todo' => $todo->id]) }}"
                                        class="btn btn-info">Edit</a>
                                    <a href="{{ route('todos.destroy', ['todo' => $todo->id]) }}"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group me-2" role="group" aria-label="First group">
            @if ($todos->currentPage() == 1)
                <button type="button" class="btn btn-primary"><a
                        href="{{ $todos->previousPageUrl() }}">上一頁</a></button>
                <button type="button" class="btn btn-primary"><a
                        href="{{ $todos->previousPageUrl() }}">{{ $todos->currentPage() }}</a></button>
                <button type="button" class="btn btn-primary"><a
                        href="{{ $todos->nextPageUrl() }}">{{ $todos->currentPage() + 1 }}</a></button>
                <button type="button" class="btn btn-primary"><a href="{{ $todos->nextPageUrl() }}">下一頁</a></button>
            @endif
            @if ($todos->currentPage() >= $todos->lastPage())
                <button type="button" class="btn btn-primary"><a
                        href="{{ $todos->previousPageUrl() }}">上一頁</a></button>
                <button type="button" class="btn btn-primary"><a
                        href="{{ $todos->previousPageUrl() }}">{{ $todos->currentPage() - 1 }}</a></button>
                <button type="button" class="btn btn-primary"><a
                        href="{{ $todos->nextPageUrl() }}">{{ $todos->currentPage() }}</a></button>
                <button type="button" class="btn btn-primary"><a href="{{ $todos->nextPageUrl() }}">下一頁</a></button>
            @endif
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
