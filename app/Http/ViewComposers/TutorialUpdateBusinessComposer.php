<?php

namespace App\Http\ViewComposers;

use App\UserTutorial;
use Illuminate\View\View;

class TutorialUpdateBusinessComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $tutorial = UserTutorial::where('user_id', $user->id)->where('name', 'update_business')->first();

        $view->with('tutorial', $tutorial);
    }
}