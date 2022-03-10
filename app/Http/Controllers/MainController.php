<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Result;

class MainController extends Controller
{
    public function dashboard(){
        $quizzes = Quiz::where('status', 'publish')->withCount('questions')->paginate(2);

        return view('dashboard', compact('quizzes'));
    }

    public function quiz_detail($slug){
        $quiz = Quiz::whereSlug($slug)
                ->with('my_result', 'top_ten.user')
                ->withCount('questions')
                ->first() ?? abort(404, 'Quiz bulunamadı');
        return view('quiz_detail', compact('quiz'));
    }

    public function quiz_join($slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('questions')->first();

        if($quiz->my_result)
        {
            abort(404, 'Bu sınava daha önce katıldınız.');
        }


        return view('quiz', compact('quiz'));
    }

    public function quiz_result(Request $request, $slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('questions')->first() ?? abort(404, 'Quiz Bulunamadı');
        $correct = 0;
        $wrong = 0;

        if($quiz->my_result)
        {
            abort(404, 'Bu sınava daha önce katıldınız.');
        }

        foreach ($quiz->questions as $question) {
            Answer::create(
                [
                    'user_id'   => auth()->user()->id,
                    'question_id'   => $question->id,
                    'answer'        => $request->post( $question->id ),
                ]
            );

            if($question->correct_answer===$request->post($question->id)){
                $correct++;
            }
            else
            {
                $wrong++;
            }
        }

        $point = round(($correct/($correct+$wrong))*100);
        Result::create(
            [
                'user_id'   => auth()->user()->id,
                'quiz_id'   => $quiz->id,
                'point'     => $point,
                'correct'   => $correct,
                'wrong'     => $wrong,
            ]
        );

        return redirect()->route('quiz.detail', $slug)->withSuccess('Quiz başarıyla tamamlandı. Puanın: ' . $point);
    }
}

