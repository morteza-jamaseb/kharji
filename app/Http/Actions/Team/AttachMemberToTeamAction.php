<?php

namespace App\Http\Actions\Team;

use App\Models\Team\Membership;
use Carbon\Carbon;

class AttachMemberToTeamAction
{
    public static function handle($team_id, $members)
    {
        $membership_query = Membership::where('team_id', $team_id);


        $data = [];
        if (!empty($members)) {
            $membership_query->whereNotIn('user_id', $members);
            foreach ($members as $member) {
                $data[] = [
                    'team_id' => $team_id,
                    'user_id' => $member,
                    'confirmed' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }

        }

        array_unshift($data, [
            'team_id' => $team_id,
            'user_id' => auth()->id(),
            'confirmed' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $membership_query->delete();
        return Membership::query()->insertOrIgnore($data);
    }
}
