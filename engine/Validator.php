<?php

namespace Engine;

class Validator
{
    protected $data;
    protected $rules;
    protected $messages;
    protected $errors = [];
    protected $customMessages = [];
    protected $customRules = [];
    protected $implicitRules = ['required', 'filled', 'present'];

    public function __construct(array $data, array $rules, array $messages = [])
    {
        $this->data = $data;
        $this->rules = $this->parseRules($rules);
        $this->messages = $messages;
        $this->customMessages = $messages;
    }

    public static function make(array $data, array $rules, array $messages = [])
    {
        return new static($data, $rules, $messages);
    }

    public function validate()
    {
        foreach ($this->rules as $attribute => $attributeRules) {
            $this->validateAttribute($attribute, $attributeRules);
        }

        return $this;
    }

    public function fails()
    {
        $this->validate();
        return !empty($this->errors);
    }

    public function passes()
    {
        return !$this->fails();
    }

    public function errors()
    {
        return $this->errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getFirstError($attribute = null)
    {
        if ($attribute) {
            return $this->errors[$attribute][0] ?? null;
        }

        if (empty($this->errors)) {
            return null;
        }

        $firstAttribute = array_key_first($this->errors);
        return $this->errors[$firstAttribute][0] ?? null;
    }

    public function messages()
    {
        return $this->messages;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function addCustomRule($name, callable $rule, $message = null)
    {
        $this->customRules[$name] = $rule;
        
        if ($message) {
            $this->customMessages[$name] = $message;
        }

        return $this;
    }

    protected function parseRules(array $rules)
    {
        $parsed = [];

        foreach ($rules as $attribute => $rule) {
            if (is_string($rule)) {
                $parsed[$attribute] = explode('|', $rule);
            } elseif (is_array($rule)) {
                $parsed[$attribute] = $rule;
            }
        }

        return $parsed;
    }

    protected function validateAttribute($attribute, array $rules)
    {
        $value = $this->getValue($attribute);

        foreach ($rules as $rule) {
            $parsedRule = $this->parseRule($rule);
            $ruleName = $parsedRule['name'];
            $parameters = $parsedRule['parameters'];

            // Skip validation if value is empty and rule is not implicit
            if ($this->isEmptyValue($value) && !$this->isImplicitRule($ruleName)) {
                continue;
            }

            if (!$this->validateRule($attribute, $value, $ruleName, $parameters)) {
                $this->addError($attribute, $ruleName, $parameters);
                break; // Stop validation on first error for this attribute
            }
        }
    }

    protected function parseRule($rule)
    {
        if (strpos($rule, ':') !== false) {
            [$name, $parameters] = explode(':', $rule, 2);
            $parameters = explode(',', $parameters);
        } else {
            $name = $rule;
            $parameters = [];
        }

        return [
            'name' => $name,
            'parameters' => $parameters
        ];
    }

    protected function validateRule($attribute, $value, $rule, $parameters)
    {
        // Check custom rules first
        if (isset($this->customRules[$rule])) {
            return call_user_func($this->customRules[$rule], $attribute, $value, $parameters, $this);
        }

        // Built-in rules
        $method = 'validate' . ucfirst($rule);
        
        if (method_exists($this, $method)) {
            return $this->$method($attribute, $value, $parameters);
        }

        throw new \Exception("Validation rule [{$rule}] does not exist.");
    }

    protected function addError($attribute, $rule, $parameters = [])
    {
        if (!isset($this->errors[$attribute])) {
            $this->errors[$attribute] = [];
        }

        $this->errors[$attribute][] = $this->getMessage($attribute, $rule, $parameters);
    }

    protected function getMessage($attribute, $rule, $parameters = [])
    {
        // Check custom message first
        $customKey = "{$attribute}.{$rule}";
        if (isset($this->customMessages[$customKey])) {
            return $this->replacePlaceholders($this->customMessages[$customKey], $attribute, $rule, $parameters);
        }

        if (isset($this->customMessages[$rule])) {
            return $this->replacePlaceholders($this->customMessages[$rule], $attribute, $rule, $parameters);
        }

        // Default messages
        $messages = $this->getDefaultMessages();
        $message = $messages[$rule] ?? "The {$attribute} is invalid.";

        return $this->replacePlaceholders($message, $attribute, $rule, $parameters);
    }

    protected function replacePlaceholders($message, $attribute, $rule, $parameters)
    {
        $message = str_replace(':attribute', $attribute, $message);
        $message = str_replace(':Attribute', ucfirst($attribute), $message);

        for ($i = 0; $i < count($parameters); $i++) {
            $message = str_replace(':' . ($i + 1), $parameters[$i], $message);
        }

        return $message;
    }

    protected function getValue($attribute)
    {
        if (strpos($attribute, '.') !== false) {
            return $this->getNestedValue($attribute);
        }

        return $this->data[$attribute] ?? null;
    }

    protected function getNestedValue($attribute)
    {
        $keys = explode('.', $attribute);
        $value = $this->data;

        foreach ($keys as $key) {
            if (!is_array($value) || !array_key_exists($key, $value)) {
                return null;
            }
            $value = $value[$key];
        }

        return $value;
    }

    protected function isEmptyValue($value)
    {
        return in_array($value, [null, '', []], true);
    }

    protected function isImplicitRule($rule)
    {
        return in_array($rule, $this->implicitRules);
    }

    protected function getDefaultMessages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'filled' => 'The :attribute field must have a value.',
            'present' => 'The :attribute field must be present.',
            'string' => 'The :attribute must be a string.',
            'integer' => 'The :attribute must be an integer.',
            'numeric' => 'The :attribute must be a number.',
            'array' => 'The :attribute must be an array.',
            'email' => 'The :attribute must be a valid email address.',
            'url' => 'The :attribute must be a valid URL.',
            'min' => 'The :attribute must be at least :1 characters.',
            'max' => 'The :attribute may not be greater than :1 characters.',
            'between' => 'The :attribute must be between :1 and :2.',
            'regex' => 'The :attribute format is invalid.',
            'unique' => 'The :attribute has already been taken.',
            'exists' => 'The selected :attribute is invalid.',
            'confirmed' => 'The :attribute confirmation does not match.',
            'same' => 'The :attribute and :1 must match.',
            'different' => 'The :attribute and :1 must be different.',
            'in' => 'The selected :attribute is invalid.',
            'not_in' => 'The selected :attribute is invalid.',
            'boolean' => 'The :attribute field must be true or false.',
            'date' => 'The :attribute is not a valid date.',
            'date_format' => 'The :attribute does not match the format :1.',
            'before' => 'The :attribute must be a date before :1.',
            'after' => 'The :attribute must be a date after :1.',
            'size' => 'The :attribute must be :1 characters.',
            'alpha' => 'The :attribute may only contain letters.',
            'alpha_num' => 'The :attribute may only contain letters and numbers.',
            'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
        ];
    }

    // Built-in validation rules
    protected function validateRequired($attribute, $value, $parameters)
    {
        return !is_null($value) && $value !== '';
    }

    protected function validateFilled($attribute, $value, $parameters)
    {
        if (!array_key_exists($attribute, $this->data)) {
            return true;
        }

        return !is_null($value) && $value !== '';
    }

    protected function validatePresent($attribute, $value, $parameters)
    {
        return array_key_exists($attribute, $this->data);
    }

    protected function validateString($attribute, $value, $parameters)
    {
        return is_string($value);
    }

    protected function validateInteger($attribute, $value, $parameters)
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }

    protected function validateNumeric($attribute, $value, $parameters)
    {
        return is_numeric($value);
    }

    protected function validateArray($attribute, $value, $parameters)
    {
        return is_array($value);
    }

    protected function validateEmail($attribute, $value, $parameters)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    protected function validateUrl($attribute, $value, $parameters)
    {
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }

    protected function validateMin($attribute, $value, $parameters)
    {
        $min = $parameters[0] ?? 0;

        if (is_numeric($value)) {
            return $value >= $min;
        }

        if (is_string($value)) {
            return mb_strlen($value) >= $min;
        }

        if (is_array($value)) {
            return count($value) >= $min;
        }

        return false;
    }

    protected function validateMax($attribute, $value, $parameters)
    {
        $max = $parameters[0] ?? 0;

        if (is_numeric($value)) {
            return $value <= $max;
        }

        if (is_string($value)) {
            return mb_strlen($value) <= $max;
        }

        if (is_array($value)) {
            return count($value) <= $max;
        }

        return false;
    }

    protected function validateBetween($attribute, $value, $parameters)
    {
        $min = $parameters[0] ?? 0;
        $max = $parameters[1] ?? $min;

        if (is_numeric($value)) {
            return $value >= $min && $value <= $max;
        }

        if (is_string($value)) {
            $length = mb_strlen($value);
            return $length >= $min && $length <= $max;
        }

        if (is_array($value)) {
            $count = count($value);
            return $count >= $min && $count <= $max;
        }

        return false;
    }

    protected function validateRegex($attribute, $value, $parameters)
    {
        if (empty($parameters[0])) {
            return false;
        }

        return preg_match($parameters[0], $value);
    }

    protected function validateUnique($attribute, $value, $parameters)
    {
        $table = $parameters[0] ?? null;
        $column = $parameters[1] ?? $attribute;
        $except = $parameters[2] ?? null;

        if (!$table) {
            throw new \Exception("Unique validation requires table name");
        }

        $query = ModelBase::table($table)->where($column, $value);

        if ($except) {
            $query->where('id', '!=', $except);
        }

        return !$query->exists();
    }

    protected function validateExists($attribute, $value, $parameters)
    {
        $table = $parameters[0] ?? null;
        $column = $parameters[1] ?? $attribute;

        if (!$table) {
            throw new \Exception("Exists validation requires table name");
        }

        return ModelBase::table($table)->where($column, $value)->exists();
    }

    protected function validateConfirmed($attribute, $value, $parameters)
    {
        $confirmation = $attribute . '_confirmation';
        $confirmationValue = $this->getValue($confirmation);

        return $value === $confirmationValue;
    }

    protected function validateSame($attribute, $value, $parameters)
    {
        $other = $parameters[0] ?? null;
        if (!$other) {
            return false;
        }

        return $value === $this->getValue($other);
    }

    protected function validateDifferent($attribute, $value, $parameters)
    {
        $other = $parameters[0] ?? null;
        if (!$other) {
            return false;
        }

        return $value !== $this->getValue($other);
    }

    protected function validateIn($attribute, $value, $parameters)
    {
        return in_array($value, $parameters, true);
    }

    protected function validateNotIn($attribute, $value, $parameters)
    {
        return !in_array($value, $parameters, true);
    }

    protected function validateBoolean($attribute, $value, $parameters)
    {
        return in_array($value, [true, false, 0, 1, '0', '1'], true);
    }

    protected function validateDate($attribute, $value, $parameters)
    {
        if ($value instanceof \DateTime) {
            return true;
        }

        if (is_string($value)) {
            return strtotime($value) !== false;
        }

        return false;
    }

    protected function validateDateFormat($attribute, $value, $parameters)
    {
        $format = $parameters[0] ?? 'Y-m-d';
        $date = \DateTime::createFromFormat($format, $value);

        return $date && $date->format($format) === $value;
    }

    protected function validateBefore($attribute, $value, $parameters)
    {
        $other = $parameters[0] ?? null;
        if (!$other) {
            return false;
        }

        $date = strtotime($value);
        $otherDate = strtotime($this->getValue($other));

        return $date && $otherDate && $date < $otherDate;
    }

    protected function validateAfter($attribute, $value, $parameters)
    {
        $other = $parameters[0] ?? null;
        if (!$other) {
            return false;
        }

        $date = strtotime($value);
        $otherDate = strtotime($this->getValue($other));

        return $date && $otherDate && $date > $otherDate;
    }

    protected function validateSize($attribute, $value, $parameters)
    {
        $size = $parameters[0] ?? 0;

        if (is_numeric($value)) {
            return $value == $size;
        }

        if (is_string($value)) {
            return mb_strlen($value) == $size;
        }

        if (is_array($value)) {
            return count($value) == $size;
        }

        return false;
    }

    protected function validateAlpha($attribute, $value, $parameters)
    {
        return preg_match('/^[\pL\pM]+$/u', $value);
    }

    protected function validateAlphaNum($attribute, $value, $parameters)
    {
        return preg_match('/^[\pL\pM0-9]+$/u', $value);
    }

    protected function validateAlphaDash($attribute, $value, $parameters)
    {
        return preg_match('/^[\pL\pM0-9_-]+$/u', $value);
    }
}
