<?php

namespace Simple;

use Simple\Interfaces\FormRequestInterface;

class FormRequest extends Request implements FormRequestInterface
{
    /**
     * Application redirect.
     *
     * @var Redirect|null $redirect
     */
    protected Redirect|null $redirect = null;

    /**
     * Application validation.
     *
     * @var Validator $validator
     */
    protected Validator $validator;

    /**
     * Application session.
     *
     * @var Session $session
     */
    protected Session $session;

    public function __construct(Validator $validator, Session $session)
    {
        parent::__construct();

        $this->validator = $validator;
        $this->session = $session;

        $this->run();
    }

    public function rules(): array
    {
        return [];
    }

    public function validated(): array
    {
        // TODO: Implement validated() method.
    }

    public function handle(): HandleRequest|Null
    {
        return $this->redirect;
    }

    /**
     * Return form request validation.
     *
     * @return void
     */
    private function run(): void
    {
        if (! $this->validation())
        {
            $this->session->setOld($this->all());

            $this->redirect = Redirect::back();
        }
    }

    /**
     * Run validation in rules.
     *
     * @return bool
     */
    private function validation(): bool
    {
        $this->validator = $this->validator->withData($this->all());

        foreach ($this->rules() as $attribute => $validations)
        {
            $this->convertRule($attribute, $validations);
        }

        return $this->validate();
    }

    /**
     * Add validation rule in to validator.
     *
     * @param string $attribute
     * @param array $validations
     * @return void
     */
    private function convertRule(string $attribute, array $validations): void
    {
        foreach ($validations as $ruleArray)
        {
            $ruleArray = explode(':', $ruleArray);
            $_rule = $ruleArray[0];
            $parameters = count($ruleArray) == 1 ? [] : explode(',', $ruleArray[1]);
            $this->addRule($attribute, $_rule, $parameters);
        }
    }

    /**
     * Add rule in to validator class.
     *
     * @param string $attribute
     * @param string $rule
     * @param array $parameters
     * @return void
     */
    private function addRule(string $attribute, string $rule, array $parameters = []): void
    {
        $this->validator->rule($rule, $attribute, count($parameters) == 1 ? $parameters[0] : $parameters);
    }

    /**
     * Check if validation is valid if not redirect back to home page.
     *
     * @return bool
     */
    private function validate(): bool
    {
        if (! ($valid = $this->validator->validate()))
        {
            $this->addErrorsSession($this->validator->errors());
        }

        return $valid;
    }

    /**
     * Add validations errors into session.
     *
     * @param array $errors
     * @return void
     */
    private function addErrorsSession(array $errors): void
    {
        foreach ($errors as $attribute => $error)
        {
            $this->session->setError($attribute, is_array($error) ? $error[0] : $error);
        }
    }
}