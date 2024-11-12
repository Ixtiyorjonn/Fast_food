<?php

namespace App\Http\Controllers;

use App\Models\User_Rule;
use App\Models\UserRule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    protected function check(string $module, string $action)
    {
        $user = auth()->user();
       $userId = $user->id ?? null;

        return Cache::remember("user_".$module."_".$action."_rules_".$userId, 600,
            function () use($module, $action, $userId) {
            return UserRule::join('rules', 'user_rules.rule_id', 'rules.id')
            ->join('moduls', 'rules.modul_id', 'moduls.id')
            ->join('actions', 'rules.action_id', 'actions.id')
            ->where('moduls.modul', $module)
            ->where('user_rules.user_id', $userId)
            ->where('actions.action', $action)
            ->where('user_rules.active', true)
            ->where("rules.active", true)
            ->count() > 0;
        });

    }
}
