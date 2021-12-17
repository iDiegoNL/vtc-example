<?php

namespace App\Http\Requests;

use App\Models\EventRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEventRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', EventRequest::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'start_at' => ['required', 'date', 'after_or_equal:' . now()->addDays(14)],
            'end_at' => ['required', 'date', 'after_or_equal:start_at'],
            'name' => ['required', 'string', 'max:64'],
            'event_link' => ['required', 'url', 'max:255'],
            'info' => ['required', 'string'],
            'rules' => ['required', 'string'],
            'header_image' => ['required', 'image', 'max:4096'],
            'comment' => ['required', 'string'],
            'hide' => ['sometimes', 'boolean'],
            'server_name' => ['required', 'string', 'max:32'],
            'game' => ['required', 'string', Rule::in(['ETS2', 'ATS'])],
            'max_players' => ['required', 'integer', 'min:100', 'max:4000'],
            'speedlimiter' => ['sometimes', 'boolean'],
            'afk' => ['sometimes', 'boolean'],
            'collisions' => ['sometimes', 'boolean'],
            'cars_for_players' => ['sometimes', 'boolean'],
            'map' => ['sometimes', 'boolean'],
            'promods' => ['sometimes', 'boolean'],
            'agreement' => ['required', 'boolean', 'accepted'],
        ];
    }
}
