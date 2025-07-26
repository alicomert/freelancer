<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserSkill;

class UserSkillPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserSkill $userSkill): bool
    {
        return $user->id === $userSkill->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserSkill $userSkill): bool
    {
        return $user->id === $userSkill->user_id;
    }
}
