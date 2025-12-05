<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncar tablas y reiniciar IDs (PostgreSQL)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->confirm('¿Estás seguro de que quieres truncar las tablas? Esto eliminará todos los datos.')) {
            $this->info('Operación cancelada.');
            return;
        }

        $this->info('Truncando tablas...');
        $this->info('');

        try {
            // Lista de tablas a truncar (excepto users y password_reset_tokens)
            $tables = [
                'clientes',
                'proveedores',
                'productos',
                'ventas',
                'detalle_ventas',
                'compras',
                'detalle_compras',
                'reportes',
                'cache',
                'cache_locks',
                'jobs',
                'job_batches',
                'failed_jobs',
                'sessions'
            ];

            foreach ($tables as $table) {
                try {
                    // Para PostgreSQL, usar TRUNCATE con CASCADE y RESTART IDENTITY
                    DB::statement("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE;");
                    $this->info("✓ Tabla '{$table}' truncada y secuencia reiniciada");
                } catch (\Exception $e) {
                    $this->warn("✗ No se pudo truncar '{$table}': " . $e->getMessage());
                }
            }

            $this->info('');
            $this->info('✅ Proceso completado exitosamente');
            $this->info('');
            $this->info('Nota: La tabla "users" no fue truncada para preservar los usuarios del sistema.');

        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
