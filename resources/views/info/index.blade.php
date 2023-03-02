
@include('layouts.header')
<br>
<div class="container">
  <a href="{{ route('info.create') }}" class="btn btn-danger">Add New</a>
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
            <a href="{{ route('info.edit',$infos->id) }}" class="btn btn-primary">Edit</a>
            {{-- <button href="{{ route('info.delete',$infos->id) }}" class="btn btn-danger show_confirm">Delete</button> --}}
            <form action="{{ route('info.delete', $infos->id) }}" method="POST">
              @csrf
              @method('POST')
              <!-- Add a "Delete" button with onclick event -->
              <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
          </form>          
         </td>

        </tr>
        @endforeach
        <!-- Add more rows for additional data -->
      </tbody>
    </table>
  </div>
@include('layouts.footer')  <td></td>