<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use http\QueryString;
use Illuminate\Http\Request;
use App\Models\Quiz;
//use App\Models\Question;

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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
