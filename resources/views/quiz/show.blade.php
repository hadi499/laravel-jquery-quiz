@extends('layouts')
@section('scripts')
<script src="{{ asset('js/quiz.js') }}"></script>
@endsection
@section('content')

<div class="row my-4">
  <div class="col d-flex justify-content-center gap-3">
    <div>
      <a href="{{ route('quiz.index') }}" class="btn btn-outline-dark">Menu Quiz</a>
    </div>
    <div id="start-lagi"></div>
  </div>
</div>

<div class="row border-bottom border-1 border-secondary p-3">
  <div class="col">
    <h3>{{ $quiz->name }}</h3>
    <h5 class="text-success">Easy</h5>
    <h6 class="mb-3">score to pass: {{ $quiz->required_score_to_pass }}</h6>
  </div>

  <div class="col-md-2 d-flex flex-column justify-content-center">
    <div class="border border-primary shadow bg-body-tertiary rounded" style="width: 60px;" id="wrap-timer">
      <div class="h4 text-center mt-2" id="timer-box"></div>
    </div>
  </div>
</div>

<div class="row justify-content-center mt-5">
  <div class="col-md-8 mt-3">
    <form id="quiz-form">
      @csrf

      <div id="quiz-box" class="d-flex justify-content-evenly flex-wrap"></div>

      <button type="submit" class="btn btn-outline-primary mt-3 ms-3">Kirim Jawaban</button>
    </form>

    <div class="h1 mb-2 text-center" id="score-box"></div>
    <div id="result-box" class="my-5 text-center d-flex flex-column justify-content-center"></div>
  </div>
</div>

@endsection