

@include('layouts.header')
<br><br>
<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if($errors->has('slug_error'))
    <div class="alert alert-danger">{{ $errors->first('slug_error') }}</div>
    @endif
    <form method="POST" action="{{ route('info.update',$info->id) }}"  enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $info->title }}" >
                @error('title')
                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ $info->subtitle }}" >
                @error('subtitle')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="slug">Slug:</label>
                <input type="text" name="slug" id="slug" value="{{ $info->slug }}" class="form-control @error('slug') is-invalid @enderror">
                @error('slug')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control  @error('description') is-invalid @enderror" id="description" name="description"  placeholder="Enter description" >{!! $info->description !!}</textarea>
                @error('description')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ $info->date }}" >
                @error('date')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $info->name }}" >
                @error('name')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $info->email }}" >
                @error('email')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $info->phone }}" >
                @error('phone')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage(event)" required>
                <label for="image" class="form-label">Old Image</label>
                @if(isset($info->image)) 
                    <img src="{{ asset('images/'.$info->image) }}" alt="Old Image" style="height:100px;width:100px;">
                    <input type="hidden" name="old_image" value="{{ $info->image }}">
                @endif
                @error('image')
                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            
            <div class="col-md-12 mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control  @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter description" >{!! $info->address !!}</textarea>
                @error('address')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-2">Update</button>
        </div>
    </form>
</div>

@include('layouts.footer')

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>


<script>
    function generateSlug(str) {
  var slug = str.toLowerCase()
    .replace(/[^\w ]+/g,'')
    .replace(/ +/g,'-');
  return slug;
}

document.getElementById("title").addEventListener("keyup", function() {
  var title = this.value;
  var slug = generateSlug(title);
  document.getElementById("slug").value = slug;
});


</script>
