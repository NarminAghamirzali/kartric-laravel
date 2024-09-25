<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image'
    ];
    protected $translatable = [
        'title',
        'slug',
        'description'
    ];
    public function getAllUsedLanguages()
    {
        $items = Service::all();
        $usedLanguages = [];
        foreach ($items as $item) {
            // Assuming 'title' is a translatable field
            $translations = $item->getTranslations('title'); // This returns the JSON translations

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
