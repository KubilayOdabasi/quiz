<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use http\QueryString;
use Illuminate\Http\Request;
use App\Models\Quiz;
//use App\Models\Question;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $quiz_id
     * @return \Illuminate\Http\Response
     */
    public function index(int $quiz_id)
    {
        $quiz = Quiz::whereId($quiz_id)->with('questions')->first() ?? abort(404, 'Quiz Bulunamadı');

        return view('admin.question.list', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $quiz_id
     * @return \Illuminate\Http\Response
     */
    public function create($quiz_id)
    {
        $quiz = Quiz::find($quiz_id);
        return view('admin.question.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $quiz_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request, int $quiz_id)
    {
        if($request->hasFile('image'))
        {
            $fileName = Str::slug($request->question) . '.' . $request->image->extension();
            $fileNameWithUpload = 'uploads/' . $fileName;

            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $fileNameWithUpload,
            ]);
        }
        Quiz::find($quiz_id)->questions()->create($request->post());
        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru başarıyla oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $quiz_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $quiz_id, int $id)
    {
        return $quiz_id . ' - ' . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $quiz_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $quiz_id, int $question_id)
    {
        $question = Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404, 'Quiz veya Soru Bulunamadı');
        return view('admin.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $quiz_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, int $quiz_id, int $id)
    {
        if($request->hasFile('image'))
        {
            $fileName = Str::slug($request->question) . '.' . $request->image->extension();
            $fileNameWithUpload = 'uploads/' . $fileName;

            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $fileNameWithUpload,
            ]);
        }
        Quiz::find($quiz_id)->questions()->whereId($id)->first()->update($request->post());
        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru başarıyla güncellendi');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $quiz_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $quiz_id, int $id)
    {
        Quiz::find($quiz_id)->questions()->whereId($id)->delete();
        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru başarıyla silindi');
    }
}
