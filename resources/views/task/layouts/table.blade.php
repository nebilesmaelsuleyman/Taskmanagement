
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    {{-- here we will pass list of all users --}}
    <div class="container">
        <div class="card">
        <form method="GET" action="{{route('admin-page')}}">
                <div class="input-group mb-3">
                  <input 
                    type="text" 
                    name="search"  
                    class="form-control" 
                    placeholder="Search..." 
                    aria-label="Search" 
                    aria-describedby="button-addon2">
                <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
      
            <div class="card-header">
            Add  new Tasks
                <a href="/create" class="btn btn-success btn-sm float-end">Add New</a>
            </div>
            @if (Session::has('success'))
                <span class="alert alert-success p-2">{{Session::get('success')}}</span>
            @endif
            @if (Session::has('fail'))
                <span class="alert alert-danger p-2">{{Session::get('fail')}}</span>
            @endif
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>title</th>
                        <th>description</th>
                        <th>due_date</th>
                        <th>taskCreator_id</th>
                        <th>assigneduser_id</th>
                        <th>status</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                        @if (count($tasks) > 0)
                            @foreach ($tasks as $task)
                        <tr>
                    <td>{{$task->title}}</td>
                    <td>{{$task->description}}</td>
                    <td>{{$task->due_date}}</td>
                    <td>{{$task->taskCreator_id}}</td>
                    <td>{{$task->assigneduser_id}}</td>
                    <td>{{$task->status}}</td>
                    <td>{{$task->created_at}}</td>
                    <td>{{$task->updated_at}}</td>
                   <td> <a href="/task/{id}/edit" class="btn btn-success btn-sm float-end">Edit</a></td>
                    <td><a href="/delete/{{$task->id}}" class="btn btn-danger btn-sm">Delete</a></td>
                                </tr>    
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">No User Found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
