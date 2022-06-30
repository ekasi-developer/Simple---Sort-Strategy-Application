<?php

namespace Simple\Interfaces;

use Simple\HandleRequest;

interface FormRequestInterface
{
    /**
     * Validation rules.
     *
     * @return array
     */
    public function rules(): array;

    /**
     * Get validated data.
     *
     * @return array
     */
    public function validated(): array;

    /**
     * Get handle of request.
     *
     * @return HandleRequest|null
     */
    public function handle(): HandleRequest|null;
}