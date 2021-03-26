<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest {
    /**
     * Default authorization rules
     *
     * @return array
     */
    public function rules() {
        return [];
    }
    public function getOrderBy(): array {
        $options = $this->getArrayValue($this->orderBy, ':');

        return [
            'direction' => $options[1] ?? null,
        ];
    }

    public function hasOrderBy(): bool {
        return $this->has('orderBy');
    }
}
