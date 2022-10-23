<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ExcelRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $extension = strtolower($this->file->getClientOriginalExtension());

        return in_array($extension, ['csv', 'xls', 'xlsx']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Excel File must be a File of Type:xls, xlsx. Please Try Again';
    }
}
