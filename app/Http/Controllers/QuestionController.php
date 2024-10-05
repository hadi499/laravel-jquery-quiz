<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('questions.index', [
            'questions' => $questions
        ]);
    }

    public function create()
    {
        $quizzes = Quiz::all(); // Ambil semua kuis untuk dropdown pilihan
        return view('questions.create', [
            'title' => 'create question',
            'quizzes' => $quizzes
        ]);
    }

    public function store(Request $request)
    {

        // Validasi input
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'title' => 'required',
            'answers.*.title' => 'required',
            'answers.*.correct' => 'required|boolean',
        ]);

        // Simpan pertanyaan
        $question = Question::create([
            'title' => $request->title,
            'quiz_id' => $request->quiz_id,
        ]);

        // Simpan jawaban
        foreach ($request->answers as $answer) {
            Answer::create([
                'title' => $answer['title'],
                'correct' => $answer['correct'],
                'question_id' => $question->id,
            ]);
        }

        return redirect()->back()->with('success', 'Pertanyaan dan jawaban berhasil disimpan!');
    }
}
