<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\TranslationLoader\LanguageLine;
use App\Traits\AsJsonTrait;


class MyTranslation extends LanguageLine
{
    use HasFactory, AsJsonTrait;
}
