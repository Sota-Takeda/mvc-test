<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'author'      => ['nullable', 'string', 'max:255'],
            'status'      => ['required', 'in:want,reading,done'],
            'memo'        => ['nullable', 'string'],
            'started_at'  => ['nullable', 'date'],
            'finished_at' => ['nullable', 'date', 'after_or_equal:started_at'],
        ];
    }
        public function messages(): array
    {
        return [
            'title.required' => 'タイトルを入力してください。',
            'title.max'      => 'タイトルは255文字以内で入力してください。',

            'status.required' => 'ステータスを選択してください。',
            'status.in'       => 'ステータスの値が不正です。',

            'started_at.date'  => '読み始めは日付形式で入力してください。',
            'finished_at.date' => '読み終わりは日付形式で入力してください。',
        ];
    }

        public function attributes(): array
    {
        return [
            'title' => 'タイトル',
            'author' => '著者',
            'status' => 'ステータス',
            'memo' => 'メモ',
            'started_at' => '読み始め',
            'finished_at' => '読み終わり',
        ];
    }
}

