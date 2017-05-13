Usage

````
<?php

use Event\UserWasCreated;
use Georgeff\Event\GeneratesEvents;
use Georgeff\Event\GeneratorInterface;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements GeneratorInterface
{
    use GeneratesEvents;
    
    public static function create(array $data)
    {
        $user = new static;
        
        $user->name  = $data['name'];
        $user->email = $data['email'];
        
        $this->raise(new UserWasCreated($user));
        
        return $this;
    }
}
````
````
<?php

use Model\User;
use Georgeff\Event\Event;

class UserController extends Controller
{
    protected $event;
    
    public function __construct(Event $event)
    {
        $this->event = $event;
    }
    
    public function create()
    {
        $data = [
            'name'  => 'Tim',
            'email' => 'tim@mail.com'
        ];
        
        $user = User::create($data);
        
        $user->save();
        
        $this->event->dispatchFor($user);
        
        ...
    }
}
````