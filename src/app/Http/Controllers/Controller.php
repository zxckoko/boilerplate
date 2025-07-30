<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $successMessage = '%s \'%s\' %s successfully.';
    protected $infoMessage = '';
    protected $warningMessage = '';
    protected $errorMessage = '';
}
