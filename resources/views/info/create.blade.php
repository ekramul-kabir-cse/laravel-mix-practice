

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


    <form method="POST" action="{{ route('info.store') }}"  enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" >
                @error('title')
                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle') }}" >
                @error('subtitle')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="slug">Slug:</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control @error('slug') is-invalid @enderror">
                @error('slug')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control  @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}"  placeholder="Enter description" ></textarea>
                @error('description')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" >
                @error('date')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" >
                @error('name')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" >
                @error('email')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" >
                @error('phone')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="image" class="form-label">Image</label>
                {{-- <input type="file" class="form-control" id="image" name="image" required onchange="previewImage(event)"> --}}
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage(event)">
                @error('image')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
                <img id="image-preview" src="#" alt="Selected Image" style="display: none; max-width: 150px; height: 150px;">
            </div>
            <div class="col-md-12 mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control  @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}"  placeholder="Enter description" ></textarea>
                @error('address')
                <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-2">Save</button>
        </div>
    </form>
</div>

@include('layouts.footer')
<script>
function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function(){
        var img = document.getElementById("image-preview");
        img.src = reader.result;
        img.style.display = "block";
    };
    reader.readAsDataURL(input.files[0]);
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
