<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
    ];
    protected $translatable = [
        'name',
        'slug',
    ];
    public function getAllUsedLanguages()
    {
        $categories = Category::all();
        $usedLanguages = [];

        foreach ($categories as $category) {
            // Assuming 'title' is a translatable field
            $translations = $category->getTranslations('name'); // This returns the JSON translations

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
