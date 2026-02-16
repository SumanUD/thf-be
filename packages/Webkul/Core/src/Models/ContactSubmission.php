<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Contracts\ContactSubmission as ContactSubmissionContract;

class ContactSubmission extends Model implements ContactSubmissionContract
{
    protected $table = 'contact_submissions';

    protected $fillable = [
        'name',
        'email',
        'contact',
        'message',
    ];
}
