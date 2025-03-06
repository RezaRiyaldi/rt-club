<?php

namespace App\Controllers;

use App\Models\IuranModel;
use App\Models\PengeluaranModel;
use App\Models\WargaModel;
use DateTime;

class Home extends BaseController
{
    public function index(): string
    {
        $iuransModel = new IuranModel();
        $iuran = $iuransModel->selectSum('nominal')->get()->getRow();

        $pengeluaranModel = new PengeluaranModel();
        $pengeluaran = $pengeluaranModel->selectSum('nominal')->get()->getRow();

        $wargaModel = new WargaModel();

        // TOTAL WARGA
        $totalWarga = $wargaModel->selectCount('id');
        if (in_groups('warga')) {
            $totalWarga = $totalWarga->where('user_id', user()->id);
        }
        $totalWarga = $totalWarga->get()->getRow()->id;

        // TOTAL KEPALA KELUARGA
        $totalKepalaKeluarga = $wargaModel->selectCount('id');
        if (in_groups('warga')) {
            $totalKepalaKeluarga = $totalKepalaKeluarga->where('user_id', user()->id);
        }
        $totalKepalaKeluarga = $totalKepalaKeluarga->where('status_family', 'Kepala Keluarga')->get()->getRow()->id;

        // TOTAL ANAK
        $anak = $wargaModel->where('status_family', 'Anak');
        if (in_groups('warga')) {
            $noKK = $wargaModel->select('no_kk')->where('user_id', user()->id)->get()->getRow()->no_kk;
            $anak = $anak->where('no_kk', $noKK);
        }
        $anak = $anak->get()->getResult();

        // TOTAL WARGA BELUM MENIKAH
        $totalWargaBelumMenikah = $wargaModel->selectCount('id')
            ->where('marital_status', 'Belum Menikah');
        if (in_groups('warga')) {
            $noKK = $wargaModel->select('no_kk')->where('user_id', user()->id)->get()->getRow()->no_kk;
            $totalWargaBelumMenikah = $totalWargaBelumMenikah->where('no_kk', $noKK);
        }
        $totalWargaBelumMenikah = $totalWargaBelumMenikah->get()->getRow()->id;

        $totalAnak = count($anak);
        $totalAnakDibawah17 = 0;
        $totalAnakDiatas17 = 0;

        foreach ($anak as $a) {
            $birthDate = new DateTime($a->birth_of_day);
            $today = new DateTime();
            $age = $today->diff($birthDate)->y;

            if ($age < 17) {
                $totalAnakDibawah17++;
            } else {
                $totalAnakDiatas17++;
            }
        }

        $jumlahWarga = [
            'total_warga' => $totalWarga,
            'total_kepala_keluarga' => $totalKepalaKeluarga,
            'total_warga_belum_menikah' => $totalWargaBelumMenikah,
            'total_anak' => $totalAnak,
            'total_anak_dibawah_17' => $totalAnakDibawah17,
            'total_anak_diatas_17' => $totalAnakDiatas17,
        ];

        $data = [
            'pemasukan' => 'Rp. ' . number_format($iuran->nominal, 0, ',', '.'),
            'pengeluaran' => 'Rp. ' . number_format($pengeluaran->nominal, 0, ',', '.'),
            'jumlah_warga' => $jumlahWarga
        ];

        return view('dashboard/index', $data);
    }

    private function getMonths($key = 0)
    {
        $months = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        return $months[$key];
    }

    public function getKeuangan()
    {
        $iuran = new IuranModel();
        $iuran = $iuran->select("MONTH(periode) as bulan, YEAR(periode) as tahun");
        $iuran = $iuran->selectSum('nominal');
        $iuran = $iuran->groupBy(['bulan', 'tahun']);
        $iuran = $iuran->orderBy('periode', 'desc');
        $iuran = $iuran->limit(12)->get()->getResult();

        $pengeluaran = new PengeluaranModel();
        $pengeluaran = $pengeluaran->select("MONTH(periode) as bulan, YEAR(periode) as tahun");
        $pengeluaran = $pengeluaran->selectSum('nominal');
        $pengeluaran = $pengeluaran->groupBy(['bulan', 'tahun']);
        $pengeluaran = $pengeluaran->orderBy('periode', 'desc');
        $pengeluaran = $pengeluaran->limit(12)->get()->getResult();

        $month = [];
        foreach ($iuran as $i) {
            $month[$i->tahun . $i->bulan]['bulan'] = $i->bulan;
            $month[$i->tahun . $i->bulan]['tahun'] = $i->tahun;
        }

        foreach ($pengeluaran as $p) {
            $month[$p->tahun . $p->bulan]['bulan'] = $p->bulan;
            $month[$p->tahun . $p->bulan]['tahun'] = $p->tahun;
        }

        ksort($month);

        $months = [];
        $dataset1 = [];
        $dataset2 = [];
        foreach ($month as $m) {
            $months[] = $this->getMonths($m['bulan'] - 1) . " - " . $m['tahun'];

            $filtered_iuran = array_filter($iuran, function ($item) use ($m) {
                return $item->bulan == $m['bulan'];
            });

            $filtered_pengeluaran = array_filter($pengeluaran, function ($item) use ($m) {
                return $item->bulan == $m['bulan'];
            });

            if (!empty($filtered_iuran)) {
                $dataset1[] = reset($filtered_iuran)->nominal;
            } else {
                $dataset1[] = 0;
            }

            if (!empty($filtered_pengeluaran)) {
                $dataset2[] = reset($filtered_pengeluaran)->nominal;
            } else {
                $dataset2[] = 0;
            }
        }

        $data = [
            'labels' => $months,
            'dataset1' => $dataset1,
            'dataset2' => $dataset2
        ];

        return $this->response->setJSON($data);
    }

    public function not_permission()
    {
        return view('errors/custom/not_permission');
    }
}
