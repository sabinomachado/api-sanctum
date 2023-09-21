<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class CategoryPolicy
{

      public function delete(User $user)
      {
          //TO-DO criar ENUM para nivel_id
         return ($user->nivel_id != '2')
              ? Response::allow()
              : Response::deny('You do not own this post.');

      }


}
