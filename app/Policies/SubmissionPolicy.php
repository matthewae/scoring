<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Submission;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubmissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the submission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Submission  $submission
     * @return bool
     */
    public function view(User $user, Submission $submission)
    {
        // Allow users with 'user' status to view any submission
        return $user->status === 'user';
    }

    /**
     * Determine whether the user can create submissions.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->status === 'user';
    }

    /**
     * Determine whether the user can update the submission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Submission  $submission
     * @return bool
     */
    public function update(User $user, Submission $submission)
    {
        return $user->status === 'user';
    }
}