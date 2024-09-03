<?php

namespace App\Observers;

use App\Models\FaqQuestion;
use Illuminate\Support\Str;

class FaqQuestionObserver
{
    /**
     * Handle the FaqQuestion "created" event.
     */
    public function creating(FaqQuestion $faqQuestion)
    {
        $url = $faqQuestion->youtube_video_id_only;

        // Extracting YouTube video ID
        if (Str::startsWith($url, 'https://youtu.be/')) {
            $faqQuestion->youtube_video_id_only = Str::after($url, 'https://youtu.be/');
        }
    }

    /**
     * Handle the FaqQuestion "updated" event.
     */
    public function updating(FaqQuestion $faqQuestion)
    {
        $url = $faqQuestion->youtube_video_id_only;

        // Extracting YouTube video ID
        if (Str::startsWith($url, 'https://youtu.be/')) {
            $faqQuestion->youtube_video_id_only = Str::after($url, 'https://youtu.be/');
        }
    }
    
}
