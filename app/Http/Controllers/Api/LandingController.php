<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prize;
use App\Models\Question;
use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LandingController extends Controller
{
    public function rouletteShow(): JsonResponse
    {
        $prizes = Prize::where('is_active', true)->get();

        if ($prizes->isEmpty()) {
            return response()->json(['error' => 'No hay premios disponibles.'], 404);
        }

        // Weighted random selection
        $totalWeight = $prizes->sum('weight');
        $rand = mt_rand(1, $totalWeight);
        $cumulative = 0;
        $winnerIndex = 0;

        foreach ($prizes as $index => $prize) {
            $cumulative += $prize->weight;
            if ($rand <= $cumulative) {
                $winnerIndex = $index;
                break;
            }
        }

        return response()->json([
            'winner_index' => $winnerIndex,
            'prizes' => $prizes->map(fn($p) => [
                'id'     => $p->id,
                'name'   => $p->name,
                'rarity' => $p->rarity,
                'weight' => $p->weight,
                'color'  => $p->rarity_color,
            ])->values(),
        ]);
    }

    public function questionsShow(): JsonResponse
    {
        $questions = Question::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(fn($q) => [
                'id'       => $q->id,
                'question' => $q->question,
                'type'     => $q->type,
            ]);

        return response()->json($questions);
    }

    public function claim(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'prize_id'      => 'required|exists:prizes,id',
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'email'         => 'required|email|max:255',
            'notifications' => 'boolean',
        ]);

        $claim = Claim::create([
            'prize_id'      => $validated['prize_id'],
            'name'          => $validated['name'],
            'phone'         => $validated['phone'],
            'email'         => $validated['email'],
            'notifications' => $validated['notifications'] ?? false,
        ]);

        return response()->json([
            'success' => true,
            'claim'   => $claim->load('prize'),
        ], 201);
    }
}
