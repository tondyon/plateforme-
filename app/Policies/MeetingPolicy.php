<?php

namespace App\Policies;

use App\Models\Meeting;
use App\Models\User;

class MeetingPolicy
{
    /** Determine whether the user can view any meetings. */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /** Determine whether the user can view a specific meeting. */
    public function view(User $user, Meeting $meeting): bool
    {
        return true; // Everyone can view meetings
    }

    /** Determine whether the user can create meetings. */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isFormateur();
    }

    /** Determine whether the user can start a direct on a meeting. */
    public function direct(User $user, Meeting $meeting): bool
    {
        return $user->isAdmin() || $user->isFormateur();
    }

    /** Determine whether the user can update a meeting. */
    public function update(User $user, Meeting $meeting): bool
    {
        return $user->isAdmin() || $meeting->formateur_id === $user->id;
    }

    /** Determine whether the user can delete a meeting. */
    public function delete(User $user, Meeting $meeting): bool
    {
        return $user->isAdmin() || $meeting->formateur_id === $user->id;
    }
}
