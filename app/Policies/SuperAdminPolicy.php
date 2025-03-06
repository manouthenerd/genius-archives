<?php

namespace App\Policies;

use App\Models\User;

class SuperAdminPolicy
{   
    /**
     * Détermine si l'utilisateur peut visiter la page du superadmin
     */
    public function visit(User $user)
    {
        return $user->role == 'superadmin';
    }
}
