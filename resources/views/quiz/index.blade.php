@extends('layouts')
@section('scripts')
<script src="{{ asset('js/main.js') }}"></script>
@endsection
@section('content')
<div class="border shadow ">
  <div class="text-center p-4" style="background-color: #81DAE3 ">
    <h1>Game Laravel</h1>

  </div>

  <div class="text-start p-4">

    <h4>Selamat datang, </h4>
    <h6>Klik salah satu menu untuk memulai !</h6>
    @foreach ($quizzes as $quiz)

    @endforeach
    <div class="mb-3 mt-3">
      <button type="button" class="btn btn-primary modal-button" data-bs-toggle="modal" data-bs-target="#quizStartModal"
        data-id="{{$quiz->id}}" data-quiz="{{$quiz->name}}" data-questions="{{$quiz->number_of_questions}}"
        data-difficulty="{{$quiz->difficulty}}" data-time="{{$quiz->time}}"
        data-pass="{{$quiz->required_score_to_pass}}">
        {{$quiz->name}}
      </button>

    </div>



  </div>
  <div class="d-flex justify-content-end mb-3  me-4">
    <a class="btn btn-outline-dark" href="/">Back</a>
  </div>

</div>

<!-- Modal -->
</div>
<div class="modal fade" id="quizStartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal-title-confirm"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body-confirm"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="start-button" class="btn btn-primary">Start</button>
      </div>
    </div>
  </div>
</div>

@endsection