<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'image'
    ];
    protected $translatable = [
        'name',
        'position',
    ];
    public function getAllUsedLanguages()
    {
        $items = Team::all();
        $usedLanguages = [];
        foreach ($items as $item) {
            // Assuming 'title' is a translatable field
            $translations = $item->getTranslations('name'); // This returns the JSON translations

            foreach ($translations as $language => $translation) {
                // Add the language to the array if it's not already there
                if (!in_array($language, $usedLanguages)) {
                    $usedLanguages[] = $language;
                }
            }
        }
        return $usedLanguages; // Return the array of languages used in blogs
    }
}
