@include('layouts.header')



<div class="container">
    <br><br>
    <div class="row">
        <div class="col">
            <a href="{{ route('dependent.index') }}" class="btn btn-primary btn-lg btn-block">Ajax Stor & Show</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <a href="{{ route('import-view') }}" class="btn btn-primary btn-lg btn-block">Excel Import & Export</a>
        </div>
    </div>
    <br>
    {{-- <div class="row">
        <div class="col">
            <a href="{{ route('invoice') }}" class="btn btn-primary btn-lg btn-block">Generate Invoice</a>
        </div>
    </div> --}}
</div>


@include('layouts.footer')