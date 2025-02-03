<?php

namespace App\MaintenanceMode;

use Illuminate\Contracts\Foundation\MaintenanceMode;

class FileBasedMaintenanceMode implements MaintenanceMode
{
    protected $app;
    protected $downFile;

    public function __construct($app, $downFile)
    {
        $this->app = $app;
        $this->downFile = $downFile;
    }

    /**
     * Indica si la aplicación está en modo de mantenimiento.
     *
     * @return bool
     */
    public function active(): bool
    {
        return file_exists($this->downFile);
    }

    /**
     * Activa el modo de mantenimiento.
     *
     * @param mixed $down
     * @return void
     */
    public function activate($down = null): void
    {
        // Puedes personalizar esta lógica según tus necesidades.
        $this->update($down);
    }

    /**
     * Desactiva el modo de mantenimiento.
     *
     * @return void
     */
    public function deactivate(): void
    {
        $this->flush();
    }

    /**
     * Actualiza el estado de mantenimiento.
     *
     * @param mixed $down
     * @return void
     */
    public function update($down = null): void
    {
        if ($down) {
            file_put_contents($this->downFile, json_encode($down));
        } else {
            if (file_exists($this->downFile)) {
                unlink($this->downFile);
            }
        }
    }

    /**
     * Limpia (flush) el estado de mantenimiento.
     *
     * @return void
     */
    public function flush(): void
    {
        if (file_exists($this->downFile)) {
            unlink($this->downFile);
        }
    }

    /**
     * Devuelve los datos asociados al modo de mantenimiento.
     *
     * @return array
     */
    public function data(): array
    {
        if (file_exists($this->downFile)) {
            $data = json_decode(file_get_contents($this->downFile), true);
            return is_array($data) ? $data : [];
        }
        return [];
    }
}
