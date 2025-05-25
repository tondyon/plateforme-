  // app/Http/Controllers/DiplomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiplomeController extends Controller
{
    public function index()
    {
        return view('diplomes.index');  // Assurez-vous d'avoir cette vue
    }
}
