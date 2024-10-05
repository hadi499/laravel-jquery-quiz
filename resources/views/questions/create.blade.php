@extends('layouts')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('question.store') }}" method="POST" class="border py-3 px-5 rounded shadow">
      @csrf

      <h5 class="text-center my-2">Add Easy Question</h5>

      <!-- Pilih Kuis -->
      <div class="mb-3">
        <p><strong>Pertanyaan</strong></p>

        <div class="mb-3">
          <label for="quiz_id" class="form-label">Pilih Kuis</label>
          <select name="quiz_id" id="quiz_id" class="form-control" required>
            <option value="">Pilih kuis</option>
            @foreach($quizzes as $quiz)
            <option value="{{ $quiz->id }}">{{ $quiz->name }} - {{ $quiz->topic }}</option>
            @endforeach
          </select>
        </div>

        <!-- Pertanyaan -->
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan pertanyaan" required>
        </div>

      </div>


      <!-- Jawaban (dynamic) -->
      <div id="answers">
        <p><strong>Jawaban</strong></p>

        <div class="answer mb-3 d-flex align-items-center gap-3">

          <input type="text" name="answers[0][title]" class="form-control" style="width: 50px" required
            autocomplete="off">

          <div class="form-check">
            <input class="form-check-input" type="radio" name="answers[0][correct]" id="correct_0_true" value="1"
              required>
            <label class="form-check-label" for="correct_0_true">
              Benar
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="answers[0][correct]" id="correct_0_false" value="0"
              required>
            <label class="form-check-label" for="correct_0_false">
              Salah
            </label>
          </div>
        </div>
        <div class="answer mb-3 d-flex align-items-center gap-3">
          <input type="text" name="answers[1][title]" class="form-control" style="width: 50px" required
            autocomplete="off">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="answers[1][correct]" id="correct_1_true" value="1"
              required>
            <label class="form-check-label" for="correct_1_true">
              Benar
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="answers[1][correct]" id="correct_1_false" value="0"
              required>
            <label class="form-check-label" for="correct_1_false">
              Salah
            </label>
          </div>
        </div>
        <div class="answer mb-3 d-flex align-items-center gap-3">
          <input type="text" name="answers[2][title]" class="form-control" style="width: 50px" required
            autocomplete="off">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="answers[2][correct]" id="correct_2_true" value="1"
              required>
            <label class="form-check-label" for="correct_2_true">
              Benar
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="answers[2][correct]" id="correct_2_false" value="0"
              required>
            <label class="form-check-label" for="correct_2_false">
              Salah
            </label>
          </div>
        </div>
      </div>


      <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
  </div>
</div>


@endsection