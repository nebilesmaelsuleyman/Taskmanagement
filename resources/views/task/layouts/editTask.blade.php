<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Edit Tasks</title>
  <style>
    body {
      background-color: #f5f5f5; /* Light gray background */
      display: flex; /* Center form horizontally */
      justify-content: center; /* Align form to the center */
      align-items: center; /* Align form vertically in the center */
      min-height: 100vh; /* Ensure form fills viewport height */
    }

    .card {
      border-radius: 10px; /* Rounded corners */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); /* Subtle shadow */
      max-width: 1200px; /* Limit card width */
      padding: 20px; /* Add padding for spacing */
    }

    .card-header {
      background-color: #3498db; /* Blue header color */
      color: #fff; /* White text */
      padding: 10px 15px; /* Adjust header padding */
      border-radius: 5px 5px 0 0; /* Rounded top corners */
    }

    .btn-primary {
      background-color: #3498db; /* Blue button color */
      border-color: #3498db; /* Blue button border */
    }

    .btn-primary:hover {
      background-color: #2980b9; /* Darker blue on hover */
      border-color: #2980b9; /* Darker blue border on hover */
    }

    /* Additional customizations (optional) */
    .form-label {
      font-weight: bold; /* Bold labels */
    }

    textarea {
      min-height: 100px; /* Minimum textarea height */
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-header">Edit Tasks</div>
      @if (Session::has('fail'))
        <span class="alert alert-danger p-2">{{Session::get('fail')}}</span>
      @endif
      <div class="card-body">
        <form action="{{ route('EditTask')}}" method="post">
          @csrf
          <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Title</label>
            <input type="text" name="title" value="{{old('title')}}" class="form-control" id="formGroupExampleInput" placeholder="Enter Title">
            @error('title')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Description</label>
            <textarea name="description" value="{{old('description')}}" class="form-control" id="formGroupExampleInput" placeholder="Enter Description"></textarea>
            @error('description')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Due Date</label>
            <input type="date" name="due_date" value="{{old('due_date')}}" class="form-control" id="formGroupExampleInput2" placeholder="Select Due Date">
            @error('due_date')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="mb-3">
    <label for="formGroupExampleInput2" class="form-label">Assigned Users:</label>
    <ul id="assigned-users">
        </ul>
</div>

<div class="mb-3">
    <label for="formGroupExampleInput2" class="form-label">Available Users:</label>
    <select name="available_user[]" class="form-control" multiple>
        <option value="">Select user</option>
        @foreach($availableUsers as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
</div>

<button type="button" class="btn btn-primary" id="add-user-btn">Add User</button>
         <button  type="submit"  class="btn btn-primary"> save</button>