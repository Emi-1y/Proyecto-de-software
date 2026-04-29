<?php

// Author: Equipo Raíces

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name'        => 'Mantenimiento de Jardín',
                'employee'    => null,
                'description' => 'Visita mensual de expertos para mantener tu jardín en perfectas condiciones durante todo el año.',
                'price'       => 180000,
                'duration'    => '2–4 horas',
                'emoji'       => '🌳',
                'active'      => true,
                'features'    => json_encode([
                    'Poda y corte de césped',
                    'Fertilización programada',
                    'Control preventivo de plagas',
                    'Riego y drenaje',
                ]),
            ],
            [
                'name'        => 'Diseño de Jardín',
                'employee'    => null,
                'description' => 'Creamos el jardín de tus sueños desde cero: diagnóstico, diseño personalizado e instalación completa.',
                'price'       => 450000,
                'duration'    => '1–2 días',
                'emoji'       => '🎨',
                'active'      => true,
                'features'    => json_encode([
                    'Plano de diseño en 2D',
                    'Selección de especies',
                    'Instalación completa',
                    'Garantía 30 días',
                ]),
            ],
            [
                'name'        => 'Poda Especializada',
                'employee'    => null,
                'description' => 'Poda técnica y artística para árboles, setos y arbustos ornamentales de todo tipo.',
                'price'       => 120000,
                'duration'    => '1–3 horas',
                'emoji'       => '✂️',
                'active'      => true,
                'features'    => json_encode([
                    'Poda artística y fitosanitaria',
                    'Retiro de residuos vegetales',
                    'Tratamiento cicatrizante en cortes',
                    'Recomendaciones post-poda',
                ]),
            ],
            [
                'name'        => 'Huerta Urbana',
                'employee'    => null,
                'description' => 'Instalación, siembra y capacitación para tu propia huerta orgánica en casa o apartamento.',
                'price'       => 280000,
                'duration'    => '4–6 horas',
                'emoji'       => '🥕',
                'active'      => true,
                'features'    => json_encode([
                    'Adecuación del espacio',
                    'Selección de cultivos según temporada',
                    'Siembra inicial incluida',
                    'Taller de capacitación',
                ]),
            ],
            [
                'name'        => 'Control de Plagas',
                'employee'    => null,
                'description' => 'Diagnóstico y tratamiento ecológico de plagas e infecciones fúngicas en tus plantas.',
                'price'       => 95000,
                'duration'    => '1–2 horas',
                'emoji'       => '🔬',
                'active'      => true,
                'features'    => json_encode([
                    'Diagnóstico fitosanitario',
                    'Tratamiento con productos ecológicos',
                    'Plan de prevención personalizado',
                    'Seguimiento a los 15 días',
                ]),
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
