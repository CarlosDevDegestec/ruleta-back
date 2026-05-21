<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('order')->get();
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question'  => 'required|string|max:500',
            'type'      => 'required|in:rating,text',
            'order'     => 'required|integer|min:0|max:255',
            'is_active' => 'boolean',
        ]);

        Question::create([
            'question'  => $request->question,
            'type'      => $request->type,
            'order'     => $request->order,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.questions.index')->with('success', 'Pregunta creada correctamente.');
    }

    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question'  => 'required|string|max:500',
            'type'      => 'required|in:rating,text',
            'order'     => 'required|integer|min:0|max:255',
            'is_active' => 'boolean',
        ]);

        $question->update([
            'question'  => $request->question,
            'type'      => $request->type,
            'order'     => $request->order,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.questions.index')->with('success', 'Pregunta actualizada correctamente.');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')->with('success', 'Pregunta eliminada.');
    }
}
