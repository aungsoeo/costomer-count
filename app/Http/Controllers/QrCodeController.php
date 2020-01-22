<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QRGallery;
use QrCode;
use Storage;

class QrCodeController extends Controller
{
    /**
     * Listing Of images gallery
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$images = QRGallery::orderBy('id','desc')->get();
    	return view('image-gallery',compact('images'));
    }


    /**
     * Upload image function
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required',
            'url' => 'required',
        ]);

        $url = $request->url;

        $image = \QrCode::format('png')
                 // ->merge('img/t.jpg', 0.1, true)
                 ->size(300)->errorCorrection('H')
                 ->generate($url);

		$output_file = '/img/qr-code/img-' . time() . '.png';
		Storage::disk('public')->put($output_file, $image);


        $input['title'] = $request->title;
        $input['image'] = 'img-' . time() . '.png';

        QRGallery::create($input);


    	return back()
    		->with('success','Image Uploaded successfully.');
    }


    /**
     * Remove Image function
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	QRGallery::find($id)->delete();
    	return back()
    		->with('success','Image removed successfully.');	
    }
}
