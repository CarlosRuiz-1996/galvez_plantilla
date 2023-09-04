<?

use App\Models\Detail;
use Maatwebsite\Excel\Concerns\FromCollection;

class DetallePedidosExport implements FromCollection
{
    public function collection()
    {
        return Detail::all(); // Esto obtiene todos los registros de DetallePedido
    }
}
