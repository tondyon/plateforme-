<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CertificateVerificationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function export(User $user)
    {
        return $user->hasRole('admin');
    }
}
