<?php
namespace App\Traits;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
trait UploadFileTrait
{
    public function uploadfile(UploadedFile $file, string $folder): ?string
    {
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path("uploads/{$folder}"), $fileName);
        return asset("uploads/{$folder}/{$fileName}");
    }
    public function deletefile(string $fileUrl, string $default = 'default.jpg'): void
    {
        $fileName = basename($fileUrl);
        if ($fileName !== $default) {
            $filePath = public_path("uploads/{$this->getFolderFromUrl($fileUrl)}/" . $fileName);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    }
    protected function getFolderFromUrl(string $url): string
    {
        $parsed = parse_url($url, PHP_URL_PATH);
        $segments = explode('/', $parsed);
        return $segments[count($segments) - 2] ?? '';
    }
}