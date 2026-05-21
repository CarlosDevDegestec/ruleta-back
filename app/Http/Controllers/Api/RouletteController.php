<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\Prize;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RouletteController extends Controller
{
    public function show(): JsonResponse
    {
        $prizes = Prize::where('is_active', true)->get();

        if ($prizes->isEmpty()) {
            return response()->json(['error' => 'No hay premios disponibles.'], 404);
        }

        $winnerIndex = $this->weightedRandom($prizes);

        return response()->json([
            'winner_index' => $winnerIndex,
            'prizes' => $prizes->map(fn($p) => [
                'id'     => $p->id,
                'name'   => $p->name,
                'rarity' => $p->rarity,
                'weight' => $p->weight,
                'color'  => $p->rarity_color,
            ]),
        ]);
    }

    public function questions(): JsonResponse
    {
        $questions = Question::where('is_active', true)
            ->orderBy('order')
            ->get(['id', 'question', 'type']);

        return response()->json($questions);
    }

    public function claim(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'prize_id'      => 'required|exists:prizes,id',
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:30',
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

        return response()->json(['success' => true, 'claim' => $claim], 201);
    }

    private function weightedRandom($prizes): int
    {
        $totalWeight = $prizes->sum('weight');
        $rand = mt_rand(1, $totalWeight);
        $cumulative = 0;

        foreach ($prizes as $index => $prize) {
            $cumulative += $prize->weight;
            if ($rand <= $cumulative) {
                return $index;
            }
        }

        return 0;
    }
}
