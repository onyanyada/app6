<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; // Validatorのインポート
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;


class BioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 現在認証しているユーザーを取得
        $user = Auth::user();
        return view(
            'bio.index',
            [
                'bio' => $user->bio
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        // 既に自己紹介がある場合は、新しい自己紹介を作成させない
        if ($user->bio) {
            return redirect()->route('bio.edit')->with('error', '既に自己紹介があります。編集してください。');
        }
        return view('bio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // 既に自己紹介がある場合は、新しい自己紹介を作成させない
        if ($user->bio) {
            return redirect()->route('bio.edit')->with('error', '既に自己紹介があります。編集してください。');
        }

        //バリデーション
        $validator = Validator::make($request->all(), [
            'name' => 'required | min:1 | max:255',
            'body' => 'required | min:1 | max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'  // 画像のバリデーション

        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        //以下に登録処理を記述（Eloquentモデル）

        // Eloquentモデル
        $bio = new Bio;
        $bio->user_id  = Auth::user()->id;
        $bio->name = $request->name;
        $bio->body = $request->body;

        // 画像ファイルの処理
        if ($request->hasFile('img')) {
            //GDドライバ使う
            $manager = new ImageManager(new Driver());
            $imageFile = $request->file('img');

            // 画像をIntervention Imageで読み込む
            $image = $manager->read($imageFile->getRealPath());

            // 画像をリサイズ（例：横幅を300pxに設定、縦横比を維持）
            $image->scaleDown(width: 300);

            // 圧縮してJPEG形式で保存 (Quality: 70)
            $compressedImage =
                $image->toJpeg(70);
            // 画像の保存パスを生成
            $filename = uniqid() . '.jpg';
            $path = 'public/profile_images/' . $filename;

            // $compressedImageをstorageに保存
            Storage::put($path, $compressedImage);

            // ファイルの相対パス(公開用パス)を取得してimg_urlカラムに保存
            $bio->img_url = Storage::url($path);
        }

        $bio->save();
        return redirect('/bio');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bio $bio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bio $bio)
    {
        $user = Auth::user();

        if (!$user->bio) {
            return redirect()->route('bio.create')->with('error', 'まだ自己紹介がありません。作成してください。');
        }

        return view('bio.edit', ['bio' => $user->bio]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bio $bio)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'name' => 'required | min:1 | max:255',
            'body' => 'required | min:1 | max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'  // 画像のバリデーション

        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        //以下に登録処理を記述（Eloquentモデル）

        // Eloquentモデル
        $user = Auth::user();
        $bio = $user->bio;
        $bio->name = $request->name;
        $bio->body = $request->body;

        // 画像削除処理
        if ($request->has('delete_img') && $request->delete_img == '1') {
            // 既存の画像がある場合、ストレージから削除
            if ($bio->img_url && Storage::exists($bio->img_url)) {
                Storage::delete($bio->img_url);
            }
            // img_urlをnullに設定
            $bio->img_url = null;
        }


        // 画像ファイルの処理
        if ($request->hasFile('img')) {
            //GDドライバ使う
            $manager = new ImageManager(new Driver());
            $imageFile = $request->file('img');

            // 画像をIntervention Imageで読み込む
            $image = $manager->read($imageFile->getRealPath());

            // 画像をリサイズ（例：横幅を300pxに設定、縦横比を維持）
            $image->scaleDown(width: 300);

            // 圧縮してJPEG形式で保存 (Quality: 70)
            $compressedImage =
                $image->toJpeg(70);
            // 画像の保存パスを生成
            $filename = uniqid() . '.jpg';
            $path = 'public/profile_images/' . $filename;

            // $compressedImageをstorageに保存
            Storage::put($path, $compressedImage);

            // ファイルの相対パス(公開用パス)を取得してimg_urlカラムに保存
            $bio->img_url = Storage::url($path);
        }

        $bio->save();
        return redirect('/bio');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bio $bio)
    {
        //
    }
}
