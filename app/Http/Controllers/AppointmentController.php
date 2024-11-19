<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Appointment::orderBy('scheduled')->with(['pet.tutor', 'doctor'])->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appointment = Appointment::with(['pet.owner', 'doctor'])->find($id);
        if (!$appointment) {
            return response()->json(['message' => 'Agendamento não encontrado'], 404);
        }
        return response()->json($appointment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return response()->json(['message' => 'Agendamento não encontrado'], 404);
        }

        // Validar e atualizar os dados
        $validatedData = $request->validate([
            'scheduled' => 'required|date',
            'pet_id' => 'required|exists:pets,id',
            'doctor_id' => 'required|exists:doctors,id',
            'description' => 'nullable|string',
            'status' => 'nullable|string'
        ]);

        $appointment->update($validatedData);

        return response()->json(['message' => 'Agendamento atualizado com sucesso', 'appointment' => $appointment]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return response()->json(['message' => 'Agendamento não encontrado'], 404);
        }

        $appointment->delete();

        return response()->json(['message' => 'Agendamento deletado com sucesso']);
    }
}
