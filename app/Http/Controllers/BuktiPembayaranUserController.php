    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\BuktiPembayaranUser;
    use App\Models\PesananDetail;
    use App\Models\User;


    class BuktiPembayaranUserController extends Controller
    {
        public function index(Request $request)
        {



        // $data = [
        //     'status' => 2
        // ];
        // PesananDetail::where('id', $request->pesanan_detail_id)->update($data);

        // return $request->file('image')->store('bukti-tf');
            $validasi = $request->validate([
                'pesanan_detail_id' => ['required'],
                'gambar' => ['file', 'max:2024'],
            // 'users' => User::all(),
            // 'tittle' => 'halaman history'
            ]);

            if ($request->file('image')) {
                $validasi['image'] = $request->file('image')->store('bukti-tf');
            }

            BuktiPembayaranUser::create($validasi);

            $user_id = auth()->user()->id;

            return redirect('history/' . $user_id)->with('success', 'Upload Bukti Pembayaran All Is Done!!');
        }
    }
