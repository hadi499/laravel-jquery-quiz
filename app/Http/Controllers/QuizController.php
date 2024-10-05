<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();

        return view('quiz.index', [
            'quizzes' => $quizzes

        ]);
    }

    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quiz.show', [
            'quiz' => $quiz
        ]);
    }

    // Function to retrieve quiz data via AJAX
    public function data($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = [];

        foreach ($quiz->getQuestions() as $q) {
            $answers = [];
            foreach ($q->getAnswers() as $a) {
                $answers[] = $a->title; // Ambil teks jawaban
            }

            // Ubah ke format yang sesuai
            $questions[] = [
                $q->title => $answers // Gunakan atribut 'text' dari pertanyaan
            ];
        }

        return response()->json([
            'data' => $questions,
            'time' => $quiz->time,
        ]);
    }



    public function save(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $request->except('_token');


            $newData = [];
            foreach ($data as $key => $value) {
                $newKey = str_replace('_', ' ', $key); // Ganti underscore dengan spasi
                $newData[$newKey] = $value;
            }

            $questions = []; // Array untuk menyimpan detail pertanyaan
            foreach (array_keys($newData) as $key) {
                $question = Question::where('title', $key)->first();
                if ($question) {
                    // Menyimpan objek pertanyaan ke dalam array
                    $questions[] = $question;
                }
            }

            $score = 0;
            $quiz = Quiz::findOrFail($id);
            $multiplier = 100 / $quiz->number_of_questions;
            $results = [];
            $correct_answer = null;

            foreach ($questions as $q) {
                $title =  str_replace(' ', '_', $q->title);
                $a_selected = $request->input($title);

                if (!empty($a_selected)) {
                    $question_answers = Answer::where('question_id', $q->id)->get();
                    foreach ($question_answers as $a) {
                        if ($a_selected == $a->title && $a->correct) {
                            $score++; // Menambah skor jika jawaban benar
                            $correct_answer = $a->title;
                        } elseif ($a->correct) {
                            $correct_answer = $a->title; // Menyimpan jawaban benar untuk referensi
                        }
                    }
                    $results[] = [strval($q) => ['correct_answer' => $correct_answer, 'answered' => $a_selected]];
                } else {
                    $results[] = [strval($q) => 'not answered'];
                }
            }

            $final_score = $score * $multiplier;

            return response()->json([
                'passed' => $final_score >= $quiz->required_score_to_pass,
                'data' => $data,
                'questions' => $questions,
                'results' => $results,
                'score' => $final_score,
                'a' => $a_selected,
                't' => $title



            ]);
        }



        // Jika bukan AJAX request
        return response()->json(['message' => 'Invalid request'], 400);
    }
}
