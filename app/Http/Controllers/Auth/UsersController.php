

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\;

class UsersController extends Controller
{
protected public function edit($id)
    {
        $microposts = Microposts::find($id);

        return view('microposts.edit', [
            'microposts' => $microposts,
        ]);
    }
    
    public function __construct()
    {
        $this->middleware('')->except('logout');
    }
    
}
    