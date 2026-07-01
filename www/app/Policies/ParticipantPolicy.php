<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Participant;

class ParticipantPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Participant $participant): bool
    {
        return in_array($user->role, ['parent', 'enseignant', 'admin']);
    }
}
