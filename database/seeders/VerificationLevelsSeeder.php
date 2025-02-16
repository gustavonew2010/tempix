<?php

namespace Database\Seeders;

use App\Models\VerificationLevel;
use Illuminate\Database\Seeder;

class VerificationLevelsSeeder extends Seeder
{
    public function run()
    {
        $levels = [
            [
                'name' => 'Bronze',
                'slug' => 'bronze',
                'color_hex' => '#CD7F32',
                'description' => 'Nível inicial - Sem verificações necessárias',
                'withdrawal_limit' => 1000.00,
                'points_required' => 0,
                'requirements' => []  // Nenhum requisito para bronze
            ],
            [
                'name' => 'Prata',
                'slug' => 'silver',
                'color_hex' => '#C0C0C0',
                'description' => 'Email e Telefone verificados',
                'withdrawal_limit' => 5000.00,
                'points_required' => 100,
                'requirements' => [
                    'email_verified' => true,
                    'phone_verified' => true
                ]
            ],
            [
                'name' => 'Ouro',
                'slug' => 'gold',
                'color_hex' => '#FFD700',
                'description' => 'Documentação completa verificada',
                'withdrawal_limit' => 50000.00,
                'points_required' => 300,
                'requirements' => [
                    'cpf_verified' => true,
                    'document_verified' => true,
                    'selfie_verified' => true
                ]
            ]
        ];

        foreach ($levels as $level) {
            VerificationLevel::create($level);
        }
    }
} 