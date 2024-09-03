<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait MediaUploadingTrait
{
    public function storeMedia(Request $request)
    {
        // Validates file size
        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 1024,
            ]);
        }
        // If width or height is preset - we are validating it as an image
        if (request()->has('width') || request()->has('height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('width', 100000),
                    request()->input('height', 100000)
                ),
            ]);
        }

        $path = storage_path('tmp/uploads');

        try {
            if (! file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
        }

        $file = $request->file('file');

        // $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $originname = trim($file->getClientOriginalName());

        $filename = pathinfo($originname, PATHINFO_FILENAME);
        $extension = pathinfo($originname, PATHINFO_EXTENSION);

        $filtername=$this->normalizeString($filename);

        $name = $filtername.'.'.$extension;

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public static function normalizeString($string = '')
    {
        $string = strip_tags($string);
        $string = preg_replace('/[\r\n\t ]+/', ' ', $string);
        $string = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $string);
        $string = strtolower($string);
        $string = html_entity_decode($string, ENT_QUOTES, 'utf-8');
        $string = htmlentities($string, ENT_QUOTES, 'utf-8');
        $string = str_replace('iso', '', $string);
        $string = preg_replace('/.png|.jpg|.jpeg|.gif|\[(.*?)\]|\((.*?)\)+/', '', $string);
        $string = str_replace('(', '', $string);
        $string = str_replace(')', '', $string);
        $string = str_replace('@', '', $string);
        $string = str_replace('[', '', $string);
        $string = str_replace(']', '', $string);
        $string = preg_replace('/(&)([a-z])([a-z]+;)/i', '$2', $string);
        $string = str_replace(' ', '_', $string);
        $string = str_replace('.', '_', $string);
        $string = str_replace('-', '_', $string);
        $string = rawurlencode($string);
        $string = str_replace('%', '_', $string);
        $string = preg_replace('/_+/', '_', $string);

        return preg_replace('/[.*?!@-_ ]+$/', '', $string);
    }
}
