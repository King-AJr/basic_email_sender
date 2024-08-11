<?php

namespace Database\Seeders;

use App\Models\LaboratoryTest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaboratoryTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tests = [
            "x_ray" => [
                "Chest",
                "Cervical Vertebrae",
                "Thoracic Vertebrae",
                "Lumbar Vertebrae",
                "Lumbo Sacral Vertebrae",
                "Thoraco Lumbar Vertebrae",
                "Shoulder Joint",
                "Elbow Joint",
                "Wrist Joint",
                "Knee Joint",
                "Pelvic Joint",
                "Hip Joint",
                "Femoral",
                "Ankle",
                "Humerus",
                "Radius/Ulna",
                "Foot",
                "Sacro Iliac Joint",
                "Thoracic Inlet",
                "Tibia/Fibula",
                "Fingers",
                "Toes"
            ],
            "ultrasound_scan" => [
                "Obstetric",
                "Abdominal",
                "Pelvis",
                "Prostate",
                "Breast",
                "Thyroid"
            ],
            "ct_scan" => [
                "Head",
                "Chest",
                "Abdomen",
                "Pelvis",
                "Spine"
            ],
            "mri" => [
                "Brain",
                "Spine",
                "Knee",
                "Shoulder",
                "Abdomen"
            ]
        ];

        foreach ($tests as $category => $testNames) {
            foreach ($testNames as $name) {
                LaboratoryTest::create([
                    'name' => $name,
                    'category' => $category,
                ]);
            }
        }
    }
}
