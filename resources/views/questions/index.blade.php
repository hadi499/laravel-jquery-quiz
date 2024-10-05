@extends('layouts')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-4">
    <div class="mb-4">
      <a class="btn btn-sm btn-outline-primary" href="{{route('question.create')}}"
        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">ADD QUESTION EASY</a>
    </div>
    <div>
      @foreach($questions as $q)
      <div class="mb-2">
        <span class="me-2">{{ $loop->iteration }}.</span><span>{{$q->title}} </span>
      </div>

      @endforeach
    </div>


  </div>
</div>




@endsection