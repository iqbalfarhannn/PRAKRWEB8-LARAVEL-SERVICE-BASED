<?php

namespace App\Services;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Collection;

class PegawaiService
{
    public function getAllPegawai(): Collection
    {
        return Pegawai::all();
    }

    public function getPegawaiById(int $id): ?Pegawai
    {
        return Pegawai::find($id);
    }

    public function createPegawai(array $data): Pegawai
    {
        return Pegawai::create($data);
    }

    public function updatePegawai(int $id, array $data): ?Pegawai
    {
        $pegawai = Pegawai::find($id);
        if ($pegawai) {
            $pegawai->update($data);
        }
        return $pegawai;
    }

    public function deletePegawai(int $id): bool
    {
        $pegawai = Pegawai::find($id);
        if ($pegawai) {
            return $pegawai->delete();
        }
        return false;
    }
}