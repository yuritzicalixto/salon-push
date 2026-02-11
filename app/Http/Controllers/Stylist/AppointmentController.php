<?php

namespace App\Http\Controllers\Stylist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Panel principal de citas del estilista.
     * Muestra citas filtradas por día, semana o mes.
     *
     * Parámetros opcionales:
     *   ?view=day|week|month (default: week)
     *   ?date=2026-02-10 (fecha de referencia, default: hoy)
     */
    public function index(Request $request)
    {
        // Obtener el perfil de estilista del usuario autenticado
        $stylist = Stylist::where('user_id', Auth::id())->first();

        if (!$stylist) {
            return view('stylist.appointments.index', [
                'appointments'  => collect(),
                'currentView'   => 'week',
                'referenceDate' => today(),
                'periodLabel'   => '',
                'stats'         => ['total' => 0, 'pending' => 0, 'confirmed' => 0, 'completed' => 0],
            ]);
        }

        // Parámetros de filtro
        $currentView   = $request->get('view', 'week');
        $referenceDate = $request->get('date') ? Carbon::parse($request->get('date')) : today();

        // Calcular rango de fechas según la vista
        switch ($currentView) {
            case 'day':
                $startDate = $referenceDate->copy()->startOfDay();
                $endDate   = $referenceDate->copy()->endOfDay();
                $periodLabel = $referenceDate->translatedFormat('l, d \d\e F Y');
                break;

            case 'month':
                $startDate = $referenceDate->copy()->startOfMonth();
                $endDate   = $referenceDate->copy()->endOfMonth();
                $periodLabel = $referenceDate->translatedFormat('F Y');
                break;

            case 'week':
            default:
                $currentView = 'week';
                $startDate = $referenceDate->copy()->startOfWeek(Carbon::MONDAY);
                $endDate   = $referenceDate->copy()->endOfWeek(Carbon::SATURDAY);
                $periodLabel = $startDate->format('d M') . ' — ' . $endDate->format('d M, Y');
                break;
        }

        // Consultar citas del estilista en el rango
        $appointments = Appointment::where('stylist_id', $stylist->id)
            ->whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
            ->with(['service', 'client'])
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        // Estadísticas rápidas del período
        $stats = [
            'total'     => $appointments->count(),
            'pending'   => $appointments->where('status', 'pending')->count(),
            'confirmed' => $appointments->where('status', 'confirmed')->count(),
            'completed' => $appointments->where('status', 'completed')->count(),
        ];

        // Para la vista semanal: agrupar por fecha
        $appointmentsByDate = $appointments->groupBy(function ($a) {
            return $a->date->format('Y-m-d');
        });

        // Generar los días de la semana para la vista semanal
        $weekDays = [];
        if ($currentView === 'week') {
            $day = $startDate->copy();
            while ($day->lte($endDate)) {
                $weekDays[] = $day->copy();
                $day->addDay();
            }
        }

        return view('stylist.appointments.index', compact(
            'appointments',
            'appointmentsByDate',
            'weekDays',
            'currentView',
            'referenceDate',
            'periodLabel',
            'stats'
        ));
    }
}
