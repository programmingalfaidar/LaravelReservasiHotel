 <?php

 namespace App\Http\Controllers;

 use App\Models\BuktiPembayaranUser;
 use App\Models\User;

 use App\Models\Kamar;
 use App\Models\pesanan;
 use App\Models\PesananDetail;
 use Illuminate\Http\Request;
 use Illuminate\Support\Carbon;
 use Illuminate\Support\Facades\Redirect;
 use Barryvdh\DomPDF\Facade\Pdf;
 use Dompdf\Dompdf;

 class  PemesananUserController extends Controller
 {

    public  function pesan(Kamar $kamar)
    {
        return view('User.Pesanan.IsiData', [
            'users' => User::all(),
            'title' => 'Title',
            'data' => $kamar,
            'kamar' => $kamar
        ]);
    }

    public function pesanan(Request $request, Kamar $kamar)
    {
        if ($request->jumlah_kamar > 0) {
            $tanggal_pesan = Carbon::now();

            // Tabel Pesanan
            // cek user
            $cekUser = Pesanan::where('user_id', auth()->user()->id)->first();
            if (empty($cekUser)) {
                //  tambah ke pesanan
                $tambah = [
                    'user_id' => auth()->user()->id,
                    'tanggal_pesan' => $tanggal_pesan,
                    'jumlah_kamar' => $request->jumlah_kamar,
                    'cek_pesanan' => '0',
                    'total_harga' => $kamar->harga * $request->jumlah_kamar
                ];

                Pesanan::create($tambah);
            } else {
                //  update pesanan
                $ubah = [
                    'tanggal_pesan' => $tanggal_pesan,
                    'jumlah_kamar' => $cekUser->jumlah_kamar + $request->jumlah_kamar,
                    'total_harga' => $cekUser->total_harga + $kamar->harga * $request->jumlah_kamar
                ];
                Pesanan::where('id', $cekUser->id)->update($ubah);
            }
            // End tabel Pesanan

            // Tabel PesananDetail
            $cekUser = Pesanan::where('user_id', auth()->user()->id)->first();
            $pDetail = PesananDetail::where('kamar_id', $kamar->id)->where('pesanan_id', $cekUser->id)->first();
            // End Tabel PesananDetail
            if (empty($pDetail)) {
                // tambah ke PesananDetail
                $create = [
                    'pesanan_id' => $cekUser->id,
                    'kamar_id' => $kamar->id,
                    'jumlah' => $request->jumlah_kamar,
                    'status' => '0',
                    'harga' => $kamar->harga * $request->jumlah_kamar
                ];
                // return $create;
                PesananDetail::create($create);
            } else {
                // update pesananDetail
                $edit = [
                    'jumlah' => $pDetail->jumlah + $request->jumlah_kamar,
                    'harga' => $pDetail->harga + $kamar->harga * $request->jumlah_kamar
                ];
                PesananDetail::where('id', $pDetail->id)->update($edit);
            }
            return redirect('/keranjang_pemesanan')->with('success', 'Pesanan berhasil ditambahkan');
        } else {
            return redirect('/keranjang_pemesanan')->with('success', 'Silahkan isi jumlah kamar pesan!');
        }
    }

    public function keranjang()
    {
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->first();
        if (empty($pesanan)) {
            // $pDetail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
            return view('User.Pesanan.keranjang', [
                'users' => User::all(),
                'title' => 'Keranjang Pemesanan Tiket ' . auth()->user()->username
            ]);
        } else { 
            $pDetail = PesananDetail::where('status', 0)->where('pesanan_id', $pesanan->id)->get();
            return view('User.Pesanan.keranjang', [
                'users' => User::all(),
                'title' => 'Keranjang Pemesanan Tiket ' . auth()->user()->username,
                'pesanans' => $pDetail
            ]);
        }
    }


    public function detailPesananUser($id)
    {
        $PesananDetail = PesananDetail::Where('id', $id)->first();
        $buktiTf = BuktiPembayaranUser::where('pesanan_detail_id', $PesananDetail->id)->first();

        return view('User.Pesanan.detail_pesanan_user', [
            'title' => 'halaman detail',
            'users' => User::all(),
            'PDetail' => $PesananDetail,
            'buktiTf' => $buktiTf
        ]);
    }

    public function checkout($id)
    {
        $PesananDetail = PesananDetail::where('id', $id)->first();
        $updatePesananDetail = [
            'status' => 1,

        ];

        PesananDetail::where('id', $PesananDetail->id)->update($updatePesananDetail);
        return redirect('detail-pesanan-user/' . $PesananDetail->id)->with('success', 'Anda Berhasil Melakukan CheckOut');
    }

    public function history($id)
    {
        $pesanan = Pesanan::where('user_id', $id)->first();
        $PesananDetail = PesananDetail::where('pesanan_id', $pesanan->id)->first();

        $buktiTF = BuktiPembayaranUser::where('pesanan_detail_id', $PesananDetail->id)->first();

        // return $buktiTF;

        if (!empty($pesanan)) {
        } else {
            $pDPetails = PesananDetail::where('status', '1')->where('pesanan_id', $pesanan->id)->get();
        }
        if (!empty($pDetails)) {
            return view('User.Pesanan.History', [
                'title' => 'History' . auth()->user()->name,
                'users' => User::all(),
                'buktiTf' => $buktiTF

            ]);
        } else {
            $pDetails = PesananDetail::where('status', '1')->where('pesanan_id', $pesanan->id)->get();
            return view('User.Pesanan.History', [
                'title' => 'History Pemesanan' .  auth()->user()->name,
                'pDetails' => $pDetails,
                'users' => User::all(),
                'buktiTf' => $buktiTF
            ]);
        }
    }

    public function TambahKamar()
    {
        return view('User.Pesanan.DataPesanan', [
            'title' => 'Data Kamar',
            'users' => User::all(),
            'kamars' => Kamar::all()
        ]);
    }

    public function ExportPdf($id)
    {
        $pDetails = PesananDetail::where('id', $id)->first();

        view()->share('tiket', $pDetails);
        $pdf = new DomPdf();
        $pdf = PDF::loadview('User.Pesanan.DataPdf');
        return $pdf->download('tiket.pdf');
    }
}
