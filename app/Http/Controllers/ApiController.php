<?php

namespace App\Http\Controllers;

use App\Models\zzz_char;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function index(): JsonResponse
    {
        $characters = zzz_char::all();
        return response()->json(['message' => 'Characters retrieved successfully', 'data' => $characters]);
    }
    
    public function show($id): JsonResponse
    {
        $character = zzz_char::with(['zzz_diskdrive', 'zzz_wengine', 'zzz_bestdiskdrivestat'])->find($id);
        
        if (!$character) {
            return response()->json(['message' => 'Character not found'], 404);
        }
        
        return response()->json(['message' => 'Character retrieved successfully', 'data' => $character]);
    }
    
    public function store(Request $request)
    {
        try {
            $createdCharacters = [];
            $requestData = $request->all();

            // Validate that we have data
            if (empty($requestData)) {
                return response()->json([
                    'message' => 'No character data provided'
                ], 400);
            }

            DB::table('zzz_chars')->delete(); 
            DB::statement('ALTER TABLE zzz_chars AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE zzz_diskdrives AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE zzz_wengines AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE zzz_bestdiskdrivestats AUTO_INCREMENT = 1');

            DB::beginTransaction();

            foreach ($requestData as $characterKey => $characterData) {
                // Skip fields that should not be mass assigned
                $characterData = collect($characterData)->except(['id', 'created_at', 'updated_at'])->toArray();

                // Validate required fields for each character
                if (!isset($characterData['name']) || !isset($characterData['link']) || 
                    !isset($characterData['image']) || !isset($characterData['element']) || 
                    !isset($characterData['element_picture']) || !isset($characterData['tier'])) {
                    throw new \Exception("Missing required fields for character: {$characterKey}");
                }

                // Create character
                $character = zzz_char::create([
                    'name' => substr($characterData['name'], 0, 255),
                    'link' => substr($characterData['link'], 0, 255),
                    'image' => substr($characterData['image'], 0, 500),
                    'element' => substr($characterData['element'], 0, 100),
                    'element_picture' => substr($characterData['element_picture'], 0, 500),
                    'tier' => substr($characterData['tier'], 0, 50),
                ]);

                // Create related diskdrives
                if (isset($characterData['zzz_diskdrive'])) {
                    foreach ($characterData['zzz_diskdrive'] as $diskdrive) {
                        $character->zzz_diskdrive()->create([
                            'name' => substr($diskdrive['name'], 0, 255),
                            'detail_2pc' => substr($diskdrive['detail_2pc'], 0, 255),
                            'detail_4pc' => substr($diskdrive['detail_4pc'], 0, 255),
                        ]);
                    }
                }

                // Create related wengines
                if (isset($characterData['zzz_wengine'])) {
                    foreach ($characterData['zzz_wengine'] as $wengine) {
                        $character->zzz_wengine()->create([
                            'build_name' => substr($wengine['build_name'], 0, 255),
                            'w_engine_picture' => substr($wengine['w_engine_picture'], 0, 500),
                            'detail' => substr($wengine['detail'], 0, 255),
                        ]);
                    }
                }

                // Create related best disk drive stats
                if (isset($characterData['zzz_bestdiskdrivestat'])) {
                    foreach ($characterData['zzz_bestdiskdrivestat'] as $beststat) {
                        $character->zzz_bestdiskdrivestat()->create([
                            'disk_number' => substr($beststat['disk_number'], 0, 50),
                            'substats' => substr($beststat['substats'], 0, 255),
                            'endgame_stats' => substr($beststat['endgame_stats'], 0, 255),
                        ]);
                    }
                }

                // Load relations for response
                $character->load(['zzz_diskdrive', 'zzz_wengine', 'zzz_bestdiskdrivestat']);
                $createdCharacters[] = $character;
            }

            DB::commit();

            return response()->json([
                'message' => 'All old data deleted and ' . count($createdCharacters) . ' characters created successfully',
                'data' => $createdCharacters
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create characters',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}