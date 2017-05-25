<?php

 namespace App\Providers;
 
 use Illuminate\Support\ServiceProvider;
 use Storage;
 use Aws\S3\S3Client;
 use League\Flysystem\AwsS3v2\AwsS3Adapter;
 use League\Flysystem\Filesystem;
 
 class CloudStorageServiceProvider extends ServiceProvider{
     public function boot(){
         Storage::extend('gcs', function( $app, $config )
         {
             $client = S3Client::factory([
                 'key'    => $config['key'],
                 'secret' => $config['secret'],
                 'region' => $config['region'],
                 'base_url' => $config['base_url'],
             ]);
 
             return new Filesystem(new AwsS3Adapter($client, $config['bucket']));
         });
     }
 
     public function register(){
     }
 }
 