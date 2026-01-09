<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssignmentsSeeder extends Seeder
{
    public function run()
    {
        $assets = Asset::where('status', 'Available')->take(5)->get();
        $users = User::where('is_active', true)->take(3)->get();
        
        foreach ($assets as $index => $asset) {
            if (isset($users[$index % count($users)])) {
                Assignment::create([
                    'asset_id' => $asset->id,
                    'user_id' => $users[$index % count($users)]->id,
                    'assigned_by' => 1, // admin user
                    'assigned_date' => now()->subDays(rand(1, 30)),
                    'expected_return_date' => now()->addDays(rand(30, 90)),
                    'assignment_status' => 'active',
                    'assignment_notes' => 'Regular assignment'
                ]);
                
                // Update asset status
                $asset->update(['status' => 'Assigned']);
            }
        }
    }
}