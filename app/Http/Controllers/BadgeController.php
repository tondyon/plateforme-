<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $earnedBadges = $user->badges()->with('users')->get();
        $availableBadges = Badge::whereNotIn('id', $earnedBadges->pluck('id'))->get();

        return view('badges.index', compact('earnedBadges', 'availableBadges'));
    }

    public function show(Badge $badge)
    {
        $userHasBadge = auth()->user()->badges->contains($badge);
        $progress = null;

        if (!$userHasBadge) {
            // Calculate progress towards badge if possible
            switch ($badge->type) {
                case 'achievement':
                    if (isset($badge->criteria['completed_courses_count'])) {
                        $userCompletedCount = auth()->user()->courses()
                            ->wherePivot('completed_at', '!=', null)
                            ->count();
                        $progress = ($userCompletedCount / $badge->criteria['completed_courses_count']) * 100;
                    }
                    break;
                // Add other badge type progress calculations here
            }
        }

        return view('badges.show', compact('badge', 'userHasBadge', 'progress'));
    }

    public function leaderboard()
    {
        $topUsers = User::withCount('badges')
            ->orderByDesc('badges_count')
            ->take(10)
            ->get()
            ->map(function ($user) {
                return [
                    'name' => $user->name,
                    'badges_count' => $user->badges_count,
                    'points' => $user->getBadgePoints()
                ];
            });

        return view('badges.leaderboard', compact('topUsers'));
    }
}
