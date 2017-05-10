<?php

namespace App\Policies;

use App\User;
use App\Campaign;

class CampaignPolicy
{

    public function update(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    public function delete(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    public function view(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }
}
