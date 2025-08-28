<?php
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider
{
    public function boot(): void
    {
        // ... other code ...

        Gate::define('isTeacher', fn(User $user) => $user->role === 'teacher');
        Gate::define('isStudent', fn(User $user) => $user->role === 'student');
    }
}