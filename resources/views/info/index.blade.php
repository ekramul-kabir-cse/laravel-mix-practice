@include('layouts.header')
<div class="container">
    <h2>Table</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Subtitle</th>
          <th width="50">Description</th>
          <th>Slug</th>
          <th>Date</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Image</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($info as $key=>$infos)
        <tr>
         <td>{{ $key+1 }}</td>
         <td>{{ $infos->title }}</td>
         <td>{{ $infos->subtitle }}</td>
         <td>{{ $infos->description }}</td>
         <td>{{ $infos->slug }}</td>
         <td>{{ $infos->date }}</td>
         <td>{{ $infos->name }}</td>
         <td>{{ $infos->email }}</td>
         <td>{{ $infos->phone }}</td>
         <td><img src="{{ asset('images/'.$infos->image) }}" style="height: 100px; width:100px;"></td>
         <td>{{ $infos->address }}</td>
         <td>
            <a href="#" class="btn btn-primary">Edit</a>
            <a href="#" class="btn btn-danger">Delete</a>
         </td>

        </tr>
        @endforeach
        <!-- Add more rows for additional data -->
      </tbody>
    </table>
  </div>
@include('layouts.footer')  <td></td>