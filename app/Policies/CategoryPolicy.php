<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
Use App\Enum\NivelEnum;
class CategoryPolicy
{

      public function delete(User $user)
      {
          
         return ($user->nivel_id != NivelEnum::EDITOR->value)
              ? Response::allow()
              : Response::deny('You do not own this post.');

      }


}
